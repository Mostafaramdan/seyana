<template>
    <div class="m-3" v-if="this.authorized.update">
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
           تعديل العنصر
        </h3>
        <hr>
        <div class="form-check ">
            <label  > ادخل الاسم بالعربي  </label>
            <input type="text" v-model="record.name_ar" :class="['form-control' ,{'is-valid':validateName_ar },{'is-invalid':!validateName_ar}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الاسم بالعربي بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل عدد الاسم بالانجليزي  </label>
            <input type="text" v-model="record.name_en" :class="['form-control' ,{'is-valid':validateName_en },{'is-invalid':!validateName_en}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال عدد الاسم بالانجليزي بشكل صحيح</span>
            </div>
        </div>
        <br>
         <div class="form-check ">
            <label  > ادخل   السعر  </label>
            <input type="number" v-model="record.price" :class="['form-control' ,{'is-valid':validatePrice },{'is-invalid':!validatePrice}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال السعر بشكل صحيح</span>
            </div>
        </div>
        <br>
         <div class="form-check col-4">
            <label  > ادخل  فترة الضمان (عدد الشهور)  </label>
            <input type="number" v-model="record.warranty_period" :class="['form-control' ,{'is-valid':validateWarranty_period },{'is-invalid':!validateWarranty_period}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال فترة الضمان بشكل صحيح</span>
            </div>
        </div>
        <br>
        <div class=" col-4" >
            <label  > ادخل  نوع فترة الضمان (عدد الشهور)  </label>
            <select type="number" v-model="record.warranty_type" class="form-control"  >
                <option value="days">يوم</option>
                <option value="months">شهر</option>
                <option value="years">سنة</option>
            </select>
        </div>
        <br>

        <dropdown-menu
            model="categories"
            @choosen='record.categories_id = $event'
            :records_id='record.categories_id'
            column='name_ar'
            label='القسم'
            >
        </dropdown-menu>
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
import VueUploadMultipleImage from 'vue-upload-multiple-image'

  export default {
    components: {
        VueUploadMultipleImage
    },
    data() {
        return {
            loading : false,
            record:{
                name_ar:'',
                name_en:'',
                price: 0,
                warranty_period:0,
                categories_id:''
            },
        }
    },
    methods: {
        async onSubmit() {
            this.loading=true;
            let response = await this.Api('POST',`services/${this.record.id}`,{...this.record,_method:'PUT'});
            this.loading=false;
            this.$swal("تم الاضافة بنجاح", "", "success")

        }
    },
    computed: {
        validateName_ar(){
            return this.record.name_ar.length > 3
        },
        validateName_en(){
            return this.record.name_en.length > 3
        },
        validatePrice(){
            return this.record.price > 0
        },
        validateWarranty_period(){
            return this.record.warranty_period > 0
        },
        allValidation(){
            return this.validateName_ar && this.validateName_en && this.validatePrice && this.validateWarranty_period  &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`services/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   تعديل العنصر  `,
        }
    }
  }
</script>
