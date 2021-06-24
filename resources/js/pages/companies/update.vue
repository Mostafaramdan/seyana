<template>
    <div class="m-3" v-if="this.authorized.update">
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
           أنشأ  شركة جديدة
        </h3>
        <hr>
        <div class="form-check ">
            <dropdown-menu
                model="countries"
                @choosen='record.countries_id = $event'
                :records_id='record.countries_id'
                column='name_ar'
                label='الدولة'
                >
            </dropdown-menu>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل الاسم   </label>
            <input type="text" v-model="record.name" :class="['form-control' ,{'is-valid':validateName },{'is-invalid':!validateName}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الاسم  بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل  رقم التليفون  </label>
            <input type="text" v-model="record.phone" :class="['form-control' ,{'is-valid':validatePhone },{'is-invalid':!validatePhone}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال التليفون بشكل صحيح</span>
            </div>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل الايميل   </label>
            <input type="text" v-model="record.email" :class="['form-control']"  >
        </div>
         <div class="form-check ">
            <label  > ادخل  الوصف   </label>
            <input type="text" v-model="record.description" :class="['form-control']" >
        </div>
        <hr>
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

  export default {
    components: {
    },
    data() {
        return {
            loading : false,
            record:{
                name:'',
                email:'',
                phone:'',
                description:'',
            },
        }
    },
    methods: {
        async onSubmit() {
            this.loading=true;
            let response = await this.Api('PUT',`companies/${this.record.id}`,this.record);
            this.loading=false;
            this.$swal("تم التعديل بنجاح", "", "success")
        }
    },
    computed: {
        validateName(){
            return this.record.name.length > 3
        },
        validateEmail(){
            return this.record.email.length > 3
        },
        validatePhone(){
            return this.record.phone.length > 3
        },
        allValidation(){
            return this.validateName && this.validatePhone  &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`companies/${this.$route.params.id}`);
        this.record = response.data.record;
        this.images = response.data.record.image;
    },
        metaInfo() {
        return {
            title: `${this.$store.state.appName} -  تعديل شركة  `,
        }
    }

  }
</script>
