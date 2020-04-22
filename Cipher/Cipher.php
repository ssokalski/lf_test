<?php

class Cipher {
	private static $message;
	private static $shift;
	private static $encoded;

	public static function encode() {
		self::getData();

		// Encoder supports printable ASCII code values 33 - 126 and will rotate between these values
		// No encoded character should encode to space
		// In this version of encoder, characters are allowed to become " which will return \" in the JSON response
		// Maximum value of Shift is 94 which will cause a character to encode to it's self
		// Minumum value of Shift is 0
		
		for($i=0; $i < strlen(self::$message); $i++)
		{
			$char = substr(self::$message,$i,1);
			if($char==' '){ self::$encoded .= $char; }
			else { 
				$value = ord($char) + self::$shift;
				$value = ($value > 126 ? ($value - 94) : $value);
				self::$encoded .= chr($value); 
			}
		}
		self::saveResults();
		self::returnEncodedMessage();
	}

	private static function getData() {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		self::$message = $data->Message;
		self::$shift = $data->Shift;
		self::$encoded = '';

		// Test for valid range of Shift
		if(self::$shift < 0 || self::$shift > 94) { self::return500(); }
	}

	private static function saveResults() {
		// save in CSV file format to results.csv
		$file = fopen("results.csv","a");
		fputcsv($file, array(self::$message, self::$shift, self::$encoded));
		fclose($file);
	}

        private static function returnEncodedMessage() {
		http_response_code(200);
                $responseData = array('EncodedMessage' => self::$encoded);
                header('Content-Type: application/json; charset=UTF-8', true);
                echo json_encode($responseData);
		exit;
	}
	
	private static function return500() {
		http_response_code(500);
		$responseData = array('EncodedMessage' => '');
                header('Content-Type: application/json; charset=UTF-8', true);
		echo json_encode($responseData);
		exit;
	}

}
