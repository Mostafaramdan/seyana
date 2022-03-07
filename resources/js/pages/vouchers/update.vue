<template>
    <div class="m-3" v-if="this.authorized.update">
        <form  @submit.prevent="onSubmit" class="border border-5 border-primary rounded form">
            <h3>
            تعديل كود خصم
            </h3>
            <hr>
            <div class="form-check ">
                <label  > ادخل نسبة الخصم  </label>
                <input type="number" min='1' max='99' v-model="record.discount" :class="['form-control' ,{'is-valid':validateDiscount },{'is-invalid':!validateDiscount}]"  >
                <div class="valid-feedback">
                        صحيح
                </div>
                <div class="invalid-feedback">
                    <span>يجب إدخال الخصم بشكل صحيح</span>
                </div>
            </div>
            <div class="form-check ">
                <label  > ادخل  تاريخ البداية  </label>
                <input type="date" v-model="record.start_at" :class="['form-control' ,{'is-valid':validateStart_at },{'is-invalid':!validateStart_at}]"  >
                <div class="valid-feedback">
                        صحيح
                </div>
                <div class="invalid-feedback">
                    <span>يجب إدخال  تاريخ البداية بشكل صحيح</span>
                </div>
            </div>
            <div class="form-check ">
                <label  > ادخل  تاريخ النهاية  </label>
                <input type="date" v-model="record.end_at" :class="['form-control' ,{'is-valid':validateEnd_at },{'is-invalid':!validateEnd_at}]"  >
                <div class="valid-feedback">
                        صحيح
                </div>
                <div class="invalid-feedback">
                    <span>يجب إدخال  تاريخ النهاية بشكل صحيح</span>
                </div>
            </div>
            <div class="form-check ">
                <label  > ادخال عدد مرات الاستخدام  </label>
                <input type="number" min='1' v-model="record.max_dudction" :class="['form-control' ,{'is-valid':validateMax_dudction },{'is-invalid':!validateMax_dudction}]"  >
                <div class="valid-feedback">
                        صحيح
                </div>
                <div class="invalid-feedback">
                    <span>يجب إدخال عدد مرات الاستخدام بشكل صحيح</span>
                </div>
            </div>
            <div class="form-check ">
                <label  > ادخال عدد الطلبات التي يجب ان يتخطاها العميل حتي يحصل علي الكود  </label>
                <input type="number" min='0' v-model="record.number_of_orders" :class="['form-control' ,{'is-valid':validateNumber_of_orders },{'is-invalid':!validateNumber_of_orders}]"  >
                <div class="valid-feedback">
                        صحيح
                </div>
                <div class="invalid-feedback">
                    <span>يجب إدخال عدد الطلبات بشكل صحيح</span>
                </div>
            </div>
            <div class="form-check ">
                <dropdown-menu
                    model="countries"
                    @choosen='record.countries_id = $event'
                    :records_id='record.countries_id'
                    column='name_ar'
                    label='الدولة'
                    >
                </dropdown-menu>
                <hr>
            </div>
            <div class="row">
                <div class="col-3">
                    <button @click.prevent="randomString(8)" class="btn btn-primary form-control"  > <i class="fas fa-code"></i> </button>
                </div>
                <div class="col-6">
                        <span class="font-weight-bold">{{record.code}}</span>
                </div>
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
                discount:1,
                start_at:'',
                end_at:'',
                max_dudction:1,
                code:'',
            },
        }
    },
    methods: {
        async onSubmit() {
            this.loading=true;
            if(this.record.first_subscription== null){
                this.record.first_subscription= this.record.subscription_at;
            }
            let response = await this.Api('POST',`vouchers/${this.record.id}`,{...this.record,_method:'PUT'});
            this.loading=false;
            this.$swal("تم التعديل بنجاح", "", "success")

        },
        randomString(length) {
            var result = '';
            let chars= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
            this.record.code= result;
        }
    },
    computed: {
        validateCode(){
            return this.record.code.length > 2
        },
        validateDiscount(){
            return this.record.discount > 0
        },
        validateStart_at(){
            return this.record.start_at.length > 3
        },
        validateEnd_at(){
            return this.record.end_at.length > 3

        },
        validateMax_dudction(){
            return this.record.max_dudction
        },
        validateNumber_of_orders(){
            return this.record.number_of_orders > -1
        },
        allValidation(){
            return this.validateDiscount && this.validateStart_at  &&
            this.validateEnd_at && this.validateMax_dudction  &&
            this.validateNumber_of_orders  &&  this.validateCode &&  !this.loading
        }
    },
    async mounted(){
        let response = await this.Api('GET',`vouchers/${this.$route.params.id}`);
        this.record = response.data.record;
    },
        metaInfo() {
        return {
            title: `${this.$store.state.appName} -   تعديل كود خصم    `,
        }
    }

  }
</script>
