<div class="col-xl-12" style="margin-bottom: 250px;">
    <div class="card">
        <div class="card-body">
            <fieldset>
                <legend>Usage Command List:</legend>
                <p>Sequelize migration|model|validation ${name} paranoid(if true)</p>
                <p>Ci4 migration ${name} paranoid(if true)</p>
                <p>Sql create ${name} paranoid(if true)</p>
                <table class="table table-light table-hover  table-bordered">
                    <tbody>
                        <tr>
                            <td>Symbol</td>
                            <td>Function</td>
                            <td>Symbol</td>
                            <td>Function</td>
                            <td>Symbol</td>
                            <td>Function</td>
                        </tr>
                        <tr>
                            <td>:</td>
                            <td>Delimiter type</td>
                            <td>null</td>
                            <td>When isnull</td>
                            <td>default</td>
                            <td>(value)</td>
                        </tr>
                        <tr>
                            <td>enum</td>
                            <td>[value]</td>
                            <td>foreign</td>
                            <td>{value}</td>
                            <td>primmary_key</td>
                            <td>primmary_key</td>
                        </tr>
                        <tr>
                            <td>auto_increment</td>
                            <td>auto_increment</td>
                            <td>unsigned</td>
                            <td>unsigned</td>
                            <td>unique</td>
                            <td>unique</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
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