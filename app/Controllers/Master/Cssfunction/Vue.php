<?php

namespace App\Controllers\Master\Cssfunction;

use App\Controllers\BaseController;

class Vue extends BaseController
{

	public function add()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		echo ' <form @submit="submit" action="#" method="post" id="formadd">';
		foreach ($data['table'] as $obj) {
			$name = str_replace('_', ' ', $obj['name']);
			if ($obj['write'] == "yes") {

				if ($obj['status'] == "not") {
					$obj['status'] = "";
				}
				if ($obj['type'] != "hidden") {
					echo '&#13;<div class="form-group">';
				}
				if ($obj['type'] != "hidden") {
					echo '&#13;<label>' . ucfirst($name) . '</label>';
				}

				if ($obj['type'] == "select") {
					echo '&#13;<select v-model="forms.' . $obj['name'] . '" name="' . $obj['name'] . '" id="' . $obj['name'] . '" class="form-control" ' . $obj['status'] . '>';
					echo '&#13;<option value="">Select</option>';
					echo "&#13;</select>";
				} else if ($obj['type'] == "datetime") {
					echo " ini nanti";
				} else if ($obj['type'] == "textarea") {
					echo '&#13;
                <textarea name="' . $obj['name'] . '" id="' . $obj['name'] . '" v-model="forms.' . $obj['name'] . '" class="form-control" rows="3" ' . $obj['status'] . '"></textarea>';
				} else {
					echo '&#13;<input type="' . $obj['type'] . '" v-model="forms.' . $obj['name'] . '" name="' . $obj['name'] . '" id="' . $obj['name'] . '" class="form-control" />';
				}
				if ($obj['type'] != "hidden") {
					echo '&#13;</div>';
				}
				echo '&#13;';
			} else {
			}
		}
		echo ' <button type="submit" class="btn btn-primary">Submit</button>';
		echo '</form>';
	}

	public function table()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$table = $data['table'];
		$fitur = $data['feature'];
		$limit = 2;
		foreach ($data['table'] as $obj) {
			if ($obj['write'] == "yes") {
				$limit++;
			}
		}

		echo ' <table class="table table-light table-striped table-hover table-bordered">
<thead class="thead-light">
  <tr>
	<th>#</th>';
		foreach ($data['table'] as $obj) {
			if ($obj['write'] == "yes") {
				echo '<th>' . str_replace('_', ' ', ucfirst($obj['name'])) . '</th>';
			}
		}
		echo '<th>Action</th>
  </tr>
</thead>
<tbody v-if="list.length==0">
  <tr>
	<td colspan="' . $limit . '">No Data</td>
  </tr>
</tbody>';
		echo '<tbody v-else-if="list.length!=0 && keywords!=';
		echo "''";
		echo '">';

		echo '<tr
	v-for="(item,index) in filtered"
	:key="item.' . $table[0]['name'] . '"
  >
	<td>{{index+1}}</td>';
		foreach ($data['table'] as $obj) {
			if ($obj['write'] == "yes") {
				echo '<td>{{item.' . $obj['name'] . '}}</td>';
			}
		}
		echo '<td>';

		foreach ($fitur[0] as $obj) {
			if ($obj == "edit") {
				echo '
				<button
				type="button"
				@click="edit(item.' . $table[0]['name'] . ')"
				class="btn btn-primary"
			  >Edit</button>';
			}
			if ($obj == "detail") {
				echo '<button
				type="button"
				@click="detail(item.' . $table[0]['name'] . ')"
				class="btn btn-warning"
			  >Detail</button>';
			}
			if ($obj == "delete") {
				echo '<button
			type="button"
			@click="delete(item.' . $table[0]['name'] . ')"
			class="btn btn-warning"
		  >Delete</button>';
			}
		}

		echo '</td>
  </tr>
</tbody>

<tbody v-else>
  <tr
	v-for="(item,index) in list"
	:key="item.' . $table[0]['name'] . '"
  >
	<td>{{index+1}}</td>';

		foreach ($data['table'] as $obj) {
			if ($obj['write'] == "yes") {
				echo '<td>{{item.' . $obj['name'] . '}}</td>';
			}
		}
		foreach ($fitur[0] as $obj) {
			if ($obj == "edit") {
				echo '
				<button
				type="button"
				@click="edit(item.' . $table[0]['name'] . ')"
				class="btn btn-primary"
			  >Edit</button>';
			}
			if ($obj == "detail") {
				echo '<button
				type="button"
				@click="detail(item.' . $table[0]['name'] . ')"
				class="btn btn-warning"
			  >Detail</button>';
			}
			if ($obj == "delete") {
				echo '<button
			type="button"
			@click="delete(item.' . $table[0]['name'] . ')"
			class="btn btn-warning"
		  >Delete</button>';
			}
		}
		echo '</td>

  </tr>
</tbody>
</table>';
		$hidden = "'hidden'";
		echo '<nav aria-label="Page navigation example">
<ul class="pagination justify-content-center">
  <li
	class="page-item"
	:class="{' . $hidden . ':page< 2 }"
	@click="prevpage"
  ><a
	  class="page-link"
	  href="#"
	>Previous</a></li>
  <li
	class="page-item"
	:class="{' . $hidden . ':total_page== 1 }"
  ><a
	  class="page-link"
	  href="#"
	>{{page}}</a></li>
  <li
	class="page-item"
	:class="{' . $hidden . ':page== total_page }"
	@click="nextpage"
  ><a
	  class="page-link"
	  href="#"
	>Next</a></li>
</ul>
</nav>';
	}
}
