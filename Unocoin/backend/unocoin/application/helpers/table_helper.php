<?php

function hc( $str, $n = 500, $end_char = ' ...' ) {
	$CI =& get_instance();
	$charset = $CI->config->item('charset');

	if ( mb_strlen( $str , $charset) < $n ) {
		return $str ;
	}
	$str = preg_replace( "/\s+/iu", ' ', str_replace( array( "\r\n", "\r", "\n" ), ' ', $str ) );
	if ( mb_strlen( $str , $charset) <= $n ) {
		return $str;
	}
	return mb_substr(trim($str), 0, $n ,$charset) . $end_char ;
}


function convert_date_to_timestamp($str , $hour = 0 , $minute = 0 , $second = 0) {
	if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$str)) {
		$date_array = explode("-" , $str);
		$day = $date_array[2];
		$month = $date_array[1];
		$year = $date_array[0];
		$time = mktime($hour, $minute, $second, $month, $day, $year);
		return $time;
	} else {
    	return FALSE;
	}	
	return FALSE;
}



function convert_date_to_timestamp1($str , $hour = 0 , $minute = 0 , $second = 0) {
	$date_array = explode("-" , $str);
	$month = $date_array[1];
	$year = $date_array[0];
	switch($month) {
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
			$day = 31;
			break;
		case 4:
		case 6:
		case 9:
		case 11:
			$day = 30;
			break;
		case 2:
			if($year % 4 == 0) {
				$day = 29;
			} else {
				$day = 28;
			}	
			break;	
	}
	$time = mktime($hour , $minute , $second , $month , $day , $year);
	return $time;
}

function lastday_month($month = '', $year = '') {
	if (empty($month)) {
		$month = date('m');
	}
	if (empty($year)) {
		$year = date('Y');
	}
	$result = strtotime("{$year}-{$month}-01");
	$result = strtotime('-1 second', strtotime('+1 month', $result));
	return date('Y-m-d', $result);
}

function firstday_month($month = '', $year = '') {
	if (empty($month)) {
		$month = date('m');
	}
	if (empty($year)) {
		$year = date('Y');
	}
	$result = strtotime("{$year}-{$month}-01");
	return date('Y-m-d', $result);
} 



function get_week_array($from, $to) {
	$last_monday = strtotime('Last Monday', $from);
	$last_monday = $last_monday + 86400 * 7;
	$week_array = array();
	if($from == $to) {
		$week_array[] = array(time(), $last_monday + 86400 * 7 - 1);
	} else {
		$week_array[] = array($last_monday, $last_monday + 86400 * 7 - 1);
		while(1) {
			$last_monday += 86400 * 7;
			if($last_monday >= $to)
				break;
			$week_array[] = array($last_monday, $last_monday + 86400 * 7 - 1);
		}

		$week_array[] = array($last_monday, $last_monday + 86400 * 7 - 1);
	}

	return $week_array;
}

function get_month_array($from, $to) {
	$from_array = explode("-" , date('Y-m-d', $from));
	$from_year = $from_array[0];
	$from_month = $from_array[1];
	$month_array = array();
	$month_array[] = array(
					convert_date_to_timestamp(firstday_month($from_month, $from_year)), 
					convert_date_to_timestamp(lastday_month($from_month, $from_year), 23, 59, 59));


	while(1) {
		$from_month += 1;
		if($from_month > 12) {
			$from_month = 1;
			$from_year += 1; 
		}


		$first_day = convert_date_to_timestamp(firstday_month($from_month, $from_year));
		if($first_day >= $to)
			break;
		$month_array[] = array($first_day, convert_date_to_timestamp(lastday_month($from_month, $from_year), 23, 59, 59));
	}

	return $month_array;

}