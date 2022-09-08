import { GetterTree, ActionTree, MutationTree } from 'vuex'

interface <?= ucfirst($table) ?> {
<?php
$type1 = '';
for ($i = 0; $i < $limit; $i++) {
  if (strpos($column[$i]['Type'], 'int') !== false) {
    $type = 'number';
  } else {
    $type = 'String';
  }

  if ($i == 0) {
    $type1 = $type;
  }

  echo $column[$i]['Field'] . ':' . $type . ',';
}
?>
}

const <?= $table ?>: Array<<?= ucfirst($table) ?>> = [
  ];

  export const state = () => ({
  <?= $table . 's' ?>: <?= $table ?>
  })

  export type RootState = ReturnType<typeof state>

    export const getters: GetterTree<RootState, RootState> = {
      <?php
      echo '
    get' . $table . '(state) {
    return state.' . $table . 's
    },

    filter' . $table . '(state) {
    return state.' . $table . 's.filter(' . $table . ' => {
    return ' . $table . '.' . $column[0]['Field'] . '
    ///parameter
    })
    },

    findindex' . $table . ': (state, getters) => (id:' . $type1 . ') => {
    return state.' . $table . 's.findIndex(' . $table . ' => ' . $table . '.' . $column[0]['Field'] . ' == id)
    },

    findcontains' . $table . ': (state, getters) => (id:any) => {
    return state.' . $table . 's.filter(e  => ';
      for ($i = 0; $i < $limit; $i++) {
        if (strpos($column[$i]['Type'], 'int') !== false) {
          echo   'e.' . $column[$i]['Field'] . '=== id';
        } else {
          echo   'e.' . $column[$i]['Field'] . '.toLowerCase().includes(id)';
        }
        if ($i + 1 != $limit) {
          echo "||";
        } else {
          echo ")";
        }
      }
      echo '},

    detail' . $table . ': (state, getters) => (id:' . $type1 . ') => {
    return state.' . $table . 's.find(' . $table . ' => ' . $table . '.' . $column[0]['Field'] . ' == id)
    },';
      ?>
      }

      export const mutations: MutationTree<RootState> = {
        <?php
        echo '
      get' . $table . '(state, data) {
      state.' . $table . 's=data;
      },

      add' . $table . '(state, data) {
      state.' . $table . 's.push(data);
      },
      update' . $table . '(state, data) {
      var ' . $table . ' = state.' . $table . 's.find(o => o.' . $column[0]['Field'] . ' == data.' . $column[0]['Field'] . ')
      var index = state.' . $table . 's.indexOf(' . $table . ' as  ' . ucfirst($table) . ');';


        for ($i = 1; $i < $limit; $i++) {
          echo 'state.' . $table . 's[index].' . $column[$i]['Field'] . ' = data.' . $column[$i]['Field'] . ';';
        }
        echo '
        },
        delete' . $table . '(state, value) {
            var ' . $table . ' = state.' . $table . 's.find(o => o.' . $column[0]['Field'] . ' == value)
            state.' . $table . 's.splice(state.' . $table . 's.indexOf(' . $table . ' as  ' . ucfirst($table) . '), 1)
        }';

        ?>
        }

        export const actions: ActionTree<RootState, RootState> = {

          }