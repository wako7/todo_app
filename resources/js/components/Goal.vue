<template>
    <div class="container-fruid h-100 pt-5">
    <!--　Create A New Goalリンクを表示させている
      「goalModal」というIDを持つモーダルのトリガー要素を定義   -->
    <i class="fa fa-plus pl-3" data-toggle="modal" data-target="#goalModal"></i><span class="align-middle"> Create A New Goal</span>

     <!--　Manage Tagリンクを表示させている
      「tagModal」というIDを持つモーダルのトリガー要素を定義   -->
     <i class="fa fa-plus align-middle pl-4 pr-1" data-toggle="modal" data-target="#tagModal"></i><span class="align-middle">Manage Tag</span>

     <!-- ID:goalModalのポップアップ表示(モーダルの親要素) -->
    <div class="modal fade" id="goalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!--modalのヘッダー↓-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Goal Name</h5>
                        <!-- closeボタンを非表示にする↓-->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <!--×ボタン表示 
                            aria-hidden="trueは
                            "WEBページの音声読み上げをアイコンフォントを防止する-->
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <!--modalのボディー↓-->
                <div class="modal-body">
                    <input v-model="title" class="form-control">
                    
                </div>
                <!--modalのフッタ―↓-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="addNewGoal">Add</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ID:taglModalのポップアップ表示(モーダルの親要素) -->
     <div class="modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">New Tag Name</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                 </div>
                 <div class="modal-body">
                     <input v-model="tagTitle" class="form-control">
                     <div v-for="(key, index) in tags" :key="index">
                         <button class="btn btn-secondary m-1" v-on:click="tagTitle = tags[index].title; tagId = tags[index].id" data-toggle="modal" data-target="#editTagModal" data-dismiss="modal">{{ tags[index].title }}</button>
                         <button class="btn btn-danger m-1" v-on:click="deleteTag(tags[index].id)">✖</button>
                     </div>
                 </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click="addNewTag">Add</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.location.reload();">Save changes</button>
                 </div>
             </div>
         </div>
     </div>

     <!-- ID:editTaglModalのポップアップ表示(モーダルの親要素) -->
     <div class="modal fade" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit Tag Name</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#tagModal" v-on:click="tagTitle = ''; tagId = ''">
                             <span aria-hidden="true">&times;</span>
                         </button>
                 </div>
                 <div class="modal-body">
                     <input v-model="tagTitle" class="form-control">
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="editTagTitle(tagId)" >Edit</button>
                     <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#tagModal" v-on:click="tagTitle = ''; tagId = ''">Save changes</button>
                 </div>
             </div>
         </div>
     </div>

     <!-- ID:editGallModalのポップアップ表示(モーダルの親要素) -->
    <div class="modal fade" id="editGoalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Goal Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="editGoalTitle">Edit</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ID:deleteGaollModalのポップアップ表示(モーダルの親要素) -->
    <div class="modal fade" id="deleteGoalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Goal?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deleteGoal">Delete</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card-group h-100">
      <!--v-forディレクティブを使用してgoals配列の要素を表示-->
        <div v-for="(goal, key, index) in goals" :key=index>
          <!--Goal全体のdiv↓-->
            <div class="card h-100 m-3" style="width: 24rem;">
                <!--Goalのtitleのdiv↓-->
                <div class="d-flex justify-content-between">
                    <h3 class="ml-5 mt-2">{{ goal.title }}</h3>
                    <div><h6>{{ goal.created_at.substring(0, 10) }}</h6></div>
                    <div><h6>{{ goal.label }}</h6></div>
                    
                    <div>
                        <p>Add Label(Goal id:{{ goal.id }})</p>
                        <form>
                            <select v-model="label">
                                <option disabled value="">ラベルを選択</option>
                                <option v-for="(label, index) in labels" :key="`label-${index}`" :value="label.id">{{ label.label }}</option>
                            </select>
                            <button type="button" v-on:click="onPost(goal.id)">Add</button>
                        </form>
                    </div>
                    
                    <!--「todoModal」というIDを持つモーダルのトリガー要素を定義しているdiv↓-->
                    <div>
                        <i class="fa fa-plus p-2" data-toggle="modal" :data-target="'#todoModal'+goal.id"></i>
                        <!--Goalのeditとdeleteのポップアップを折りたたむ処理↓-->
                        <div class="btn-group dropdown">
                            <i class="fa fa-ellipsis-v p-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <!--EditとDeleteのポップアップ表示のdev↓-->
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!--「editGoalModal」というIDを持つモーダルのトリガー要素を定義しているdiv↓-->
                                    <div class="text-center" data-toggle="modal" data-target="#editGoalModal" v-on:click="title = goal.title; id = goal.id">Edit</div>
                                    <!--「deleteGoalModal」というIDを持つモーダルのトリガー要素を定義しているdiv↓-->
                                    <div class="text-danger text-center" data-toggle="modal" data-target="#deleteGoalModal" v-on:click="id = goal.id">Delete</div>
                                </div>
                        </div>
                    </div>
                </div>
                <goals-todos :goalId="goal.id"></goals-todos>
            </div>
        </div>
    </div>
</div>   
</template>

<script>
import axios from "axios";
import $ from "jquery";
import Todos from "./Todos.vue";
export default {
    data: function() {
        return {
            id: "",
            title: "",
             tagId: "",
             tagTitle: "",
             goals: [],
             tags: [],
             labels: [],
             label: "",
        };
    },
    components: {
        //外部のTodos.vueファイルを「Todos」というモジュール名で読み込み、そのコンポーネント名を「goals-todos」として登録
        'goals-todos': Todos
    },
    mounted: function () {
        this.getAllGoals();
         this.getAllTags();
         this.getAllLabels();
    },
    methods: {
        getAllGoals: function () {
            axios.get("/goals").then((response) => {
                for(let i = 0; i < response.data.length; i++) {
                    this.goals.push(response.data[i]);
                    console.log("pushした後のgoalsデータ");
                    console.log(this.goals);
                }
            }, (error) => {
                console.log(error);
            });
        },
        addNewGoal: function () {
            axios.defaults.headers['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
            axios.defaults.headers['content-type'] = 'application/json';
            axios.post("/goals", {title: this.title}).then((response) => {
                this.goals.length = 0;
                for (let i = 0; i < response.data.length; i++) {
                    this.goals.push(response.data[i])
                }
            }, (error) => {
                console.log(error)
            })
            this.title = ""
            window.location.reload();
        },
        editGoalTitle: function () {
            axios.defaults.headers['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
            axios.defaults.headers['content-type'] = 'application/json';
            axios.post(`/goals/${this.id}`, {title: this.title, _method: 'patch'}).then((response) => {
                this.goals.length = 0;
                for (let i = 0; i < response.data.length; i++) {
                    this.goals.push(response.data[i])
                }
            }, (error) => {
                console.log(error)
            })
            this.title = ""
        },
        deleteGoal: function () {
            axios.defaults.headers['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
            axios.defaults.headers['content-type'] = 'application/json';
            console.log(this.id)
            axios.post(`/goals/${this.id}`, {_method: 'delete'}).then((response) => {
                this.goals = response.data;
            }, (error) => {
                console.log(error)
            })
            this.id = ""
         },
         getAllTags: function () {
             axios.get("/tags").then((response) => {
                 console.log(response)
                 for(let i = 0; i < response.data.length; i++) {
                     this.tags.push(response.data[i])
                     console.log(this.tags[i])
                 }
                 console.log(this.tags)
             }, (error) => {
                 console.log(error)
             })
         },
         addNewTag: function () {
             axios.defaults.headers['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
             axios.defaults.headers['content-type'] = 'application/json';
             axios.post("/tags", {title: this.tagTitle}).then((response) => {
                 this.tags.length = 0;
                 for (let i = 0; i < response.data.length; i++) {
                     this.tags.push(response.data[i])
                 }
             }, (error) => {
                 console.log(error)
             })
             this.tagTitle = ""
             
             
            //  window.location.reload();
         },
         editTagTitle: function (id) {
             axios.defaults.headers['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
             axios.defaults.headers['content-type'] = 'application/json';
             axios.post(`/tags/${id}`, {title: this.tagTitle, _method: 'patch'}).then((response) => {
                 this.tags.length = 0;
                 for (let i = 0; i < response.data.length; i++) {
                     this.tags.push(response.data[i])
                 }
             }, (error) => {
                 console.log(error)
             })
             this.tagTitle = ""
         },
         deleteTag: function (id) {
             axios.defaults.headers['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
             axios.defaults.headers['content-type'] = 'application/json';
 
             axios.post(`/tags/${id}`, {_method: 'delete'}).then((response) => {
                 this.tags = response.data;
             }, (error) => {
                 console.log(error)
             })
         },
         getAllLabels: function () {
             axios.get("/labels").then((response) => {
                 console.log("JSONで取得したLabelのデータ");
                 console.log(response)
                 for(let i = 0; i < response.data.length; i++) {
                     this.labels.push(response.data[i])
                     console.log("pushしたlabelデータ")
                     console.log(this.labels[i])
                 }
                 console.log("push後のlabelのデータ")
                 console.log(this.labels)
             }, (error) => {
                 console.log(error)
             })
         },
         onPost: function(val) {
            //  console.log("onPostが実行された");
            //  console.log(val);
            //  console.log(this.label);
            axios.post("/post", {goals_id : val, label : this.label}).then((response) => {
            console.log("onPostが実行された");
            console.log(response);
            }, (error) => {
                console.log(error)
            })
        },
    }
}
</script>