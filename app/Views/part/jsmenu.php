<script type='text/javascript'>
    $(document).ready(function() {
        $("#languange").click(function(e) {
            e.preventDefault();
            menuClick('#languange', '/master/lang/index');
        });
        $("#fw").click(function(e) {
            e.preventDefault();
            menuClick('#fw', '/master/framework/index');
        });
        $("#methods").click(function(e) {
            e.preventDefault();
            menuClick('#methods', '/master/methods/index');
        });
        $("#cssmenu").click(function(e) {
            e.preventDefault();
            menuClick('#cssmenu', '/master/css/index');
        });
        $("#routing").click(function(e) {
            e.preventDefault();
            menuClick('#routing', '/master/routing/index');
        });
        $("#faqs").click(function(e) {
            e.preventDefault();
            menuClick('#faqs', '/master/faq/getfaq');
        });

    });
</script>