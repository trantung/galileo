<?php 
class AjaxController extends \BaseController {

    /**
     * Get suggest list CVHT 
     */
    public function postGetListUserForSchedule(){
        $input = Input::all();
        $suggestList = [];
        if( !empty($input['package_id']) && !empty($input['dates']) ){
            $package = Package::find($input['package_id']);
            $maxStudent = $package->max_student;
            $userActive = User::where('role_id', CVHT)->lists('id');
            $freeTimeUsers = [];

            ///// lay danh sach thoi gian ranh cua user
            foreach ($userActive as $uid) {
                $userSchedule = SpDetail::where('user_id', $uid)->where('package_id', $package->id);
                $freeTimeOfAnUser = Common::getFreeTimeOfUser($uid);
                $checkFreeDate = true;
                if( count($freeTimeOfAnUser) ){
                    // $freeTimeUsers[$uid] = $freeTimeOfAnUser;
                    ///// Lay lich hoc dang ky cua hoc sinh
                    foreach ($input['dates'] as $key => $times) {
                        /// Kiem tra CVHT co lich day vao gio nay chua?
                        $count = $userSchedule->where( 'time_id', getTimeId($times[0]) )
                         ->where( 'lesson_hour', $times[1] )->count();
                         // neu co roi thi duoc phep day nhieu hon 1 hoc sinh neu goi hoc cho phep
                         if( $count <= $maxStudent ){
                            
                         }
                    }
                }
                if( $checkFreeDate ){

                }
            }

            return $input['dates'];
        }
        return $suggestList;
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
}
