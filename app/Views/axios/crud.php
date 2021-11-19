getall(){
<?php
echo "axios.get(baseUrl + url, {
    headers: headers
}).then((response) => {
    console.log(response);
}).catch((error) => {
    console.log(error);
});";
?>
}

add<?= str_replace('_', '', $table) ?>(data){
<?php
echo " axios.post(baseUri + url, data, {
    headers: header
}).then((response) => {
    console.log('response.data');
})
.catch((error) => {
    console.log(error);
});";
?>
}

update<?= str_replace('_', '', $table) ?>(data){
<?php
echo " axios.post(baseUri + url, data, {
    headers: header
}).then((response) => {
    console.log('response.data');
})
.catch((error) => {
    console.log(error);
});";
?>
}

detail<?= str_replace('_', '', $table) ?>(id){
<?php
echo "axios.get(baseUrl + url+'/'+id, {
    headers: headers
}).then((response) => {
    console.log(response);
}).catch((error) => {
    console.log(error);
});";
?>
}

delete<?= str_replace('_', '', $table) ?>(id){
<?php
echo "axios.delete(baseUrl + url+'/'+id, {
    headers: headers
}).then((response) => {
    console.log(response);
}).catch((error) => {
    console.log(error);
});";
?>
}