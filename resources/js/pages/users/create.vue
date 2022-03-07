<template>
    <div class="m-3" v-if="this.authorized.create">
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
           أنشأ عميل جديد
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
            <label  > ادخل الرسوم  </label>
            <input type="text" v-model="record.fees" :class="['form-control' ]"  >
        </div>
        <div class="form-check ">
            <label  > ادخل رصيد  </label>
            <input type="text" v-model="record.balance" :class="['form-control' ]"  >
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
        <!-- <div id="my-strictly-unique-vue-upload-multiple-image" style="display: flex; justify-content: center;">
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
        </div> -->
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
            record:{
                name:'',
                email:'',
                phone:0,
                password:'',
                fees:'',
                balance:''
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
            let response = await this.Api('POST','users',this.record);
            this.loading=false;
            this.$swal("تم الاضافة بنجاح", "", "success")
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
            return this.record.email.length > 3 && this.record.email.includes('@')
        },
        validatePhone(){
            return this.record.phone > 8
        },
        allValidation(){
            return this.validatePassword && this.validateName  &&
            this.validateEmail  && this.validatePhone  &&  !this.loading
        }
    },
    mounted(){
        this.$store.state.isLoading = false;
    },
        metaInfo() {
        return {
            title: `${this.$store.state.appName} -  أنشأ عميل جديد`,
        }
    }

  }
</script>
