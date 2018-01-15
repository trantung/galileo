<?php 
class AjaxController extends \BaseController {

    /**
     * Save document into a lesson
     */
    public function postSaveDocument(){
        $input = Input::all();
        $arrayP = [];
        if( $_FILES['doc_new_file_p'] ){
            foreach ($_FILES['doc_new_file_p']['tmp_name'] as $lessonId => $value) {
                $doc = [];
                $doc['class_id'] = $input['class_id'];
                $doc['lesson_id'] = $input['lesson_id'];
                $doc['subject_id'] = $input['subject_id'];
                $doc['level_id'] = $input['level_id'];
                $doc['type_id'] = 1;
                foreach ($value as $k => $v) {
                    $name = $input['doc_new_title_p'][$lessonId][$k];
                    $doc['name'] = $name;
                    $arrayP[$k] = $docId = Document::create($doc)->id;
                    Document::find($docId)->update(['code' => $docId]);
                }
            }
        }
        Common::saveDocument('doc_new_file_p',);
        if( $_FILES['doc_new_file_d'] ){
            foreach ($_FILES['doc_new_file_d']['tmp_name'] as $lessonId => $value) {
                // if(move_uploaded_file($value[0], public_path().DOCUMENT_UPLOAD_DIR.'test.txt')) {
                $doc = [];
                $doc['class_id'] = $input['class_id'];
                $doc['lesson_id'] = $input['lesson_id'];
                $doc['subject_id'] = $input['subject_id'];
                $doc['level_id'] = $input['level_id'];
                $doc['type_id'] = 2;
                foreach ($value as $kD => $vD) {
                    $name = $input['doc_new_title_d'][$lessonId][$kD];
                    $doc['name'] = $name;
                    $doc['parent_id'] = $arrayP[$kD];
                    $docId = Document::create($doc)->id;
                    Document::find($docId)->update(['code' => $docId]);
                }
            }
        }
        
        return Response::json(Input::file('doc_new_file_p'));
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
