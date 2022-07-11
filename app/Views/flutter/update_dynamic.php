isLoading(true);
try {
var todos = await <?= ucfirst($table) ?>Service.updatedynamic(bodyReq,headers);
List<modelList> respons = modelListFromJson(todos) as List<modelList>;
dataList.assignAll(respons);
} finally {
isLoading(false);
}
update();