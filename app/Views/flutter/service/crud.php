import 'package:http/http.dart' as http;

String home = APIhelper.baseurl;
String _create = '$home/<?= $url ?>create';
String _read = '$home/<?= $url ?>read';
String _update = '$home/<?= $url ?>update';
String _updatedynamic = '$home/<?= $url ?>update_dynamic';
String _delete = '$home/<?= $url ?>delete';
String _detail = '$home/<?= $url ?>detail';

class <?= ucfirst(str_replace("_", "", $table)) ?>Service {

static Future create(Map<String,String> bodyReq, Map<String,String> headers) async{
var request = http.Request('POST', Uri.parse(_create));
request.bodyFields = bodyReq;
request.headers.addAll(headers);

http.StreamedResponse response = await request.send();
var jsonData = await response.stream.bytesToString();

return jsonData;
}

static Future read(Map<String,String> headers) async{
var request = http.Request('GET', Uri.parse(_read));
request.headers.addAll(headers);

http.StreamedResponse response = await request.send();
var jsonData = await response.stream.bytesToString();

return jsonData;
}

static Future update(Map<String,String> bodyReq, Map<String,String> headers) async{
var request = http.Request('POST', Uri.parse(_update));
request.bodyFields = bodyReq;
request.headers.addAll(headers);

http.StreamedResponse response = await request.send();
var jsonData = await response.stream.bytesToString();

return jsonData;
}

static Future updatedynamic(Map<String,String> bodyReq, Map<String,String> headers) async{
var request = http.Request('POST', Uri.parse(_updatedynamic));
request.bodyFields = bodyReq;
request.headers.addAll(headers);

http.StreamedResponse response = await request.send();
var jsonData = await response.stream.bytesToString();

return jsonData;
}

static Future delete(String bodyReq, Map<String,String> headers) async{
var request = http.Request('POST', Uri.parse(_delete+'/'+bodyReq));
request.headers.addAll(headers);

http.StreamedResponse response = await request.send();
var jsonData = await response.stream.bytesToString();

return jsonData;
}

static Future detail(String bodyReq, Map<String,String> headers) async{
var request = http.Request('POST', Uri.parse(_detail+'/'+bodyReq));
request.headers.addAll(headers);

http.StreamedResponse response = await request.send();
var jsonData = await response.stream.bytesToString();

return jsonData;
}

}