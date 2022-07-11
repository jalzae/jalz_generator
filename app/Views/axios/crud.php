getall<?= str_replace('_', '', $table) ?>(){
<?php
$store = '$store';
echo "axios.get('$url/read', {
    headers: null
}).then((response) => {
    console.log(response);
    this.$store.commit('get$table',response.data.array);
}).catch((error) => {
    console.log(error);
});";
?>
},

add<?= str_replace('_', '', $table) ?>(data){
<?php
echo " axios.post( '$url/create', data, {
    headers: null
}).then((response) => {
    console.log(response.data);
    this.$store.commit('add$table',response.data.data);
})
.catch((error) => {
    console.log(error);
});";
?>
},

update<?= str_replace('_', '', $table) ?>(data){
<?php
echo " axios.post( '$url/update', data, {
    headers: null
}).then((response) => {
    console.log(response.data);
    this.$store.commit('update$table',response.data);
})
.catch((error) => {
    console.log(error);
});";
?>
},

detail<?= str_replace('_', '', $table) ?>(id){
<?php
echo "axios.get( '$url'+'/detail'+id, {
    headers: null
}).then((response) => {
    console.log(response);
    this.$store.commit('update$table',id);
}).catch((error) => {
    console.log(error);
});";
?>
},

delete<?= str_replace('_', '', $table) ?>(id){
<?php
echo "axios.delete( '$url'+'/delete'+id, {
    headers: null
}).then((response) => {
    console.log(response);
    this.$store.commit('delete$table',id);
}).catch((error) => {
    console.log(error);
});";
?>
},