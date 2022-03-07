<template>
    <div class="m-3" v-if="this.authorized.update">
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
            تعديل مزود خدمة
        </h3>
        <hr>
        <div class="form-check ">
            <label  > ادخل الاسم  </label>
            <input type="text" v-model="record.name" :class="['form-control' ,{'is-valid':validateName },{'is-invalid':!validateName}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الاسم بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخل رقم التليفون  </label>
            <input type="text" v-model="record.phone" :class="['form-control' ,{'is-valid':validatePhone },{'is-invalid':!validatePhone}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال رقم التليفون بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخل الايميل  </label>
            <input type="text" v-model="record.email" :class="['form-control' ,{'is-valid':validateEmail },{'is-invalid':!validateEmail}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الايميل- بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخل الرقم السري  </label>
            <input type="password" v-model="record.password" :class="['form-control' ,{'is-valid':validatePassword },{'is-invalid':!validatePassword}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الرقم السري- بشكل صحيح</span>
            </div>
        </div>
        <br>
        <div class="form-check ">
            <multiselect
                @remove='removeOption '
                @select='selectOption'
                :multiple='true'
                label='name_ar'
                v-model="selected_value"
                :options="categories"
                placeholder='اختر الاقسام التي يعمل بها مزود الخدمة'
                class='form-control'>
            </multiselect>
        </div>
        <br>
        <div class="form-check ">
            <label  > ادخل الرصيد  </label>
            <input type="text" v-model="record.balance" :class="['form-control' ,{'is-valid':validateBalance },{'is-invalid':!validateBalance}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>

            <div class="invalid-feedback">
                <span>يجب إدخال الرصيد بشكل صحيح</span>
            </div>
        </div>
        <div id="my-strictly-unique-vue-upload-multiple-image" style="display: flex; justify-content: center;">
            <vue-upload-multiple-image
            @upload-success="uploadImageSuccess"
            @before-remove="beforeRemove"
            @edit-image="editImage"
            :data-images="images"
            idUpload="myIdUpload"
            editUpload="myIdEdit"
            dragText='قم بوضع الصور هنا'
            dropText='اترك الصور هنا'
            :showPrimary='false'
            browseText=' '
            :maxImage='50'
            :maxSizeImage="10"
            ></vue-upload-multiple-image>
        </div>
        <dropdown-menu
            model="companies"
            @choosen='record.companies_id = $event'
            :records_id='record.companies_id'
            column='name'
            label='الشركة'
            >
        </dropdown-menu>
        <hr>
         <hr>
        <dropdown-menu
            model="regions"
            url='dropdown/districts/regions'
            @choosen='record.regions_id = $event'
            :records_id='record.regions_id'
            column='name_ar'
            label='المنقطة'
            >
        </dropdown-menu>
        <hr>
        <h3> اشتراك مزود الخدمة</h3>
        <br>
        <div class="form-check ">
            <label  > تاريخ بداية الاشتراك   </label>
            <input type="date" v-model="record.subscription_at" :class="['form-control']"  >
        </div>
        <div class="form-check ">
            <label  > تاريخ نهاية الاشتراك   </label>
            <input type="date" v-model="record.subscription_end" :class="['form-control']"  >
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-2" :disabled="allValidation == false ">
            <span v-if="loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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
            categories:[],
            selected_value:'',
            record:{
                name:'',
                email:'',
                phone:0,
                password:''
            },
        }
    },
    methods: {
        removeOption (removedOption){
              this.selected_value.splice(this.selected_value.indexOf(removedOption), 1);
        },
        selectOption(selectedOption){
            if(this.selected_value.length > 0)
                this.selected_value = this.selected_value.filter( obj => obj.id != selectedOption.id);
        },

        async uploadImageSuccess(formData, index, fileList) {
             let response=  await this.axios({
                method: 'POST',
                url: '/api/image',
                data:{image:fileList[index].path},
            })
            this.images.push(response.data.image)
        },
        async beforeRemove (index, done, fileList) {
            if (confirm("هل تريد مسح الصورة")) {
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
                    url: `/api/image/${fileList[index].id}`,
                    data:{image:fileList[index].path,_method:'PUT'},
                }).then((response)=>{
                    this.images[index]= response.data.image
                })
             }.bind(this), 1000)
        },
        async onSubmit() {
            this.loading=true;
            if(this.record.first_subscription== null){
                this.record.first_subscription= this.record.subscription_at;
            }
            this.record.categories_ids= JSON.stringify( this.selected_value.map(obj=>obj.id) )
            this.record.images= JSON.stringify( this.images.map(a => a.id));
            let response = await this.Api('POST',`providers/${this.record.id}`,{...this.record,_method:'PUT'});
            this.loading=false;
            this.$swal("تم التعديل بنجاح", "", "success")
        }
    },
    computed: {
        validatePassword(){
            return this.record.password.length > 2
        },
        validateName(){
            return this.record.name.length > 3
        },
        validateEmail(){
            return true
        },
        validatePhone(){
            return this.record.phone > 8
        },
        validateBalance(){
            return this.record.balance > -1
        },
        allValidation(){
            return this.validatePassword && this.validateName  &&
            this.validateEmail  && this.validatePhone && this.validateBalance  &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`providers/${this.$route.params.id}`);
        this.record = response.data.record;
        this.selected_value = this.record.categories;
        this.categories=response.data.allCategories ;

        this.images = response.data.record.images;
    },
        metaInfo() {
        return {
            title: `${this.$store.state.appName} -   تعديل `,
        }
    }

  }
</script>
