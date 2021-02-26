<?php

class FormSanitizer {

	public static function sanitizingstr($inputtext){
		$inputtext = strip_tags($inputtext);
		$inputtext = str_replace(" ", "", $inputtext);
		$inputtext = strtolower($inputtext);
		$inputtext = ucfirst($inputtext);
		return $inputtext;
	}

		public static function sanitizingusername($inputtext){
		$inputtext = strip_tags($inputtext);
		$inputtext = str_replace(" ", "", $inputtext);
		return $inputtext;
	}

		public static function sanitizingpassword($inputtext){
		$inputtext = strip_tags($inputtext);
		return $inputtext;
	}

		public static function sanitizingemail($inputtext){
		$inputtext = strip_tags($inputtext);
		$inputtext = str_replace(" ", "", $inputtext);

		return $inputtext;
	}
}
?>