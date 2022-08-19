<div id="apps" class="col-xl-12" style="margin-bottom: 250px;">
    <div class="card">
        <div class="card-body">
            <input type="file" name="files" @change="uploadFile" id="fileupload" />
        </div>
        <div class="card-body">
            <fieldset v-for="item,ind in list">
                <legend>Title: {{item.title}}</legend>
                <table class="table table-light table-hover  table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Title</td>
                            <td>Method</td>
                            <td>URL</td>
                            <td>Body</td>
                            <td>Expected</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody v-for="items,index in item.item">
                        <tr>
                            <td>{{index+1}}</td>
                            <td>{{items.title}}</td>
                            <td>{{items.method}}</td>
                            <td>{{items.url}}</td>
                            <td>{{JSON.stringify(items.body)}}</td>
                            <td>{{JSON.stringify(items.expected)}}</td>
                            <td>
                                <button @click="delRequest(ind,index)" class="form-control btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <form action="#" type="post" class="row">
                    <div class="form-group col-sm-12 col-lg-6 mt-3">
                        <input v-model="form.title" type="text" name="" id="input" class="form-control" required="required" title="" placeholder="title">
                    </div>

                    <div class="form-group col-sm-12 col-lg-6 mt-3">
                        <input v-model="form.url" type="text" name="" id="input" class="form-control" required="required" title="" placeholder="URL">
                    </div>
                    <div class="form-group col-sm-12 col-lg-12 mt-3">
                        <select v-model="form.method" class="form-control">
                            <option>GET</option>
                            <option>POST</option>
                            <option>PUT</option>
                            <option>DELETE</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-lg-6 mt-3">
                        <textarea v-model="form.body" placeholder="Body" id="input" class="form-control" rows="3" required="required"></textarea>
                    </div>
                    <div class="form-group col-sm-12 col-lg-6 mt-3">
                        <textarea v-model="form.expected" placeholder="Expected Result" id="input" class="form-control" rows="3" required="required"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <button @click="addRequest(ind)" type="button" class="form-control submitbutton btn btn-primary">Tambahkan</button>
                    </div>
                </form>

            </fieldset>


            <div class="form-group mt-2">
                <input @keyup.enter="addGroup" v-model="title" type="text" class="form-control" required="required" placeholder="add other new subject">

            </div>


            <div class="form-group">
                <button type="button" id="download" @click="download()" class="form-control submitbutton btn btn-success mt-2">Export</button>
            </div>
            <br>

        </div>
    </div>
</div>

<script>
    new window.Vue({
        el: '#apps',
        components: {},
        mixins: [],
        props: [],
        data() {
            return {
                list: [],
                title: "",
                form: {
                    title: "",
                    method: "GET",
                    url: "",
                    body: "",
                    expected: "",
                    header: {}
                }
            }
        },
        methods: {
            addGroup() {
                if (this.title != "") {
                    this.list.push({
                        title: this.title,
                        item: []
                    })
                    this.title = ""
                }
            },
            addRequest(i) {
                this.form.body = JSON.parse(this.form.body)
                this.form.expected = JSON.parse(this.form.expected)
                this.list[i].item.push(this.form)
            },
            delRequest(i, indexRequest) {
                this.list[i].item.splice(this.list[i].item.indexOf(this.list[i].item[indexRequest]), 1)
            },
            async uploadFile() {
                var ext = $('#fileupload').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['json']) == -1) {
                    alert('invalid extension!');
                    $('#fileupload').val('');
                }

                var file = $("#fileupload").get(0).files[0];
                var data = new FormData();
                data.append("fileupload", file);
                let response = await axios.post('<?= base_url('test/loadjson') ?>', data, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                this.list = response.data
            },
            async download() {
                var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(this.list));
                var downloadAnchorNode = document.createElement('a');
                downloadAnchorNode.setAttribute("href", dataStr);
                downloadAnchorNode.setAttribute("download", "result.json");
                document.body.appendChild(downloadAnchorNode); // required for firefox
                downloadAnchorNode.click();
                downloadAnchorNode.remove();
            }
        },
        created() {},
    });
</script>