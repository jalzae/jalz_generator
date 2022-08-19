<div class="collapse navbar-collapse" id="topnav-menu-content">
    <ul class="navbar-nav">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-dashboard-line me-1"></i>Feature<div class="arrow-down"></div>
            </a>
            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                <a id="console" href="#" class="dropdown-item">Console Methods</a>

            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-apps-2-line me-1"></i> Generator CRUD <div class="arrow-down"></div>
            </a>
            <div class="dropdown-menu" aria-labelledby="topnav-apps">
                <?php
                foreach ($fw as $obj) {
                ?>
                    <a href="#" value='<?= $obj->id_lang ?>' class="selectthis dropdown-item"><i class=" ri-calendar-2-line align-middle me-1"></i> <?= $obj->name_lang ?></a>
                <?php
                }
                ?>


            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-ui" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-pencil-ruler-2-line me-1"></i> Element Generator <div class="arrow-down"></div>
            </a>

            <div class="dropdown-menu mega-dropdown-menu dropdown-mega-menu-xl" aria-labelledby="topnav-ui">
                <div class="row">
                    <div class="col-lg-4">
                        <div>
                            <?php
                            foreach ($css as $obj) {
                            ?>
                                <a href="#" value='<?= $obj->id_css ?>' class="selectcss dropdown-item"><?= $obj->name_css ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-stack-line me-1"></i> Settings <div class="arrow-down"></div>
            </a>
            <div class="dropdown-menu" aria-labelledby="topnav-components">
                <a id="languange" href="#" class="dropdown-item"><i class="ri-honour-line align-middle me-1"></i> Languange</a>
                <a id="fw" href="#" class="dropdown-item"><i class="ri-honour-line align-middle me-1"></i> Framework</a>
                <a id="methods" href="#" class="dropdown-item"><i class="ri-honour-line align-middle me-1"></i> Method</a>
                <a id="cssmenu" href="#" class="dropdown-item"><i class="ri-honour-line align-middle me-1"></i> CSS</a>
            </div>
        </li>

        <li id="routing" class="nav-item dropdown">
            <a class="nav-link " href="#" id="topnav-layout" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="ri-layout-line me-1"></i> Routing
            </a>
        </li>
        <li id="faqs" class="nav-item dropdown">
            <a class="nav-link " href="#" id="topnav-layout" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="ri-layout-line me-1"></i> Faqs
            </a>
        </li>
    </ul> <!-- end navbar-->
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $(".selectthis").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('value');
            data = {
                id: id
            };
            menuClick2('.selectthis', '/master/console/generator', data);
        });
        $("#json").click(function(e) {
            e.preventDefault();
            menuClick2('#json', '/master/console/json', null);
        });
        $("#console").click(function(e) {
            e.preventDefault();
            menuClick2('#console', '/master/console/console', null);
        });
        $(".selectcss").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('value');
            data = {
                id: id
            };
            menuClick2('.selectthis', '/master/console/generator_form', data);
        });
    });
</script>