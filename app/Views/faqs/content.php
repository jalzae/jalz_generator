
<div class="col-sm-12 card">
    <div class="row mt--2 card-body">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">

                    <form action="#" method="POST" id="formadd" role="form">
                        <div class="form-group">
                            <label for="input" class="col-sm-6 control-label">Judul Dokumentasi</label>
                            <input type="text" name="version_name" id="version_name" class="form-control" value="" required="required">
                        </div>

                        <div class="form-grou
                          <label for="input" class="col-sm-6 control-label">Isi Dokumentasi</label>
                            <textarea class="col-10" id="desc_update" name="desc_update" required>
                            </textarea>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <?php
            foreach ($faqs as $obj) {
            ?>
                <div class="card">
                    <div class="card-body">
                        <h2 style="font-weight: 400;"><b>Version :<?= $obj->version_name ?></b></h2>
                        <p><?= $obj->desc_update ?></p>

                    </div>
                    <div class="card-footer">
                        <button type="button" value='<?= $obj->id_faq ?>' class="deletehis btn btn-danger">Delete</button>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

</div>


<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>

<script>
    CKEDITOR.replace('desc_update', {});
</script>
<script type='text/javascript'>
    $(document).ready(function() {
        $(".deletehis").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('value');
            data = {
                id: id
            };
            $.ajax({
                type: "POST",
                url: "<?= base_url('master/faq/deletefaq') ?>",
                data: data,
                success: function(response) {
                    swal(response);
                    $("#faqs").click();
                }
            });
        });
        $("#formadd").submit(function(e) {
            var judul = $("input[name*='version_name']").val();
            var desc = CKEDITOR.instances['desc_update'].getData();
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= base_url('master/faq/createfaq') ?>",
                data: {
                    version_name: judul,
                    desc_update: desc,
                },
                success: function(response) {
                    swal(response);
                    $("#faqs").click();
                }
            });
        });
    });
</script>