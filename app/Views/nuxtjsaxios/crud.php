export default {
    methods: {
getall<?= str_replace('_', '', $table) ?>(header){
<?php
$store = '$store';
echo 'return this.$axios.$get("' . $url . '/read", {
    headers: header
});';
?>
},

getpage<?= str_replace('_', '', $table) ?>(data,header){
<?php
$store = '$store';
echo 'return this.$axios.$get("' . $url . '/pagination"+data, {
    headers: header
});';
?>
},

add<?= str_replace('_', '', $table) ?>(data,header){
<?php
echo 'return this.$axios.$post("' . $url . '/create", data, {
    headers: header
});';
?>
},

update<?= str_replace('_', '', $table) ?>(data,header){
<?php
echo 'return this.$axios.$post("' . $url . '/update", data, {
    headers: header
});';
?>
},

updatedynamic<?= str_replace('_', '', $table) ?>(data,header){
<?php
echo 'return this.$axios.$post("' . $url . '/update_dynamic", data, {
    headers: header
});';
?>
},

detail<?= str_replace('_', '', $table) ?>(id,header){
<?php
echo 'return this.$axios.$get("' . $url . '/detail/"+id, {
    headers: header
});';
?>
},

delete<?= str_replace('_', '', $table) ?>(id,header){
<?php
echo 'return this.$axios.$delete("' . $url . '/delete/"+id, {
    headers: header
});';
?>
},
}
}