<?php

namespace App\Controllers\Master\JS;

use App\Controllers\BaseController;
use App\Models\Console;

class Vuex extends BaseController
{
    public function __construct()
    {
        $this->cmd = new Console();
    }
    public function getter()
    {
        $db = $this->request->getVar('db');
        $table = $this->request->getVar('table');
        $data['table'] = $table;
        $data['column'] = $this->cmd->show_column($db, $table);

        echo '
		getall' . $table . '(state) {
            return state.' . $table . 's
        },

        filter' . $table . '(state) {
            return state.' . $table . 's.filter(' . $table . ' => {
                return ' . $table . '.' . $data['column'][0]['Field'] . '
				///parameter
            })
        },

        findindex' . $table . ':  (state, getters) => (id) => {
            return state.' . $table . 's.findIndex(' . $table . ' => ' . $table . '.' . $data['column'][0]['Field'] . ' == id)
        },

        findcontains' . $table . ':  (state, getters) => (id) => {
            return state.' . $table . 's.filter(' . $table . ' => ' . $table . '.' . $data['column'][0]['Field'] . '.toLowerCase().includes(this.id))
        },

        detail' . $table . ':  (state, getters) => (id) => {
            return state.' . $table . 's.find(' . $table . ' => ' . $table . '.' . $data['column'][0]['Field'] . ' == id)
        },';
    }

    public function mutation()
    {
        $db = $this->request->getVar('db');
        $table = $this->request->getVar('table');
        $data['table'] = $table;
        $data['column'] = $this->cmd->show_column($db, $table);
        $limit = count($data['column']);
        echo '
        get' . $table . '(state, data) {
            state.' . $table . 's=data;
        },

        add' . $table . '(state, data) {
            state.' . $table . 's.push(data);
        },
        update' . $table . '(state, data) {
            var ' . $table . ' = state.' . $table . 's.find(o => o.' . $data['column'][0]['Field'] . ' == data.' . $data['column'][0]['Field'] . ')
            var index = state.' . $table . 's.indexOf(' . $table . ');';


        for ($i = 1; $i < $limit; $i++) {
            echo 'state.' . $table . 's[index].' . $data['column'][$i]['Field'] . ' = data.' . $data['column'][$i]['Field'] . ';';
        }

        echo '
        },
        delete' . $table . '(state, value) {
            var ' . $table . ' = state.' . $table . 's.find(o => o.' . $data['column'][0]['Field'] . ' == value)
            state.' . $table . 's.splice(state.' . $table . 's.indexOf(' . $table . '), 1)
        }';
    }

    public function nuxt_store()
    {
        $db = $this->request->getVar('db');
        $table = $this->request->getVar('table');
        $data['table'] = $table;
        $data['column'] = $this->cmd->show_column($db, $table);
        $limit = count($data['column']);
        $data['limit'] = $limit;

        return view('vuex/nuxt_store', $data);
    }
}
