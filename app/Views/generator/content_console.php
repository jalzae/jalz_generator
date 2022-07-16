<div class="col-xl-12" style="margin-bottom: 250px;">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="my-input">Run Methods</label>
                <input type="text" class="form-control" id="inputmethod" />
            </div>
            <br>
            <div class="form-group">
                <button type="button" class="form-control submitbutton btn btn-primary">Run</button>
            </div>
            <br>


        </div>
    </div>
    <div class="col-sm-12 d-flex">
        <div class="card col-sm-6">
            <div class="card-body">
                <div class="form-group">
                    <button type="button" id="pasteit" class="pastebutton btn btn-primary">Paste</button>
                </div>
                <br>
                <textarea style="min-height: 500px;" name="inputjson" id="inputjson" class="form-control" rows="3" required="required"></textarea>
                <br>
            </div>
        </div>
        <div class="card col-sm-6">
            <div class="card-body">
                <div class="form-group">
                    <button type="button" id="copyit" class="copybutton btn btn-primary">Copy</button>
                </div>
                <br>
                <textarea style="min-height: 500px;" name="hasil" id="hasil" class="form-control" rows="3" required="required"></textarea>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        var hasil = $("#hasil").val();
        $(".submitbutton").click(function(e) {
            e.preventDefault();
            var inputjson = $("#inputjson").val();
            var command = $("#inputmethod").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('command/generate') ?>",
                data: {
                    json: inputjson,
                    cmd: command
                },
                success: function(response) {
                    $("#hasil").html(response);
                },
                error: function(error) {
                    alert('Its error, check Your Request')
                }

            });
        });
        $("#pasteit").click(function(e) {
            e.preventDefault();

        });
        $("#copyit").click(function(e) {
            e.preventDefault();
            $("#hasil").select();
            document.execCommand('copy');
            alert("copied");
        });
    });
</script>