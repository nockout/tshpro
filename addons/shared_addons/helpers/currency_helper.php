<?php 


	function format_price($priceFloat,$decimal_place=0,$symbol_thousand='.',$symbol="đ") {
	
	$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
	return $price.$symbol;
	}	
	function convert_price_to_mysql($priceFloat){
		//preg_ma
	}
	function check_price($price){
		$pattern = '/^\d+(?:\.\d)?$/';
		return preg_match($pattern, $price);
	}
?>