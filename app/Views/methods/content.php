<div class="col-xl-12">
    <div class="card">
        <div class="card-body">

            <div style="float: right;" class="col-sm-3">
                <button type="button" style="float: right;" data-bs-toggle='modal' data-bs-target='#myModal' class="addthis btn btn-primary">Add Methods</button>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Methods</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($lang as $obj) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $obj->name_method ?></td>
                            <td><button type="button" value='<?= $obj->id_method ?>' class="deletethis btn btn-danger">Delete</button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $(".addthis").click(function(e) {
            e.preventDefault();
            loadModal(null, '/master/methods/add_lang');
        });
        $(".deletethis").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('value');
            var data = {
                id: id
            };
            reloadForm(data, '/master/methods/deletelang', '#methods');
        });
    });
</script>