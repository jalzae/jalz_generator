<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use DateTime;

class Json extends BaseController
{
	public function detect()
	{
		$raw = file_get_contents('php://input');
		$result =  json_decode(file_get_contents('php://input'), true);

		if ($result == NULL) {
			echo "json invalid";
		} else {
			echo "json valid";
			if (substr($raw, 0, 1) == "[") {
				// echo "ini multiple";
				foreach ($result as $i => $thing) {
					echo "Thing " . $i . " is " . $thing;
					foreach ($thing as $obj => $value) {
						echo $value;
					}
				}
			} else {
				// echo "single array";
				foreach ($result as $obj => $value) {
					if (is_array($value)) {
						echo "is array";
					} else if ($this->isDate($value, "Y-m-d H:i:s")) {
						echo "is datetime";
					} else if ($this->isDate($value, "Y-m-d")) {
						echo "is date";
					} else if ($this->isDate($value, "H:i:s")) {
						echo "is time";
					} else if (is_string($value)) {
						echo "is string";
					} else if (is_int($value)) {
						echo "is int";
					}
				}
			}
		}

	}

	function isDate($datetime, $format = "Y-m-d H:i:s")
	{
		return ($datetime == date($format, strtotime($datetime)));
	}
}
