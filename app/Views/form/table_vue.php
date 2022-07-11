<table id="example1" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <?php
            foreach ($table as $k => $obj) {
                if ($k < 1) continue;
                if ($obj['write'] == "yes") {
            ?>
                    <th <?php
                        if ($obj['sort'] != "No") {
                            echo "@click='sortIt($k)'";
                        }
                        ?>><?= ucfirst(str_replace("_", " ", $obj['name'])) ?></th>
                <?php
                }
            }
            foreach ($feature[0] as $index => $obj) {
                ?>
                <th><?= ucfirst($obj) ?></th>
            <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(item,index) in itemlist" :key="item.<?= $table[0]['name'] ?>">
            <td>{{index++}}</td>
            <?php
            foreach ($table as $k => $obj) {
                if ($k < 1) continue;
                if ($obj['write'] == "yes") {
            ?>
                    <td>{{ item.<?= $obj['name'] ?> }}</td>
                <?php
                }
            }
            foreach ($feature[0] as $index => $obj) {
                ?>
                <th><button type="button" class="btn <?php if ($obj == "edit") {
                                                            echo "btn-primary";
                                                        } else if ($obj == "delete") {
                                                            echo "btn-danger";
                                                        } else if ($obj == "detail") {
                                                            echo "btn-info";
                                                        } ?>" <?php if ($obj == "edit") {
                                                                    echo "data-toggle='modal' data-target='#myModal'";
                                                                    echo '@click="editIt(item.' . $table[0]['name'] . ')"';
                                                                } else if ($obj == "delete") {
                                                                    echo '@click="deleteIt(item.' . $table[0]['name'] . ')"';
                                                                } else if ($obj == "detail") {
                                                                    echo "data-toggle='modal' data-target='#myModal' ";
                                                                    echo '@click="detailIt(item.' . $table[0]['name'] . ')"';
                                                                } ?>><?= ucfirst($obj) ?></button></th>
            <?php
            }
            ?>
        </tr>
    </tbody>
</table>