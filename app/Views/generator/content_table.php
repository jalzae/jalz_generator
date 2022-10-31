<div class="card">
    <div class="card-body">
        <h5 class="card-title">Set Your option</h5>
        <table id="details" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Required</th>
                    <th scope="col">Add it?</th>
                    <th style="display: none;" scope="col">Type</th>
                    <th style="display: none;" scope="col">Required</th>
                    <th style="display: none;" scope="col">Add it?</th>
                    <th scope="col">Sort it?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = count($column);
                for ($i = 0; $i < $hasil; $i++) {
                ?>
                    <tr>
                        <th scope="row"><?= $i + 1 ?></th>
                        <td><?= $column[$i]['Field'] ?></td>
                        <td align="center">
                            <div class="form-group">
                                <select id="my-select" class="form-control typenya" name="my-select">
                                    <option selected value="text">Text</option>
                                    <option value="number">Number</option>
                                    <option value="readonly">Read Only</option>
                                    <option value="email">Email</option>
                                    <option value="password">Password</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="hidden">Hidden</option>
                                    <option value="select">Select</option>
                                    <option value="datetime-local">Datepicker</option>
                                    <option value="date">Date</option>
                                    <option value="time">Time</option>
                                    <option value="file">File</option>
                                </select>
                            </div>

                        </td>
                        <td align="center">
                            <div class="form-group">
                                <select id="my-select" class="form-control requirenya" name="my-select1">
                                    <?php
                                    if ($column[$i]['Null'] == "YES") {
                                    ?>
                                        <option value="required">Required</option>
                                        <option selected value="">Not Required</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option selected value="required">Required</option>
                                        <option value="not">Not Required</option>
                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select id="my-select" class="form-control optionnya" name="my-select1">
                                    <?php
                                    if ($column[$i]['Null'] == "YES") {
                                    ?>
                                        <option value="yes">yes</option>
                                        <option selected value="not">not</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option selected value="yes">yes</option>
                                        <option value="not">not</option>
                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>
                        </td>
                        <td style="display: none;">text</td>
                        <td style="display: none;"><?php
                                                    if ($column[$i]['Null'] != "YES") {
                                                        echo "required";
                                                    } else {
                                                        echo "not";
                                                    }
                                                    ?></td>
                        <td style="display: none;"><?php
                                                    if ($column[$i]['Null'] == "YES") {
                                                        echo "no";
                                                    } else {
                                                        echo "yes";
                                                    }
                                                    ?></td>
                        <td>
                            <div class="form-group">
                                <select id="my-select" class="form-control sortnya">
                                    <option value="Yes">Yes</option>
                                    <option selected value="No">No</option>
                                </select>
                            </div>
                        </td>
                        <td style="display: none;">No</td>
                        <td>

                            <input type="text" class="extensionnya<?= $i ?>" />

                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div id="allCheckboxes">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="forms" value="forms">Form
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="detail" value="detail">Detail
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="edit" value="edit">Edit
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="delete" value="delete">Delete
                </label>
            </div>
        </div>

        <div class="form-group mb-3">

            <input type="text" name="argument" id="inputargument" class="form-control" value="" required="required" pattern="" title="">

        </div>

        <div class="form-group">
            <button type="button" class="submitbutton btn btn-primary form-control">Submit</button>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        const feature = [];
        $(function() {
            $('#allCheckboxes').on("change", ":checkbox", function() {
                if (this.checked) {
                    console.log(this.id + ' is checked');
                    feature.push(this.id);
                } else {
                    console.log(this.id + ' is unchecked');
                    feature.splice(feature.indexOf(this.id), 1);

                }
                console.log(feature);
            });
        });
        $(".typenya").change(function(e) {
            var table = document.getElementById("details"),
                rIndex, cIndex;

            data = $(this).val();
            // table rows
            for (var i = 1; i < table.rows.length; i++) {
                // row cells
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    table.rows[i].cells[j].onclick = function() {
                        rIndex = this.parentElement.rowIndex;
                        cIndex = this.cellIndex + 1;
                        console.log("Row : " + rIndex + " , Cell : " + cIndex);

                        table.rows[rIndex].cells[5].innerHTML = data;
                    };
                }
            }

        });
        $(".requirenya").change(function(e) {
            var table = document.getElementById("details"),
                rIndex, cIndex;

            data = $(this).val();
            // table rows
            for (var i = 1; i < table.rows.length; i++) {
                // row cells
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    table.rows[i].cells[j].onclick = function() {
                        rIndex = this.parentElement.rowIndex;
                        cIndex = this.cellIndex + 1;
                        console.log("Row : " + rIndex + " , Cell : " + cIndex);

                        table.rows[rIndex].cells[6].innerHTML = data;
                    };
                }
            }
        });

        $(".optionnya").change(function(e) {
            var table = document.getElementById("details"),
                rIndex, cIndex;

            data = $(this).val();
            // table rows
            for (var i = 1; i < table.rows.length; i++) {
                // row cells
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    table.rows[i].cells[j].onclick = function() {
                        rIndex = this.parentElement.rowIndex;
                        cIndex = this.cellIndex + 1;
                        console.log("Row : " + rIndex + " , Cell : " + cIndex);

                        table.rows[rIndex].cells[7].innerHTML = data;
                    };
                }
            }
        });
        $(".sortnya").change(function(e) {
            var table = document.getElementById("details"),
                rIndex, cIndex;

            data = $(this).val();
            // table rows
            for (var i = 1; i < table.rows.length; i++) {
                // row cells
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    table.rows[i].cells[j].onclick = function() {
                        rIndex = this.parentElement.rowIndex;
                        cIndex = this.cellIndex + 1;
                        console.log("Row : " + rIndex + " , Cell : " + cIndex);

                        table.rows[rIndex].cells[9].innerHTML = data;
                    };
                }
            }
        });

        $(".submitbutton").click(function(e) {
            e.preventDefault();
            const args = $("#inputargument").val();
            var table = document.getElementById("details");
            var tableArr = {
                table: [],
                feature: []
            };
            for (var i = 1; i < table.rows.length; i++) {
                tableArr.table.push({
                    id: table.rows[i].cells[1].innerHTML,
                    name: table.rows[i].cells[1].innerHTML,
                    type: table.rows[i].cells[5].innerHTML,
                    status: table.rows[i].cells[6].innerHTML,
                    write: args == 'write_all' ? 'yes' : table.rows[i].cells[7].innerHTML,
                    sort: table.rows[i].cells[9].innerHTML,
                    custom: $('.extensionnya' + (parseInt(i) - 1)).val(),
                });
            }
            tableArr.feature.push(feature);
            console.log(tableArr);
            let tablearray = JSON.stringify(tableArr);
            var val = $("#inputmethod").val();
            data = {
                id: val,
            };
            $.ajax({
                type: "POST",
                url: "<?= base_url('master/console/execute_css') ?>",
                data: data,
                success: function(response) {
                    pushForm(tablearray, '/' + response, "#hasil");
                },
                error: function(response) {
                    alert('methods error!!!');
                }
            });

        });
    });
</script>