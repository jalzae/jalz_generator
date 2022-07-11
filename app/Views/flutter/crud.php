class <?= ucfirst(str_replace("_", "", $table)) ?>Controller extends GetxController {
var isLoading = true.obs;
var dataList = <modelList>[].obs;
    var headers;
    @override
    void onInit() {
    SharedPreferences prefs = await SharedPreferences.getInstance();

    String token = prefs.getString('token') as String;
    headers = {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Token': token,
    };

    super.onInit();
    }

    void create<?= $table ?>(Map<String,String> bodyReq) async{
        <?= $this->include('flutter/create') ?>
        }

        void read<?= $table ?>() async{
        <?= $this->include('flutter/read') ?>
        }

        void update<?= $table ?>(Map<String,String> bodyReq) async{
            <?= $this->include('flutter/update') ?>
            }

            void updatedynamic<?= $table ?>(Map<String,String> bodyReq) async{
                <?= $this->include('flutter/update_dynamic') ?>
                }

                void delete<?= $table ?>(String bodyReq) async{
                <?= $this->include('flutter/delete') ?>
                }
                void detail<?= $table ?>(String bodyReq) async{
                <?= $this->include('flutter/detail') ?>
                }

                }