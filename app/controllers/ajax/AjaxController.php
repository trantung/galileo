<?php 
class AjaxController extends \BaseController {

    /**
     * Get suggest list CVHT 
     */
    public function postGetListUserForSchedule(){
        $input = Input::all();
        $suggestList = [];
        $userActive = User::where('role_id', CVHT)->lists('username', 'id');
        if( !empty($input['package_id']) && !empty($input['dates']) ){
            $package = Package::find($input['package_id']);
            $freeTimeUsers = [];

            ///// lay danh sach thoi gian ranh cua user
            foreach ($userActive as $uid => $userName) {
                $userSchedule = SpDetail::where('user_id', $uid);
                $checkFreeDate = true;

                ///// Lay lich hoc dang ky cua hoc sinh
                foreach ($input['dates'] as $key => $times) {
                    /// Kiem tra CVHT da dang ky lich day vao khung gio nay chua
                    $freeTimeOfAnUser = Common::getFreeTimeOfUser($uid, getTimeId($times[0]), $times[1], date("H:i:s",strtotime($times[1]. " + $package->duration minutes")) );
                    if( !$freeTimeOfAnUser ){
                        $checkFreeDate = false;
                        break; // thoat khoi vong lap va chuyen sang nguoi tiep theo
                    }

                    /// Kiem tra CVHT da co lich day vao gio nay chua?
                    $checkUserSchedule = SpDetail::where('user_id', $uid)
                        ->where( 'time_id', getTimeId($times[0]) )
                        ->where( 'lesson_hour', '=', $times[1] );
                    // TODO: thieu nếu cùng dạy vào timeid và cùng lesson_hour vào 2 tháng khác nhau
                        
                    /// Neu CVHT nay da day 1 goi khac cung thoi diem thi thoat khoi vong lap va chuyen sang nguoi tiep theo
                    if( $checkUserSchedule->where('package_id', '!=', $package->id)->count() ){
                        $checkFreeDate = false;
                        break; // thoat khoi vong lap va chuyen sang nguoi tiep theo
                    }

                    // neu CVHT da co du so hoc sinh toi da theo goi quy dinh tai thoi diem nay thi thoat khoi vong lap va chuyen sang nguoi tiep theo
                    if( $userSchedule->where('package_id', $package->id)->groupBy('student_id')->count() >= $package->max_student ){
                        $checkFreeDate = false;
                        break; // thoat khoi vong lap va chuyen sang nguoi tiep theo
                    }
                    // return Response::json($freeTimeOfAnUser);
                }

                if( $checkFreeDate ){
                    $suggestList[$uid] = $userName;
                }

            } // End foreach
        } // End if
        
        $output = '<option value="">-- chọn --</option>';
        if( count($suggestList) ){
            $output .= '<optgroup label="Danh sách khả dụng">';
            foreach ($suggestList as $uid => $userName) {
                $output .= '<option value="'. $uid .'">'. $userName .'</option>';
            }
            $output .= '</optgroup>';
        }
            
        $output .= '<optgroup label="Không có lịch trống">';
        foreach ($userActive as $uid => $userName) {
            if( !in_array($userName, $suggestList) ){
                $output .= '<option value="'. $uid .'">'. $userName .'</option>';
            }
        }
        $output .= '</optgroup>';
        return Response::json($output);
    }

    /**
     * Giet dropdown list of level by class & subject
     **/
    public function postGetLevelListByClassSubject(){
        $input = Input::all();
        $html = '<option value="">--Tất cả--</option>';
        if( !empty($input['class_id']) && count($input['subject_id']) ){
            $levelList = [];
            foreach ($input['subject_id'] as $key => $value) {
                $levels = Level::where('class_id', $input['class_id']);
                foreach( $levels->where('subject_id', $value)->get() as $key2 => $item){
                    $html .= $key.'+'.$key2.'<option value="'. $item->id .'">'. Common::getObject($item->subjects, 'name').' ' . $item->name .'</option>'; 
                }
            }
        }
        return $html;
    }

    /** 
     * Save document into a lesson
     */
    public function postSaveDocument(){
        $input = Input::all();
        // return $input;
        $doc['class_id'] = $input['class_id'];
        $doc['lesson_id'] = $input['lesson_id'];
        $doc['subject_id'] = $input['subject_id'];
        $doc['level_id'] = $input['level_id'];
        $arrayP = Common::saveDocument('doc_new_file_p', $doc);
        Common::saveDocument('doc_new_file_d', $doc, $arrayP);
        return Response::json( View::make('admin.js.get_document_form_of_level', ['lesson' => Lesson::find($doc['lesson_id'])])->render() );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postGetListClassByCenter(){
        $centerId = Input::get('center_id');
        if( !empty($centerId) ){
            $listData = Common::getClassSubjectLevelOfCenter($centerId);
            return Response::json(View::make('ajax.get_level_by_center')->with($listData)->render());
        }
        return Response::json('');
    }

    /// Delete level by subject id - ajax
    public function postDelete()
    {
        $input = Input::all();
        $ob = SubjectClass::where('class_id', $input['class_id'])
            ->where('subject_id', $input['subject_id']);
        $listId = $ob->lists('id');
        Level::whereIn('id', $listId)->delete();
        $ob->delete();
            // ->list();

        return Response::json($input);
    }

    public function getPrint()
    {

    }

    public function postChangeStatus()
    {
        $documentId = Input::get('id');
        $document = Document::find($documentId);
        $status = 2;
        $message = 'Chưa kiểm duyệt';
        if( $document->status == 2 ){
          $status = 1;
          $message = 'Đã kiểm duyệt';
        }
        $document->update(['status' => $status]);
        return Response::json( $message );
   }
    

    public function postDocumentDownload()
    {
        $input = Input::all();
        $document = Document::find($input['id']);
        $doc['quantity_download'] = $document->quantity_download + 1;
        $document->update($doc);
        if($admin = Auth::admin()->get()){
            $field['model_id'] = $admin->id;
            $field['model_name'] = 'Admin';
        }
        if($user = Auth::user()->get()){
            $field['model_id'] = $user->id;
            $field['model_name'] = 'Admin';
        }
        $field['document_id'] = $input['id'];
        $field['quantity_download'] = 1;
        $field['type_id'] = $document->type_id;
        $field['parent_id'] = $document->parent_id;
        $field['name'] = $document->name; 
        $field['code'] = $document->code;
        $field['file_url']  = $document->file_url;
        $field['class_id']  = $document->class_id;
        $field['subject_id']  = $document->subject_id;
        $field['level_id']  = $document->level_id;
        $field['lesson_id']  = $document->lesson_id;
        $field['order']  = $document->order;
        $field['day']  = '';
        $field['month']  = '';
        $field['year']  = '';
        $logId = DocumentLog::create($field)->id;
        
    }
}
