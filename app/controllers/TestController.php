<?php

class TestController extends AdminController implements AdminInterface {

	public function getImportTUser(){
		Excel::load('public/CTV_T.xlsx', function($reader) {
			$results = $reader->toArray();
			$centerId = Center::first()->id;
			$centerLevels = CenterLevel::where('center_id', $centerId)->get();
			$subjectId = Subject::where('code', 'T')->first()->id;
			// dd($subjectId);
			$countInsert = $countUpdate = 0;
			foreach ($results as $key => $value) {
				if( !empty( $value['email_galileo'] ) ){
					$field = [
						'full_name' => !empty($value['ho_ten_day_du']) ? $value['ho_ten_day_du'] : '',
						'email' => !empty($value['email_galileo']) ? $value['email_galileo'] : '',
						'start_date' => !empty($value['ngay_bat_dau_lam']) ? $value['ngay_bat_dau_lam']->toDateTimeString() : '',
						'birth_day' => is_object($value['ngay_sinh']) ? $value['ngay_sinh']->toDateTimeString() : '',
						'phone' => !empty($value['so_dien_thoai']) ? '0'.$value['so_dien_thoai'] : '',
						'current_address' => !empty($value['noi_o_hien_tai']) ? $value['noi_o_hien_tai'] : '',
						'address' => !empty($value['dia_chi_theo_cmtnd']) ? $value['dia_chi_theo_cmtnd'] : '',
						'id_number' => !empty($value['so_cmtnd']) ? $value['so_cmtnd'] : '',
						'id_date' => !empty($value['cap_ngay']) ? $value['cap_ngay']->toDateTimeString() : '',
						'id_provide' => !empty($value['noi_cap']) ? $value['noi_cap'] : '',
						'job' => !empty($value['nghe_nghiep']) ? $value['nghe_nghiep'] : '',
						'personal_email' => !empty($value['email_ca_nhan']) ? $value['email_ca_nhan'] : '',
						'role_id' => CVHT,
						// 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
						// 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
					];
					$userId = Common::getObject(User::where('email', $field['email'])->first(), 'id');
					// dd($userId);
					if( $userId ){
						CommonNormal::update($userId, $field, 'User');
						$countUpdate++;
					}else{
						$userId = CommonNormal::create($field, 'User');
						foreach ($centerLevels as $key2 => $centerLevel) {
							$levelIds = Level::find($centerLevel->level_id)->where('subject_id', $subjectId)->lists('id');
							if( $centerLevel->level_id && in_array($centerLevel->level_id, $levelIds) ){
								CommonNormal::create([
									'user_id' => $userId,
									'center_level_id' => $centerLevel->id,
									'level_id' => $centerLevel->level_id,
								], 'UserCenterLevel');
							}
						}
						$countInsert++;
					}
					// dd($field);
				}
			}
			echo 'Đã tạo mới: '.$countInsert.'<br>Đã cập nhật: '.$countUpdate;
			// dd($results);
		});
	}

	public function getImportVUser(){
		Excel::load('public/CTV_V.xlsx', function($reader) {
			$results = $reader->toArray();
			$centerId = Center::first()->id;
			$centerLevels = CenterLevel::where('center_id', $centerId)->get();
			$subjectId = Subject::where('code', 'V')->first()->id;
			$countInsert = $countUpdate = 0;

			// dd($results);
			foreach ($results as $key => $value) {
				if( !empty( $value['email_galileoeduvn'] ) ){
					$bangCap = !empty($value['bang_cap']) ? $value['bang_cap'].', ' : '';
					$khoa = !empty($value['nganh_hoc']) ? 'ngành '.$value['nganh_hoc'].', ' : '';
					$truong = !empty($value['truong']) ? 'trường '.$value['truong'].', ' : '';
					$xepLoai = !empty($value['xep_loai_tot_nghiep']) ? 'xếp loại tốt nghiệp '.$value['xep_loai_tot_nghiep'] : '';
					$field = [
						'full_name' => !empty($value['ho_ten_day_du']) ? $value['ho_ten_day_du'] : '',
						'email' => !empty($value['email_galileoeduvn']) ? $value['email_galileoeduvn'] : '',
						'start_date' => is_object($value['ngay_bat_dau_lam_viec']) ? $value['ngay_bat_dau_lam_viec']->toDateTimeString() : '',
						'birth_day' => is_object($value['ngay_sinh']) ? $value['ngay_sinh']->toDateTimeString() : '',
						'phone' => !empty($value['so_dt']) ? '0'.$value['so_dt'] : '',
						'current_address' => !empty($value['noi_o_hien_tai']) ? $value['noi_o_hien_tai'] : '',
						'address' => !empty($value['dia_chi_thuong_tru']) ? $value['dia_chi_thuong_tru'] : '',
						'id_number' => !empty($value['so_cmnd']) ? $value['so_cmnd'] : '',
						'id_date' => is_object($value['cap_ngay']) ? $value['cap_ngay']->toDateTimeString() : '',
						'id_provide' => !empty($value['noi_cap']) ? $value['noi_cap'] : '',
						'job' => $bangCap.$khoa.$truong.$xepLoai,
						'personal_email' => !empty($value['email']) ? $value['email'] : '',
						'role_id' => CVHT,
						// 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
						// 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
					];
					$userId = Common::getObject(User::where('email', $field['email'])->first(), 'id');
					// dd($userId);
					if( $userId ){
						CommonNormal::update($userId, $field, 'User');
						$countUpdate++;
					}else{
						$userId = CommonNormal::create($field, 'User');
						foreach ($centerLevels as $key2 => $centerLevel) {
							$levelIds = Level::find($centerLevel->level_id)->where('subject_id', $subjectId)->lists('id');
							if( $centerLevel->level_id && in_array($centerLevel->level_id, $levelIds) ){
								CommonNormal::create([
									'user_id' => $userId,
									'center_level_id' => $centerLevel->id,
									'level_id' => $centerLevel->level_id,
								], 'UserCenterLevel');
							}
						}
						$countInsert++;
					}
					// dd($field);
				}
			}
			echo 'Đã tạo mới: '.$countInsert.'<br>Đã cập nhật: '.$countUpdate;
			// dd($results);
		});
	}

	public function import(){
		// ini_set('default_charset', 'utf-8');
		// header('Content-Type: text/html; charset=utf-8');
		$directory = 'F:/HocMai Drive/PDF_Galileo/T/4/D';
		$text = 'Galileo_Bu?i 01_��p �n_Ch��ng tr?nh h?c t?t_to�n_l?p 4_nh�m A1_ver 3.0.2017';
		dd(clean($text));
		$files = Common::listFolderFiles($directory);
		foreach ($files as $key => $file) {
			echo basename($file).'<br>';
		}
	}

	public function convert_vi_to_en($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		//$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
		return $str;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
