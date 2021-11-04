<form action="#" method="POST" id="formadd" role="form">


    <div class="mb-2 row">
        <label class="col-md-2 col-form-label" for="example-number">Name Framework</label>
        <div class="col-md-10">
            <input type="text" name="name_framework" id="name_framework" class="form-control" value="" required>
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
                reloadForm(data, '/master/css/createlang', '#cssmenu');
            } finally {
                closemodal();
            }

        });
    });
</script>