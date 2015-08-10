<?php

//fuly decode a particular string
function full_decode($string) {
    return html_entity_decode($string, ENT_QUOTES);
}

//decode anything we throw at it
function form_decode(&$x) {
    //loop through objects or arrays
    if (is_array($x) || is_object($x)) {
        foreach ($x as &$y) {
            $y = form_decode($y);
        }
    }

    if (is_string($x)) {
        $x = full_decode($x);
    }

    return $x;
}

function character_limit_lang($str,$limit=30,$end_char='&#8230;'){
	
	$array_char=mb_count_chars($str);	
	//$chars=array_chunk($array_char,$limit,true);
	$char=split_word_limit($array_char,$limit,$end_char);
	if($char['total']>=$limit){
		return implode($char['result'], "").$end_char;
	}else 
		return implode($char['result'], "");

}
	function split_word_limit($ar=array(),$limit){
		$total=0;
		$result=array();
		foreach ($ar as $ch){
			if(mb_detect_encoding($ch, 'ASCII', true)){
				if(ctype_upper($ch)){
					$total=$total+2;
				}
				else $total=$total+1;
			}else{
				$total=$total+2;
			}
			$result[]=$ch;
			if($total>=$limit){
				return array("result"=>$result,'total'=>$total);
			}
			
		}
		return array("result"=>$result,'total'=>$total);;
	}
	function mb_count_chars($input) {
		$l = mb_strlen($input, 'UTF-8');
		$unique = array();
		for($i = 0; $i < $l; $i++) {
			$unique[]=mb_substr($input, $i, 1, 'UTF-8');
			//if(!array_key_exists($char, $unique))
			//	$unique[$char] = 0;
			//$unique[$char]++;
		}
		return $unique;
	}

function my_latin($chars=array()){
	
	$total =array("acssii"=>0,'non_ascii'=>0);
	
	foreach ($chars as $ch){
		if(mb_detect_encoding($ch, 'ASCII', true)){
			if(ctype_upper($ch)){
				$total['acssii']--;
			}
				$total['acssii']++;
		}else{
			$total['non_ascii']++;
		}
	}
	
	return $total;
}

function my_character_limiter($str, $n = 500, $end_char = '&#8230;') {
    $output = substr($str, 0, $n);
    if (strlen($str) > $n) {
        $output.=$end_char;
    }

    return $output;
}

//used by the giftcard feature
function generate_code($length = 16) {
    $vowels = '0123';
    $consonants = '456789ABCDEF';

    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        }
        else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}

function cut_word($string, $word_count = 100, $nid = 0) {
    $string = str_replace("\n", '', $string);
    $string = preg_replace('/<style.*<\/style>/i', '', $string);
//$string = preg_replace('/&amp;/i','&',$string);
    $trimmed = "";
    $string = strip_tags($string);
    $string = preg_replace("/\040+/", " ", trim($string));
    $stringc = explode(" ", $string);
    if ($word_count >= sizeof($stringc))
        return $string; //nothing to do, our string is smaller than the limit.
// trim the string to the word count
    for ($i = 0; $i < $word_count; $i++)
        $trimmed .= $stringc[$i] . " ";
    if (substr($trimmed, strlen(trim($trimmed)) - 1, 1) == '.')
        return trim($trimmed) . ' ...';
    return trim($trimmed) . ' ...';
}

function get_fullname_account($account = array()) {
    if (!empty($account)) {
        if (!empty($account['first_name_jp'])) {
            return $account['first_name_jp'] . ' ' . $account['last_name_jp'];
        }
        else {
            return $account['first_name_en'] . ' ' . $account['last_name_en'];
        }
    }
    return NULL;
}


if ( ! function_exists('create_slug'))
{
	function create_slug($string) {
		$search = array (
				'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
				'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
				'#(ì|í|ị|ỉ|ĩ)#',
				'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
				'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
				'#(ỳ|ý|ỵ|ỷ|ỹ)#',
				'#(đ)#',
				'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
				'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
				'#(Ì|Í|Ị|Ỉ|Ĩ)#',
				'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
				'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
				'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
				'#(Đ)#',
				"/[^a-zA-Z0-9\-\_]/",
		) ;
		$replace = array (
				'a',
				'e',
				'i',
				'o',
				'u',
				'y',
				'd',
				'A',
				'E',
				'I',
				'O',
				'U',
				'Y',
				'D',
				'-',
		) ;
		$string = preg_replace($search, $replace, $string);
		$string = preg_replace('/(-)+/', '-', $string);
		$string = strtolower($string);
		return $string;
	}
}

