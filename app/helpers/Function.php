<?php

/* mm/dd/yyyy to Y-m-d H:i:s */
function convertDateTime($dateString, $paramString = '/')
{
	return $dateString . ' 00:00:00';
	// $array = explode($paramString,$dateString);
	// $datetime = $array[2].'-'.$array[0].'-'.$array[1].' 00:00:00';
	// return $datetime;
}
function getRole($roleId) {
	$role = array(
		ADMIN => 'ADMIN',
		EDITOR => 'EDITOR',
		// SEO => 'SEO',
	);
	return $role[$roleId];
}

function selectRoleId()
{
	return array(
		'' => '-- Lựa chọn',
		ADMIN => 'ADMIN',
		EDITOR => 'EDITOR',
		// SEO => 'SEO',
	);
}

function textParentCategory($input, $isSeoMeta = NULL, $id = NULL)
{
	if(!Admin::isSeo() || $isSeoMeta) {
		return array('placeholder' => $input, 'class' => 'form-control','id' => $id);
	} else {
		return array('placeholder' => $input, 'class' => 'form-control', 'readonly' => true,'id' => $id);
	}
}

function returnList($className)
{
	$list = $className::lists('name', 'id');
	return $list;
}
function returnCss()
{
	return array(
			'fa fa-rocket' => 'Sứ mệnh',
			'fa fa-road' => 'Tầm nhìn',
			'fa fa-key' => 'Giá trị cốt lõi',
		);
}
function returnPosition()
{
	return array(
			1 => 'Trái',
			2 => 'Giữa',
			3 => 'Phải',
		);
}

function getIpAddress()
{
	$ip = $_SERVER['REMOTE_ADDR'];
	return $ip;
}

//add time to filename
function changeFileNameImage($filename)
{
	$file = getFilename($filename);
	$str = strtotime(date('Y-m-d H:i:s'));
	$fileNameAfter = $file. '-' . $str;
	$extension = getExtension($filename);
	return $fileNameAfter.'.'.$extension;
}

function selectStatusGame()
{
	return array(
		ENABLED => 'Đã đăng',
		DISABLED => 'Chưa đăng'
	);
}

//get status game
function getStatusGame($status) {
	$statusGame = array(
		ENABLED => 'Đã đăng',
		DISABLED => 'Chưa đăng'
	);
	return $statusGame[$status];
}

function getNameDevice($deviceId)
{
	if ($deviceId == MOBILE) {
		return SMART_DEVICE;
	}
	if ($deviceId == COMPUTER) {
		return COMPUTER_DEVICE;
	}
}

function getPositionAdvertise($position)
{
	if ($position == HEADER) {
		return 'Header';
	}
	if ($position == Footer) {
		return 'Footer';
	}
	if ($position == CHILD_PAGE) {
		return 'Content';
	}
	if ($position == CHILD_PAGE_RELATION) {
		return 'Content';
	}
}
function getStatusAdvertise($status)
{
	if ($status == ENABLED) {
		return 'Hiển thị';
	}
	if ($status == DISABLED) {
		return 'Ẩn';
	}
}

// show 0 for null
function getZero($number = null)
{
	if($number != '') {
		return $number;
	}
	return 0;
}
//get extension from filename
function getExtension($filename = null)
{
	if($filename != '') {
		return pathinfo($filename, PATHINFO_EXTENSION);
	}
	return null;
}
//get filename from filename
function getFilename($filename = null)
{
	if($filename != '') {
		return pathinfo($filename, PATHINFO_FILENAME);
	}
	return null;
}
//cut trim text
function limit_text($text, $len) {
    if (strlen($text) < $len) {
        return $text;
    }
    $text_words = explode(' ', $text);
    $out = null;
    foreach ($text_words as $word) {
        if ((strlen($word) > $len) && $out == null) {

            return substr($word, 0, $len) . "...";
        }
        if ((strlen($out) + strlen($word)) > $len) {
            return $out . "...";
        }
        $out.=" " . $word;
    }
    return $out;
}
//check file exist
function remoteFileExists($url) {
    $curl = curl_init($url);

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);

    //do request
    $result = curl_exec($curl);

    $ret = false;

    //if request did not fail
    if ($result !== false) {
        //if request was ok, check response code
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200) {
            $ret = true;
        }
    }

    curl_close($curl);

    return $ret;
}

function checkActive($uri = '')
{
	$lang = LaravelLocalization::setLocale();
	if($lang == NULL) {
		$segment = Request::segment(1);
		if ($segment == $uri) {
			return 'class = "active"';
		}
	} else {
		$segment2 = Request::segment(2);
		if ($segment2 == $uri) {
			return 'class = "active"';
		}
	}
	return;
}

function selectActive()
{
	return array(
		ACTIVE => ACTIVEUSER,
		INACTIVE => INACTIVEUSER,
	);
}
/* Y-m-d H:i:s to d-m-Y H:i:s */
function showDateTime($dateString = null)
{
	if($dateString == null) {
		return false;
	}
	$array = explode(' ', $dateString);
	$dmY = explode('-', $array[0]);
	$His = explode(':', $array[1]);
	$datetime = $dmY[2].'-'.$dmY[1].'-'.$dmY[0].' '.$His[0].':'.$His[1];
	return $datetime;
}

function getCount($count)
{
	if($count < 5) {
		return $count;
	}
	return 5;
}

function selectLang()
{
	return array(
		LANG_VI => 'Tiếng việt',
		LANG_EN => 'Tiếng anh',
	);
}
function returnObjectLanguage($langObject, $lang, $modelName)
{
	if ($lang == 'vi') {
		return $modelName::find($langObject->model_id);
	}
	if ($lang == 'en') {
		return $modelName::find($langObject->relate_id);
	}
	// return $modelName::find($langObject->model_id);
}
function getNameStatus($status)
{
	if ($status == 1) {
		return 'Không hiển thị';
	}
	if ($status == 2) {
		return 'Hiển thị';
	}
}
function getLang()
{
	$lang = LaravelLocalization::setLocale();
	if($lang == NULL || $lang == 'vi') {
		return 'vi';
	}
	return $lang;
}
function getTypeLanguage($vi, $en)
{
	$lang = LaravelLocalization::setLocale();
	if ($lang != LANG_EN) {
		return $vi;
	}
	return $en;
}

function removeTagsHtml($text)
{
	$text = strip_tags($text);
	$text = html_entity_decode($text);
	return $text;
}
