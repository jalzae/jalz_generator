<div class="col-xl-12 d-flex">
    <div class="card col-sm-6">
        <div class="card-body">
            <div style="float: right;" class="col-sm-3">
                <button type="button" style="float: right;" data-bs-toggle='modal' data-bs-target='#myModal' class="addthis btn btn-primary">Add Routing</button>
            </div>
            <br>
            <br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Framework</th>
                        <th>Methods</th>
                        <th>Route</th>
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
                            <td><?= $obj->name_framework ?></td>
                            <td><?= $obj->name_method ?></td>
                            <td><?= $obj->route ?></td>
                            <td><button type="button" value='<?= $obj->id_function ?>' class="deletethis btn btn-danger">Delete</button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div> <!-- end card-body-->
    </div> <!-- end card-->

    <div class="card col-sm-6">
        <div class="card-body">
            <div style="float: right;" class="col-sm-3">
                <button type="button" style="float: right;" data-bs-toggle='modal' data-bs-target='#myModal' class="addthis2 btn btn-primary">Add Routing Form</button>
            </div>
            <br>
            <br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Framework CSS</th>
                        <th>Methods</th>
                        <th>Route</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($css as $obj) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $obj->name_css?></td>
                            <td><?= $obj->name_method ?></td>
                            <td><?= $obj->route ?></td>
                            <td><button type="button" value='<?= $obj->id_function ?>' class="deletethis2 btn btn-danger">Delete</button></td>
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
            loadModal(null, '/master/routing/add_lang');
        });
        $(".addthis2").click(function(e) {
            e.preventDefault();
            loadModal(null, '/master/routing/add_css');
        });
        $(".deletethis").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('value');
            var data = {
                id: id
            };
            reloadForm(data, '/master/routing/deletelang', '#routing');
        });
        $(".deletethis2").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('value');
            var data = {
                id: id
            };
            reloadForm(data, '/master/routing/deletecss', '#routing');
        });
    });
</script>