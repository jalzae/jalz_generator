<form action="#" method="POST" id="formadd" role="form">


    <div class="mb-2 row">
        <label class="col-md-2 col-form-label" for="example-number">Route</label>
        <div class="col-md-10">
            <input type="text" name="route" id="route" class="form-control" value="" required>
        </div>
    </div>
    <br>
    <div class="mb-2 row">
        <label class="col-md-2 col-form-label" for="example-number">Framework</label>
        <div class="col-md-10">
            <select name="id_framework" id="id_framework" class="form-control" required="required">
                <?php
                foreach ($fw as $obj) {
                ?>
                    <option value="<?= $obj->id_framework ?>"><?= $obj->name_framework ?></option>
                <?php
                }
                ?>
            </select>

        </div>
    </div>
    <br>
    <div class="mb-2 row">
        <label class="col-md-2 col-form-label" for="example-number">Methods</label>
        <div class="col-md-10">
            <select name="id_method" id="id_method" class="form-control" required="required">
                <?php
                foreach ($method as $obj) {
                ?>
                    <option value="<?= $obj->id_method ?>"><?= $obj->name_method ?></option>
                <?php
                }
                ?>
            </select>

        </div>
    </div>
    <br>
    <div class="form-group">
        <button type="submit" class=" btn btn-primary">Submit</button>
    </div>
</form>

<script type='text/javascript'>
    $(document).ready(function() {
        $("#formadd").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            try {
                reloadForm(data, '/master/routing/createlang', '#routing');
            } finally {
                closemodal();
            }

        });
    });
</script>