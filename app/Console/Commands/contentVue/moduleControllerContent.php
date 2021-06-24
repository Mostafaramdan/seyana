<?php

namespace App\Console\Commands\contentVue;
use Illuminate\Support\Str;

class modueControllerContent
{

    public static function Controller ( $fileName){

return
'
<?php
namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\\'.$fileName.' as model;

class '.$fileName.' extends dashboard
{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $records= $this->model::query();
        if($request->search){
            $records->where("name","like","%".$request->search."%");
        }
        $records->orderBy($request->filterBy??"id",$request->filterType??"DESC"); // filter

        $itemPerPage= $request->itemPerPage??self::$itemPerPage;
        $totalPages= ceil($records->count()/$itemPerPage);
        $records= $records->forPage($request->page,$itemPerPage)->get();
        return response()->json([
            "status"=>$records->count()?200:204,
            "totalPages"=>$totalPages,
            "records"=>$records,
        ]);
    }
}
    ';
    }
    public static function  create ( $fileName)
    {
        return
"
<template>
    <div class='m-3' >
    <form @submit.prevent='onSubmit' class='border border-5 border-primary rounded '>
        <h3>
           أنشأ  مرفق جديد
        </h3>
        <hr>
        <div class='form-check '>
            <label  > ادخل الاسم بالعربي  </label>
            <input type='text' v-model='record.name_ar' :class='['form-control' ,{'is-valid':validateName_ar },{'is-invalid':!validateName_ar}]'  >
            <div class='valid-feedback'>
                     صحيح
            </div>
            <div class='invalid-feedback'>
                <span>يجب إدخال الاسم بالعربي بشكل صحيح</span>
            </div>
        </div>
         <div class='form-check '>
            <label  > ادخل عدد الاسم بالانجليزي  </label>
            <input type='text' v-model='record.name_en' :class='['form-control' ,{'is-valid':validateName_en },{'is-invalid':!validateName_en}]'  >
            <div class='valid-feedback'>
                     صحيح
            </div>
            <div class='invalid-feedback'>
                <span>يجب إدخال عدد الاسم بالانجليزي بشكل صحيح</span>
            </div>
        </div>

        <div id='my-strictly-unique-vue-upload-multiple-image' style='display: flex; justify-content: center;'>
            <vue-upload-multiple-image
            @upload-success='uploadImageSuccess'
            @before-remove='beforeRemove'
            @edit-image='editImage'
            :data-images='images'
            idUpload='myIdUpload'
            editUpload='myIdEdit'
            dragText='قم بوضع الصور هنا'
            dropText='اترك الصور هنا'
            :showPrimary='false'
            browseText=' '
            :maxImage='1'
            :maxSizeImage='10'
            ></vue-upload-multiple-image>
        </div>
        <hr>
        <button type='submit' class='btn btn-primary btn-lg mt-2' :disabled='allValidation == false '>
            <span v-if='loading'>
                <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>
                جاري التحميل ...
            </span>
            <span v-else>
                 حفظ
            </span>
        </button>
    </form>
  </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'
export default {
    components: {
        VueUploadMultipleImage,
    },
    data() {
        return {
            loading : false,
            images:[],
            record:{
                name_ar:'',
                name_en:'',
            },
        }
    },
    methods: {
        async uploadImageSuccess(formData, index, fileList) {
             let response=  await this.axios({
                method: 'POST',
                url: '/api/image',
                data:{image:fileList[index].path},
            })
            this.images.push(response.data.image)
        },
        async beforeRemove (index, done, fileList) {
            if (confirm('هل تريد مسح الصورة')) {
                let response=  await this.axios({
                method: 'DELETE',
                url: `/api/image/`+this.images[index].id,
            })
            this.images.splice(index,1)
            }
        },
        async editImage (formData, index, fileList) {

            let image = fileList[index];
            await setTimeout(function () {
                let response=
                    this.axios({
                        method: 'POST',
                        url: `/api/image/`+this.images[index].id,
                        data:{image:fileList[index]['path,_method:'PUT'},
                    }).then((response)=>{
                        this.images[index]= response.data.image
                    })
             }.bind(this), 1000)
        },
        async onSubmit() {
            this.loading=true;
            this.record.images= JSON.stringify( this.images.map(a => a.id));
            let response = await this.Api('POST','".$fileName."',this.record);
            this.loading=false;
            this.$swal('تم الاضافة بنجاح', ', 'success')

        }
    },
    computed: {
        validateName_ar(){
            return this.record.name_ar.length > 3
        },
        validateName_en(){
            return this.record.name_en.length > 3
        },
        allValidation(){
            return this.validateName_ar && this.validateName_en  &&  !this.loading
        }
    },
    mounted(){
        this.$store.state.isLoading = false;
    },
        metaInfo() {
        return {
            title: `".config('app.name')." -  أنشأ جديد `,
        }
    }

  }
</script>
"
        ;
    }
    public static function  update ( $fileName)
    {
        return
    "
    <template>
    <div class='m-3' >
    <form @submit.prevent='onSubmit' class='border border-5 border-primary rounded '>
        <h3>
            تعديل  مرفق
        </h3>
        <hr>
        <div class='form-check '>
            <label  > ادخل الاسم بالعربي  </label>
            <input type='text' v-model='record.name_ar' :class='['form-control' ,{'is-valid':validateName_ar },{'is-invalid':!validateName_ar}]'  >
            <div class='valid-feedback'>
                        صحيح
            </div>
            <div class='invalid-feedback'>
                <span>يجب إدخال الاسم بالعربي بشكل صحيح</span>
            </div>
        </div>
            <div class='form-check '>
            <label  > ادخل عدد الاسم بالانجليزي  </label>
            <input type='text' v-model='record.name_en' :class='['form-control' ,{'is-valid':validateName_en },{'is-invalid':!validateName_en}]'  >
            <div class='valid-feedback'>
                        صحيح
            </div>
            <div class='invalid-feedback'>
                <span>يجب إدخال عدد الاسم بالانجليزي بشكل صحيح</span>
            </div>
        </div>

        <div id='my-strictly-unique-vue-upload-multiple-image' style='display: flex; justify-content: center;'>
            <vue-upload-multiple-image
            @upload-success='uploadImageSuccess'
            @before-remove='beforeRemove'
            @edit-image='editImage'
            :data-images='images'
            idUpload='myIdUpload'
            editUpload='myIdEdit'
            dragText='قم بوضع الصور هنا'
            dropText='اترك الصور هنا'
            :showPrimary='false'
            browseText=' '
            :maxImage='1'
            :maxSizeImage='10'
            ></vue-upload-multiple-image>
        </div>
        <hr>
        <button type='submit' class='btn btn-primary btn-lg mt-2' :disabled='allValidation == false '>
            <span v-if='loading'>
                <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>
                جاري التحميل ...
            </span>
            <span v-else>
                    حفظ
            </span>
        </button>
    </form>
    </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'

    export default {
    components: {
        VueUploadMultipleImage,
    },
    data() {
        return {
            loading : false,
            images:[],
            record:{
                name_ar:'',
                name_en:'',
            },
        }
    },
    methods: {
        async uploadImageSuccess(formData, index, fileList) {
                let response=  await this.axios({
                method: 'POST',
                url: '/api/image',
                data:{image:fileList[index].path},
            })
            this.images.push(response.data.image)
        },
        async beforeRemove (index, done, fileList) {
            if (confirm('هل تريد مسح الصورة')) {
                let response=  await this.axios({
                method: 'DELETE',
                url: `/api/image/${this.images[index].id}`,
            })
            this.images.splice(index,1)
            }
        },
        async editImage (formData, index, fileList) {

            let image = fileList[index];
            await setTimeout(function () {
                let response=     this.axios({
                    method: 'POST',
                    url: `/api/image/`+fileList[index].id,
                    data:{image:fileList[index].path,_method:'PUT'},
                }).then((response)=>{
                    this.images[index]= response.data.image
                })
                }.bind(this), 1000)
        },
        async onSubmit() {
            this.loading=true;
            this.record.images= JSON.stringify( this.images.map(a => a.id));
            let response = await this.Api('PUT',`attachments/${this.record.id}`,this.record);
            this.loading=false;
                this.$swal('تم التعديل بنجاح', ', 'success')
        }
    },
    computed: {
        validateName_ar(){
            return this.record.name_ar.length > 3
        },
        validateName_en(){
            return this.record.name_en.length > 3
        },
        allValidation(){
            return this.validateName_ar && this.validateName_en  &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`attachments/${this.$route.params.id}`);
        this.record = response.data.record;
        this.images = response.data.record.images;
    },
    metaInfo() {
        return {
            title: `'.config('app.name').' -  تعديل مرفق  `,
        }
    }

    }
</script>
            "   ;
        }
    public static function  index ( $fileName)
    {
        return
        "
<template >
    <div>
        <div class='input-group mb-3'>
            <input type='search' class='form-control' v-model.trim='search' list='wizards-list' placeholder=' ابحث من هنا ' aria-label='Example text with button addon' aria-describedby='button-addon1'>
            <button v-b-modal.new-swap-shift-modal class='btn  btn-outline-primary' type='button' id='button-addon1'><i class='fas fa-filter'></i> فلترة </button>
        </div>

        <b-modal id='new-swap-shift-modal' @ok='$router.push({  query: { ...$route.query,...features(),page:1 }})' hide-header-close title='فلترة النتائج' ok-hide='true' ok-title = 'فلترة'  cancel-title = 'إلفاء'>
            <div class='d-block text-center'>
                <div class='form-group' >
                    <label   >ترتيب علي حسب</label>
                    <select class='custom-select' v-model='filterBy'>
                        <option value='name'>الاسم </option>
                        <option value='id'>التاريخ</option>
                    </select>
                </div>
                <div class='form-group' >
                    <label   >نوع الترتيب  </label>
                    <select class='custom-select' v-model='filterType'>
                        <option value='ASC'>تصاعدي </option>
                        <option value='DESC'>تنازلي</option>
                    </select>
                </div>
            </div>
        </b-modal>
        <button class='btn btn-primary m-2 ' @click='create'>
             إضافة
            <i class='fas fa-plus'></i>
        </button>
        <div class='table-responsive'>
            <table class='table table-striped table-dark table-bordered table-hover  mb-2'  >
                <thead >
                    <tr >
                        <th >#</th>
                        <th >الاسم بالعربي </th>
                        <th >الاسم بالانجليزي </th>
                        <th>التفعيل</th>
                        <th >#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show='false'>
                        <div class='text-center mb-3 d-flex justify-content-between'>
                            <b-spinner
                                style='width: 6rem; height: 6rem;'
                                variant='light'
                                key='light'>
                            </b-spinner>
                        </div>
                    </tr>
                    <tr v-for='(record,index) in records' :key='index'>
                        <td>{{record.id}}</td>
                        <td>{{record.name_ar}}</td>
                        <td>{{record.name_en}}</td>
                        <td>
                            <label class='switch'>
                                <input type='checkbox' @click='toggle('is_active',record.id)'  v-model='record.is_active' >
                                <span class='slider round'></span>
                            </label>
                        </td>
                        <td>
                            <button class='btn btn-danger' @click='deleteRecord(index)'><i class='fas fa-trash '></i></button>
                            <button class='btn btn-info' @click='update(index)'><i class='fas fa-edit'></i></button>
                            <button class='btn btn-secondary' @click='show(index)'><i class='fas fa-eye '></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination :currentPage='parseInt($route.query.page?$route.query.page:1)'  :totalPages='totalPages' @paginate='paginate($event)'></pagination>
        </div>
    </div>
</template>
<script>
import Pagination from '../../components/layouts/pagination.vue';

export default {
    components:{
        Pagination
    },
    data(){
        return {
            records:[],
            currentPage: this.$route.query.page?? 1,
            totalPages:0,
            search:'',
            filterBy:'id',
            filterType:'DESC',
            timeOut :false,
        }
    },
    methods:{
        show() {
            this.visible = true
        },
        create(){
             this.$router.push( {name:'attachmentsCreate',});
        },
        update(index){
             this.$router.push( {name:'attachmentsUpdate', params: { id: this.records[index].id }});
        },
        show(index){
             this.$router.push( {name:'attachmentsShow' , params: { id: this.records[index].id }});
        },
        async paginate(currentPage){
            this.$router.push({  query: { ...this.$route.query,'page': currentPage }});
        },
        async getRecords(){

            let response = await this.Api('GET','attachments',this.features());
            this.records=response.data.records ;
            this.totalPages=response.data.totalPages ;
        },
         async deleteRecord(index){

            if(confirm('هل انت متأكد من مسح هذا العنصر')){
                await this.Api('DELETE',`attachments/${this.records[index].id}`);
                this.records.splice(index,1);
            }
        },
        features:function(){
            return {
                'page':this.currentPage,
                'search':this.search,
                'filterBy':this.filterBy,
                'filterType':this.filterType,
            };
        }
    },
    async mounted(){

        await this.getRecords();
    },
    metaInfo() {
        return {
            title: `'.config('app.name').' -  ".$fileName."   `,

        }
    },
    watch :{
        search:function(val){
            clearTimeout(this.timeOut);
            this.timeOut=
            setTimeout(()=>{
                this.$store.state.isLoading = false;
                this.$router.push({  query: { ...this.$route.query,...this.features(),page:1 }});
            },1000)
        },
        $route:function(){
            this.currentPage= this.$route.query.page;
            this.getRecords();
        }
    }

}
</script>

";
    }
    public static function show ( $fileName){
return
"
<template >
    <div>

        <div class='row row-cols-1 row-cols-md-1 '>
            <div class='col'>
                <div class='card ' >
                    <div class='card-body'>
                        <vue-easy-lightbox
                                :imgs='record.images'
                                scDisabled
                                moveDisabled
                                :visible='visible'
                                :index='0'
                                @hide='visible=false'
                            ></vue-easy-lightbox>
                        <h5 class='card-title'>الصور :
                            <button class='btn btn-info w-25'  @click='visible=true'>
                                <i class='fas fa-image' ></i>
                            </button>
                        </h5>

                        <h5 class='card-title'>الاسم بالعربي  : {{ record.name_ar }}</h5>
                        <h5 class='card-title'>الاسم بالانجليزي  : {{ record.name_en }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    components:{
    },
    data(){
        return {
            record:{},
            slide: 0,
            sliding: null,
            visible:false
        }
    },
    methods:{
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        }

    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`attachments/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `'.config('app.name').' -  ".$fileName."   `,
        }
    }
}
</script>
<style scoped>
    .example-slide {
        align-items: center;
        background-color: #666;
        color: #999;
        display: flex;
        font-size: 1.5rem;
        justify-content: center;
        min-height: 10rem;
    }
</style>

";
    }
    public static function routes ( $fileName)
{
    return "
import ".$fileName." from '@/pages/".$fileName."/index';
import create from '@/pages/".$fileName."/create';
import update from '@/pages/".$fileName."/update';
import show from '@/pages/".$fileName."/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/".$fileName."`,
        name: `".$fileName."`,
        component: ".$fileName.",
    },
    {
        path: `${baseDash}/".$fileName."/create`,
        name: `".$fileName."Create`,
        component: create,
    },
    {
        path: `${baseDash}/".$fileName."/update/:id`,
        name: `".$fileName."Update`,
        component: update,
    },
    {
        path: `${baseDash}/".$fileName."/:id`,
        name: `".$fileName."Show`,
        component: show,
    }
];

    ";
}

}
