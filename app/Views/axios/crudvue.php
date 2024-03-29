export const <?= $table ?> = {
methods:{
getall<?= str_replace('_', '', $table) ?>(){
<?php
$store = '$store';
echo "return axios.get('$url/read', {
    headers: null
});";
?>
},

add<?= str_replace('_', '', $table) ?>(data){
<?php
echo "return axios.post( '$url/create', data, {
    headers: null
});";
?>
},

update<?= str_replace('_', '', $table) ?>(data){
<?php
echo "return axios.post( '$url/update', data, {
    headers: null
});";
?>
},


updatedynamic<?= str_replace('_', '', $table) ?>(data){
<?php
echo "return axios.post( '$url/update_dynamic', data, {
    headers: null
});";
?>
},

detail<?= str_replace('_', '', $table) ?>(id){
<?php
echo "return axios.get( '$url'+'/detail'+id, {
    headers: null
});";
?>
},

delete<?= str_replace('_', '', $table) ?>(id){
<?php
echo "return axios.delete( '$url'+'/delete'+id, {
    headers: null
});";
?>
}
}
}