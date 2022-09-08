import { GetterTree, ActionTree, MutationTree } from 'vuex'

export const state = () => ({
<?= $table . 's' ?>: {
<?php
for ($i = 0; $i < $limit; $i++) {

  if (strpos($column[$i]['Type'], 'int') !== false) {
    $type = 'number';
  } else {
    $type = 'String';
  }

  echo $column[$i]['Field'] . ':' . $type . ',';
}
?> }[] =[]
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

    findindex' . $table . ': (state, getters) => (id) => {
    return state.' . $table . 's.findIndex(' . $table . ' => ' . $table . '.' . $column[0]['Field'] . ' == id)
    },

    findcontains' . $table . ': (state, getters) => (id) => {
    return state.' . $table . 's.filter(' . $table . ' => ' . $table . '.' . $column[0]['Field'] . '.toLowerCase().includes(this.id))
    },

    detail' . $table . ': (state, getters) => (id) => {
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
      var index = state.' . $table . 's.indexOf(' . $table . ');';


      for ($i = 1; $i < $limit; $i++) {
        echo 'state.' . $table . 's[index].' . $column[$i]['Field'] . ' = data.' . $column[$i]['Field'] . ';';
      }
      echo '
        },
        delete' . $table . '(state, value) {
            var ' . $table . ' = state.' . $table . 's.find(o => o.' . $column[0]['Field'] . ' == value)
            state.' . $table . 's.splice(state.' . $table . 's.indexOf(' . $table . '), 1)
        }';

      ?>
      }

      export const actions: ActionTree<RootState, RootState> = {

        }