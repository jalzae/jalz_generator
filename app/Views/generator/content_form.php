<div class="col-xl-12" style="margin-bottom: 250px;">
    <div class="card">
        <div class="card-body">

            <input type="hidden" name="" id="idcss" value="<?= $id ?>" class="form-control" value="" required="required" title="">

            <div class="form-group">
                <label for="my-input">Select DB</label>
                <select name="dbnya" id="inputdbnya" class="form-control" required="required">
                    <option value="">Select Db</option>
                    <?php
                    $limit = count($databes);
                    for ($i = 0; $i < $limit; $i++) {
                        echo '<option value="' . $databes[$i]->Database . '">';
                        print_r($databes[$i]->Database);
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="my-input">Select Table</label>
                <select name="table" id="inputtable" class="form-control" required="required">
                    <option value="">Select Tablenya</option>
                </select>
            </div>

            <br>
            <div class="form-group">
                <label for="my-input">Select Methods</label>
                <select name="table" id="inputmethod" class="form-control" required="required">
                    <option value="">Select Methods</option>

                </select>
            </div>
            <br>

        </div>
    </div>
    <div id="tablecontent">

    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <button type="button" id="copythis" class="copybutton btn btn-primary">Copy</button>
            </div>
            <br>
            <textarea style="min-height: 500px;" name="hasil" id="hasil" class="form-control" rows="3" required="required"></textarea>
        </div>
    </div>
</div>
<script type='text/javascript'>
    function loadmetod() {
        data = {
            id: $("#idcss").val(),
        };
        pushForm(data, '/master/console/show_method_css', "#inputmethod");
    }

    function loadcolumn(val, db) {

        data = {
            table: val,
            db: db,
        };
        pushForm(data, '/master/console/show_table_css', "#tablecontent");
    }
    $(document).ready(function() {
        loadmetod();
        $("#inputtable").change(function(e) {
            e.preventDefault();
            var val = $("#inputtable").val();
            var db = $("#inputdbnya").val();
            data = {
                table: val,
                db: db,
            };
            pushForm(data, '/master/console/show_table_css', "#tablecontent");
        });
        $("#inputdbnya").change(function(e) {
            e.preventDefault();
            var val = $(this).val();
            data = {
                id: val
            };
            pushForm(data, '/master/console/show_table2', "#inputtable");
          
        });
        $("#copythis").click(function(e) {
            e.preventDefault();
            $("#hasil").select();
            document.execCommand('copy');
            alert("copied");
        });
    });
</script>