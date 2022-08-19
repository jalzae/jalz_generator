<div class="col-xl-12" style="margin-bottom: 250px;">
    <div class="card">
        <div class="card-body">

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
                <label for="my-input">Select Framework</label>
                <select name="table" id="inputfw" class="form-control" required="required">
                    <option value="">Select Framework</option>
                    <?php
                    foreach ($fw as $obj) {
                    ?>
                        <option value="<?= $obj->id_framework ?>"><?= $obj->name_framework ?></option>
                    <?php
                    }
                    ?>
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
            <div class="form-group col-sm-6">
                <label for="my-input">Type Namespace</label>
                <input type="text" class="form-control col-sm-10" id="namespace" placeholder="Namespace">
            </div>
            <br>
            <div class="form-group">
                <button type="button" class="submitbutton btn btn-primary">Submit</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex">

                <div class="form-group col-sm-6">
                    <label for="my-input">Type Filetype( Without dot)</label>
                    <input type="text" class="col-sm-5" id="filetype" placeholder="filetype">
                </div>
            </div>
            <br>

            <div class="form-group d-flex">
                <button type="button" style="margin-right: 10px;" id="generateit" class="btn btn-primary">Generate</button>
                <button type="button" id="copythis" class="copybutton btn btn-primary">Copy</button>
            </div>
            <br>
            <textarea style="min-height: 500px;" name="hasil" id="hasil" class="form-control" rows="3" required="required"></textarea>

        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        $("#inputdbnya").change(function(e) {
            e.preventDefault();
            var val = $(this).val();
            data = {
                id: val
            };
            pushForm(data, '/master/console/show_table', "#inputtable");
        });
        $("#inputtable").change(function(e) {
            e.preventDefault();
            var val = $(this).val();
            var db = $("#inputdbnya").val();
            data = {
                id: val,
                db: db,
            };
            pushForm(data, '/master/console/show_column', "#hasil");
        });
        $("#inputfw").click(function(e) {
            e.preventDefault();
            var val = $(this).val();
            data = {
                id: val,
            };
            pushForm(data, '/master/console/show_method', "#inputmethod");
        });
        $(".submitbutton").click(function(e) {
            e.preventDefault();
            var val = $("#inputmethod").val();
            var db = $("#inputdbnya").val();
            var table = $("#inputtable").val();
            var namespace = $("#namespace").val();
            data = {
                id: val,
                db: db,
                table: table,
                namespace: namespace,

            };
            $.ajax({
                type: "POST",
                url: "<?= base_url('master/console/execute') ?>",
                data: data,
                success: function(response) {
                    pushForm(data, '/' + response, "#hasil");
                },
                error: function(response) {
                    alert('methods error!!!');
                }
            });

        });
        $("#generateit").click(function(e) {
            e.preventDefault();
            value = $("#hasil").val();
            filetype = $("#filetype").val();
            table = $("#inputtable").val();
            method = $("#inputmethod option:selected").text();
            data = {
                value: value,
                method: method,
                table: table,
                filetype: filetype,
            };
            console.log(data);
            $.ajax({
                type: "POST",
                url: "<?= base_url('master/console/generate') ?>",
                data: data,
                success: function(response) {
                    alert("Berhasil");
                },
                error: function(response) {
                    alert('methods error!!!');
                }
            });


        });
        $("#copythis").click(function(e) {
            e.preventDefault();
            $("#hasil").select();
            document.execCommand('copy');
            alert("copied");
        });


    });
</script>