<?php

namespace App\Controllers\Master\Cssfunction;

use App\Controllers\BaseController;

class Nuxt extends BaseController
{

	public function formatlist()
	{
		$data = json_decode(file_get_contents('php://input'), true);

		$table = $data['table'];
		$feature = $data['feature'];

		echo "format:{";
		$forms = '';
		$formatname = '';
		foreach ($table as $obj) {
			$label = ucwords(str_replace("_", " ", (string)$obj['id']));
			if ($obj['write'] == 'yes')
				$forms .= "'".$obj['id'] . "',";
			$formatname .= $label;
		}
		echo "header:[" . $forms . "],";
		echo "body:[" . $formatname . "],";
		echo "action:[";
		foreach ($feature[0] as $obj) {
			if ($obj == "edit") {
				echo "
				{
            title: 'Edit',
            icon: 'fas fa-edit',
            class: 'btn-secondary',
            model: '" . $table[0]['id'] . "',
            action: 'edit',
          },
				";
			}
			if ($obj == "detail") {
				echo "{
            title: 'Detail',
            icon: 'fas fa-newspaper',
            class: 'btn-primary',
            model: '" . $table[0]['id'] . "',
            action: 'detail',
          },";
			}
			if ($obj == "delete") {
				echo "{
            title: '',
            icon: 'fas fa-trash',
            class: 'btn-danger',
            model: '" . $table[0]['id'] . "',
            action: 'delete',
          },";
			}
		}

		echo "]";
		echo "},";
	}
	public function forms()
	{
		$data = json_decode(file_get_contents('php://input'), true);

		$table = $data['table'];
		$forms = "";
		foreach ($table as $obj) {
			if ($obj['write'] == 'yes')
				$forms .= $obj['id'] . ":'',";

			if ($obj['type'] == 'file')
				$forms .= "ext:'',";
		}

		echo "forms:{" . $forms . "},";
		echo "form:[";
		foreach ($table as $obj) {
			if ($obj['write'] == 'yes') {
				if ($obj['type'] == 'password')
					$obj['type'] == 'pass';

				$obj['label'] = str_replace("_", " ", (string)$obj['id']);
				$obj['label'] = ucwords($obj['label']);

				echo "{";
				if ($obj['type'] == 'select') {
					echo " model: '" . $obj['id'] . "',
          type: '" . $obj['type'] . "',
          label: '" . $obj['label'] . "',
          value: '" . $obj['id'] . "',
          display: '" . $obj['id'] . "',
          list: [],";
				} else if ($obj['type'] == 'file') {
					echo " model: '" . $obj['id'] . "',
          type: '" . $obj['type'] . "',
          label: '" . $obj['label'] . "',";
					echo "extension: 'ext',
          allow: ['" . $obj['custom'] . "'],";
				} else {
					echo " model: '" . $obj['id'] . "',
          type: '" . $obj['type'] . "',
          label: '" . $obj['label'] . "',";
				}
				echo "},";
			}
		}
		echo "]";
	}
}
