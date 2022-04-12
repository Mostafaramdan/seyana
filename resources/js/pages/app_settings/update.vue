<template>
    <div class="m-3" v-if="this.authorized.update">
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
           تعديل  اعدادات
           <span  v-if="record.country">({{record.country.name_ar}})</span>
        </h3>
        <!-- <hr>
        <div class="form-check " v-if="record.country">
            <dropdown-menu
                model="countries"
                @choosen='record.countries_id = $event'
                :records_id='record.country.id'
                column='name_ar'
                label='الدولة'
                >
            </dropdown-menu>
            <hr>
        </div> -->
        <div  class="form-check m-2 ">
            <label for="tags-phones">ادخل أرقام التليفونات</label>
            <b-form-tags input-id="tags-phones" v-model="phones" class="form-control" ></b-form-tags>
        </div>
        <hr>
        <div  class="form-check m-2 ">
            <label for="tags-emails">ادخل الايميلات </label>
            <b-form-tags input-id="tags-emails" v-model="emails"  class="form-control"></b-form-tags>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل  شروط واحكام المستخدمين  بالعربي   </label>
            <textarea type="text" v-model="record.policyTerms_ar" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل  شروط واحكام المستخدمين  بالانجليزي   </label>
            <textarea type="text" v-model="record.policyTerms_en" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل  شروط واحكام المندوبين  بالعربي   </label>
            <textarea type="text" v-model="record.terms_provider_ar" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل  شروط واحكام المندوبين  بالانجليزي   </label>
            <textarea type="text" v-model="record.terms_provider_en" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل عن التطبيق بالعربي   </label>
            <textarea type="text" v-model="record.aboutUs_ar" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل عن التطبيق بالانجليزي   </label>
            <textarea type="text" v-model="record.aboutUs_en" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل الخصوصية  بالعربي   </label>
            <textarea type="text" v-model="record.privacy_ar" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل الخصوصية بالانجليزي   </label>
            <textarea type="text" v-model="record.privacy_en" :class="['form-control' ]"  ></textarea>
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل الرسوم </label>
            <input type="number" v-model="record.fees" :class="['form-control' ]"  >
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل الضريبة </label>
            <input type="number" v-model="record.tax" :class="['form-control' ]"  >
        </div>
        <hr>
        <div class="form-check ">
            <label  > ادخل القيمة المضافة </label>
            <input type="number" v-model="record.value_added_tax" :class="['form-control' ]"  >
        </div>
        <hr>

        <div class="form-check ">
            <label  > ادخل نطاق البحث بالكيلومتر </label>
            <input type="number" v-model="record.distance" :class="['form-control' ]"  >
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
            emails:[],
            phones:[],
            record:{
                countries_id:'',
                policyTerms_ar:'',
                policyTerms_en:'',
                aboutUs_ar:'',
                aboutUs_en:'',
                privacy_ar:'',
                privacy_en:'',
                emails:'',
                phones:'',
                fees:'',
            },
        }
    },
    methods: {
        async onSubmit() {
            this.loading=true;
            this.record.phones= JSON.stringify(this.phones);
            this.record.emails= JSON.stringify(this.emails);
            let response = await this.Api('PUT',`app_settings/${this.record.id}`,{...this.record});
            this.loading=false;
            this.$swal("تم التعديل بنجاح", "", "success")

        }
    },
    computed: {
        validateCountries_id(){
            return this.record.countries_id > 0
        },
        allValidation(){
            return this.validateCountries_id   &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`app_settings/${this.$route.params.id}`);
        this.record = response.data.record;
        this.phones = response.data.record.phones;
        this.emails = response.data.record.emails;
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   تعديل اعدادات  `,
        }
    }

  }
</script>
