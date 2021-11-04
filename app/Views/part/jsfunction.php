<script type='text/javascript'>
    const baseUrl = "<?= base_url() ?>";

    function closemodal() {
        $("#tutupmodal").click();
    }

    function loadin() {
        $(".preloader").fadeIn();
    }

    function loadout() {
        $(".preloader").fadeOut();
    }

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }

    }



    function loadTable(id) {
        $(id).DataTable();
    }

    function menuClick(id, url) {
        $.ajax({
            type: "post",
            url: baseUrl + url,
            success: function(response) {
                $("#content").html(response);

            }
        });
    }

    function menuClick2(id, url, data) {
        $.ajax({
            type: "post",
            url: baseUrl + url,
            data: data,
            success: function(response) {
                $("#content").html(response);

            }
        });
    }

    async function loadModal(data, url) {
        $.ajax({
            method: "post",
            url: baseUrl + url,
            data: data,
            success: function(response) {
                $(".modal-body").html(response);
            },
            error: function(response) {
                alert("error with this method");
                closemodal();
            }
        });
    }

    async function submitForm(data, url) {
        $.ajax({
            type: "POST",
            url: baseUrl + url,
            data: data,
            success: function(response) {
                swal(response);
            },
            error: function(response) {
                alert("error with this method");
            }
        });
    }
    async function reloadForm(data, url, button) {
        $.ajax({
            type: "POST",
            url: baseUrl + url,
            data: data,
            success: function(response) {
                swal(response);
                $(button).click();
            },
            error: function(response) {
                alert("error with this method");
            }
        });
    }

    async function pushForm(data, url, resultid) {
        $.ajax({
            type: "POST",
            url: baseUrl + url,
            data: data,
            success: function(response) {
                $(resultid).html(response);
            },
            error: function(response) {
                alert("error with this method");
            }
        });
    }

    async function submitFile(data, url) {
        $.ajax({
            method: "POST",
            url: baseUrl + url,
            data: data,
            processData: false,
            contentType: false,
            dataType: 'html',
            success: function(response) {
                swal(response);
            },
            error: function(response) {
                alert("error with this method");
            }
        });
    }
    async function reloadFile(data, url, target) {
        $.ajax({
            method: "POST",
            url: baseUrl + url,
            data: data,
            processData: false,
            contentType: false,
            dataType: 'html',
            success: function(response) {
                swal(response);
                $(target).click();
            },
            error: function(response) {
                alert("error with this method");
            }
        });
    }
</script>