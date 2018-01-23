<?php

class DocumentController extends AdminController implements AdminInterface {
    public function __construct() {
        parent::__construct();
        $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Input::all();
        $documents = Document::groupBy('parent_id');
        if( !empty($input['class_id']) ){
            $documents = $documents->where('class_id', $input['class_id']);
        }
        if( !empty($input['subject_id']) ){
            $documents = $documents->where('subject_id', $input['subject_id']);
        }
        if( !empty($input['level_id']) ){
            $documents = $documents->where('level_id', $input['level_id']);
        }
        $documents = $documents->get();
        return View::make('admin.document.index')->with(compact('documents'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $document = Document::where('parent_id', $id)->first();
        $lessonId = Common::getObject($document, 'lesson_id');
        $group = Common::getDocumentByLesson($lessonId);
        // dd($group);
        return View::make('admin.document.edit')->with(compact('group', 'document', 'id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();
        $field = [
            'lesson_id' => $input['lesson_id'],
            'class_id' => $input['class_id'],
            'subject_id' => $input['subject_id'],
            'level_id' => $input['level_id'],
            'parent_id' => $id
        ];
        $fileUrlP = $fileUrlD = '';

        if( Input::hasFile('doc_file_p') ){
            $file = Input::file('doc_file_p');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move(public_path().DOCUMENT_UPLOAD_DIR, time().'_'.$filename);
            $fileUrlP = DOCUMENT_UPLOAD_DIR . time().'_'.$filename;
        }
        if( Input::hasFile('doc_file_d') ){
            $file = Input::file('doc_file_d');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move(public_path().DOCUMENT_UPLOAD_DIR, time().'_'.$filename);
            $fileUrlD = DOCUMENT_UPLOAD_DIR . time().'_'.$filename;
        }

        if( !empty($input['doc_p_id']) ){
            // $field['name'] = $input['name_p'];
            // $field['file_url'] = $fileUrlP;
            $doc = Document::find($input['doc_p_id'])->update([
                    'name' => $input['name_p'],
                    'file_url' => $fileUrlP,
                ]);
        } else{
            $field['name'] = $input['name_p'];
            $field['file_url'] = $fileUrlP;
            $doc = Document::create($field);
        }

        if( !empty($input['doc_d_id']) ){
            // $field['name'] = $input['name_d'];
            // $field['file_url'] = $fileUrlD;
            $doc = Document::find($input['doc_d_id'])->update([
                    'name' => $input['name_d'],
                    'file_url' => $fileUrlD,
                ]);
        } else{
            $field['file_url'] = $fileUrlD;
            $field['name'] = $input['name_d'];
            $doc = Document::create($field);
        }
        return Redirect::back()->withMessage('Lưu thành công!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Document::where('parent_id', $id)->delete();
        return Redirect::action('DocumentController@index');
    }


}
