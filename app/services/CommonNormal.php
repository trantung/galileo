<?php
use Carbon\Carbon;
class CommonNormal
{
    public static function relateAction($id, $relateMethod, $input, $method = 'attach', $name = null){
        $name = self::commonName($name);
        $model = $name::find($id);
        // dd($model);
        if( !method_exists($model, $relateMethod) ){
            return null;
            dd($model . 'chưa khai báo quan hệ' . ':' . $relateMethod);
        }
        // Them record vao bang many_many
        $model->$relateMethod()->$method($input);
        return true;
        // SubjectClass::where('class_id', $id)->lists('id');
        // Lay ten bang many_many
        // $pivotTable = $model->$relateMethod()->getTable();
        // // lay ten truong ma khoa chinh cua Model $name la khoa ngoai cua bang many_many
        // $foreignKey = $model->$relateMethod()->getForeignKey();
        // // $otherKey = $model->$relateMethod()->getOtherKey();
        // if( !empty($pivotTable) && !empty($foreignKey) ){
        //  /// Tra ve 1 mang cac record vua insert trong bang many_many
        //  return DB::table($pivotTable)->where($foreignKey, $id)->get();
        // }
        // return null;
    }
    public static function delete($id, $name = NULL)
    {
        $name = self::commonName($name);
        $name::find($id)->delete();
    }

    public static function update($id, $input, $name = NULL)
    {
        $name = self::commonName($name);
        $name::find($id)->update($input);
    }
    
    public static function create($input, $name = NULL)
    {
        $name = self::commonName($name);
        $id = $name::create($input)->id;
        return $id;
    }
    public static function commonName($name = NULL)
    {
        if ($name == NULL) {
            $name = Request::segment(2);
        } 
        if ($name == 'subject') {
            return 'Subject';
        }
        if ($name == 'partner') {
            return 'Partner';
        }
        if ($name == 'class') {
            return 'ClassModel';
        }
        if ($name == 'user') {
            return 'User';
        }
        if ($name == 'level') {
            return 'Level';
        }
        if ($name == 'doc') {
            return 'Document';
        }
        if ($name == 'center') {
            return 'Center';
        }
        return $name;
    }
    public static function getListRelateObject($modelName, $value, $field)
    {
        $list = $modelName::where($field, $value)->get();
        return $list;
    }
    public static function createOrUpdateSubjectLevel($classId, $input)
    {
        self::relateAction($classId, 'subjects', $input['subject']);
        $subjectClasses = self::getListRelateObject('SubjectClass', $classId, 'class_id');
        foreach ($subjectClasses as $subjectClass) {
            $subjectId = $subjectClass->subject_id;
            // Neu nhu mon hoc nay co nhap input "trinh do"
            if( isset($input['level'][$subjectId]) ){
                foreach ($input['level'][$subjectId] as $level) {
                    if( !empty($level) ){
                        /* Lay tat ca trinh do cua lop hoc moi them tai moi mon hoc tuong ung
                         * de them vao bang level
                         */
                        self::create( ['name' => $level, 'subject_class_id' => $subjectClass->id], 'Level');
                    }
                }
            }
        }
        return true;
    }
    
    public static function commonSaveTime($startName, $endName, $input, $id) { 
        if(!empty($input[$startName])){ 
            foreach ($input[$startName] as $key => $value){  
                foreach ($value as $k => $time){
                    if (!empty($time)){  
                        $field = [ 'user_id' => $id, 'time_id' => $key, 'start_time' => $time, 'end_time' => $input[$endName][$key][$k] ]; 
                        CommonNormal::create($field, 'FreeTimeUser'); 
                    }
                } 
            } return true;
        } return false;
    }
    public static function createFamily($input)
    {
        //check phone unique in table family
        if ($input['mom_phone']) {
            $check = Family::where('phone', $input['mom_phone'])->first();
            if ($check) {
                return false;
            }
        }
        if ($input['dad_phone']) {
            $check = Family::where('phone', $input['dad_phone'])->first();
            if ($check) {
                return false;
            }
        }
        //if have phone of mom and dad: create record in table family(login by phone and password)
        if ($input['mom_phone'] && $input['dad_phone']) {
            $momInput['phone'] = $input['mom_phone'];
            $momInput['fullname'] = $input['mom_fullname'];
            $momInput['gender'] = NU;
            $momInput['password'] = Hash::make('123456');
            $momId = Family::create($momInput)->id;
            $mom = Family::find($momId);
            $groupId = $momId;
            $mom->update(['group_id' => $momId]);
            $dadInput['phone'] = $input['dad_phone'];
            $dadInput['fullname'] = $input['dad_fullname'];
            $dadInput['group_id'] = $groupId;
            $dadInput['gender'] = NAM;
            Family::create($dadInput);
            return $groupId;
        }
        //if have only mom or dad
        if ($input['mom_phone']) {
            $momInput['phone'] = $input['mom_phone'];
            $momInput['fullname'] = $input['mom_fullname'];
            $momInput['password'] = Hash::make('123456');
            $momInput['gender'] = NU;
            $momId = Family::create($momInput)->id;
            $mom = Family::find($momId);
            $mom->update(['group_id' => $momId]);
            $groupId = $momId;
            return $groupId;
        }
        if ($input['dad_phone']) {
            $dadInput['phone'] = $input['dad_phone'];
            $dadInput['fullname'] = $input['dad_fullname'];
            $dadInput['password'] = Hash::make('123456');
            $dadInput['gender'] = NAM;
            $dadId = Family::create($dadInput)->id;
            $dad = Family::find($dadId);
            $dad->update(['group_id' => $dadId]);
            $groupId = $dadId;
            return $groupId;
        }
    }
}