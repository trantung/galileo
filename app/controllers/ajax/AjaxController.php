<?php 
class AjaxController extends \BaseController {

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
        $doc['class_id'] = $input['class_id'];
        $doc['lesson_id'] = $input['lesson_id'];
        $doc['subject_id'] = $input['subject_id'];
        $doc['level_id'] = $input['level_id'];
        $array = Common::saveDocument('doc_new_file_p', P, $doc);
        Common::saveDocument('doc_new_file_d', D, $doc, $array);
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
}
