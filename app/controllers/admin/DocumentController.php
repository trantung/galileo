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
        $admin = Auth::admin()->get();
        if (isset($admin)) {
            if ($admin->role_id == ADMIN) {
                $documents = Document::whereNotNull('parent_id');
            }
            if ($admin->role_id == BTV) {
                $listSubject = AccessPermisison::where('model_name', 'Admin')
                    ->where('model_id', $admin->id)
                    ->lists('subject_id');
                // dd($listSubject);
                 $documents = Document::whereIn('subject_id', $listSubject)
                    ->whereNotNull('parent_id');
            }
        } else {
            $user = Auth::user()->get();
            if (isset($user)) {
                 $listSubject = AccessPermisison::where('model_name', 'User')
                    ->where('model_id', $user->id)
                    ->lists('subject_id');
                // dd($listSubject);
                 $documents = Document::whereIn('subject_id', $listSubject)
                    ->whereNotNull('parent_id');
            }
        }
        if( !empty($input['name']) ){
            $documents = $documents->where('name', 'LIKE', '%'.$input['name'].'%');
        }
        if( !empty($input['class_id']) ){
            $documents = $documents->where('class_id', $input['class_id']);
        }
        if( !empty($input['subject_id']) ){
            $documents = $documents->where('subject_id', $input['subject_id']);
        }
        if( !empty($input['status']) ){
            $documents = $documents->where('status', $input['status']);
        }
        if( !empty($input['level_id']) ){
            $documents = $documents->where('level_id', $input['level_id']);
            if( isset($input['lesson_code']) ){
                $lesson = Lesson::where('level_id', $input['level_id'])
                    ->where('code', $input['lesson_code'])
                    ->first();
                if ($lesson) {
                    $documents = $documents->where('lesson_id', $lesson->id);
                }
            }
        }
        $documents = $documents->groupBy('parent_id')->paginate(30);
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
        $groups = Common::getDocumentByLesson($lessonId);
        // dd($group[$id]['D']);
        return View::make('admin.document.edit')->with(compact('groups', 'document', 'id'));
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
        $files = Input::file('doc_file');
        // dd($input);
        foreach ($files as $type => $value) {
            foreach ($value as $parentId => $docs) {
                foreach ($docs as $docId => $file) {
                    $field = [
                        'class_id' => $input['class_id'],
                        'subject_id' => $input['subject_id'],
                        'level_id' => $input['level_id'],
                        'lesson_id' => $input['lesson_id'],
                    ];
                    $field['name'] = isset($input['name'][$type][$parentId][$docId]) ? $input['name'][$type][$parentId][$docId] : '';
                    $field['type_id'] = ($type == 'p') ? P : D;
                    $field['parent_id'] = $parentId;
                    if( $file ){
                        $fileName = $file->getClientOriginalName();
                        $fileUrl = DOCUMENT_UPLOAD_DIR.time(). '_' .$fileName;
                        $uploadSuccess = $file->move(public_path().DOCUMENT_UPLOAD_DIR, time(). '_' .$fileName);
                        if( $uploadSuccess ){
                            ////////// Neu upload thanh cong thi luu url vao database
                            $field['file_url'] = $fileUrl;
                        }
                    }
                    if( is_numeric($docId) ){
                        ///// update old document
                        Document::find($docId)->update($field);
                    }
                    else{
                        ///// Create new document
                        $docId = Document::create($field)->id;
                        $code = getCodeDocument($docId);
                        Document::find($docId)->update(['code' => $code]);
                    }
                }
            }
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
    public function getPrint()
    {

    }

}

