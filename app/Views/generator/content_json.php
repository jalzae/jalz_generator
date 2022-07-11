<div class="col-xl-12" style="margin-bottom: 250px;">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="my-input">Select Methods</label>
                <select name="table" id="inputmethod" class="form-control" required="required">
                    <option value="">Select Methods</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <button type="button" class="form-control submitbutton btn btn-primary">Submit</button>
            </div>
            <br>


        </div>
    </div>
    <div class="col-sm-12 d-flex">
        <div class="card col-sm-6">
            <div class="card-body">
                <div class="form-group">
                    <button type="button" id="copythis" class="pastebutton btn btn-primary">Paste</button>
                </div>
                <br>
                <textarea style="min-height: 500px;" name="inputjson" id="inputjson" class="form-control" rows="3" required="required"></textarea>
                <br>
            </div>
        </div>
        <div class="card col-sm-6">
            <div class="card-body">
                <div class="form-group">
                    <button type="button" id="copythis" class="copybutton btn btn-primary">Copy</button>
                </div>
                <br>
                <textarea style="min-height: 500px;" name="hasil" id="hasil" class="form-control" rows="3" required="required"></textarea>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $(".submitbutton").click(function(e) {
            e.preventDefault();
            var inputjson = $("#inputjson").val();
            var hasil = $("#hasil").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('json/detect') ?>",
                data: inputjson,
                success: function(response) {
                    $("#hasil").html(response);
                }
            });
        });
    });
</script>