<?php

use Jenssegers\Agent\Agent;

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
		SEO => 'SEO',
	);
	return $role[$roleId];
}

function selectRoleId()
{
	return array(
		'' => '-- Lựa chọn',
		ADMIN => 'ADMIN',
		EDITOR => 'EDITOR',
		SEO => 'SEO',
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

function selectSortBy($sortBy)
{
	switch ($sortBy) {
		case 'count_view':
			return array(
				'' => '-- chọn',
				'count_view_asc' => 'Lượt xem tăng dần',
				'count_view_desc' => 'Lượt xem giảm dần',
			);
			break;
		case 'count_play':
			return array(
				'' => '-- chọn',
				'count_play_asc' => 'Lượt chơi tăng dần',
				'count_play_desc' => 'Lượt chơi giảm dần',
			);
			break;
		case 'count_vote':
			return array(
				'' => '-- chọn',
				'count_vote_asc' => 'Lượt vote tăng dần',
				'count_vote_desc' => 'Lượt vote giảm dần',
			);
			break;
		case 'count_download':
			return array(
				'' => '-- chọn',
				'count_download_asc' => 'Lượt tải tăng dần',
				'count_download_desc' => 'Lượt tải giảm dần',
			);
		case 'weight_number':
			return array(
				'' => '-- chọn',
				'weight_number_asc' => 'Trọng số tăng dần',
				'weight_number_desc' => 'Trọng số giảm dần',
			);
			break;
		default:
			# code...
			break;
	}
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
	$segment = Request::segment(1);
	if ($segment == $uri) {
		return 'class = "active"';
	}
	return;
}
//kich hoat or chua kich hoat
function checkActiveUser($status)
{
	if($status == ACTIVE)
		return ACTIVEUSER;
	else
		return INACTIVEUSER;
}
// đã duyệt or chưa duyệt
function checkApproveOrReject($status)
{
	if($status == ACTIVE)
		return 'Đã duyệt';
	else
		return 'Chưa duyệt';
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
