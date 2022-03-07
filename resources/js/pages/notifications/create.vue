<template>
    <div class="m-3" v-if="this.authorized.create">
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
            إرسال إشعار جديد
        </h3>
        <hr>
        <div class="form-check ">
            <label  > ادخل المحتوي بالعربي  </label>
            <input type="text" v-model="record.content_ar" :class="['form-control' ,{'is-valid':validateContent_ar },{'is-invalid':!validateContent_ar}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال المحتوي بالعربي بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل عدد المحتوي بالانجليزي  </label>
            <input type="text" v-model="record.content_en" :class="['form-control' ,{'is-valid':validateContent_en },{'is-invalid':!validateContent_en}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال عدد المحتوي بالانجليزي بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check mt-3">
            <label >اختر النوع الموجه له هذا الاشعار</label>
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" v-model='record.to'>
                <option value="users">العملاء</option>
                <option value="providers">مزودي الخدمات</option>
            </select>
        </div>
        <hr>

        <div>
            <div class="form-check form-check-inline">
                <label class="form-check-label mr-2" for="inlineCheckbox1" > كل الدول </label>
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" v-model='allCountries'>
            </div>
            <br>
            <br>
            <dropdown-menu v-if='!allCountries'
                model="countries"
                @choosen='record.countries_id = $event'
                :records_id='record.countries_id'
                column='name_ar'
                label='الدولة'
                >
            </dropdown-menu>
            <hr>
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

  export default {
    components: {
    },
    data() {
        return {
            loading : false,
            allCountries:true,
            record:{
                content_ar:'',
                content_en:'',
                type:'dashboard',
                to:'users',
                created_at :new Date() / 1000
            },
        }
    },
    methods: {

        async onSubmit() {
            this.loading=true;
            let response = await this.Api('POST','notifications',this.record);
            this.loading=false;
            this.$swal("تم الاضافة بنجاح", "", "success")

        }
    },
    computed: {
        validateContent_ar(){
            return this.record.content_ar.length > 3
        },
        validateContent_en(){
            return this.record.content_en.length > 3
        },
        allValidation(){
            return this.validateContent_ar && this.validateContent_en  &&  !this.loading
        }
    },
    mounted(){
        this.$store.state.isLoading = false;
    },
        metaInfo() {
        return {
            title: `${this.$store.state.appName} -  إرسال إشعار جديد  `,
        }
    }

  }
</script>
