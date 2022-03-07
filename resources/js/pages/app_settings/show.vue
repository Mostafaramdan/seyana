<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >الدولة : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{ record.country ? record.country.name_ar :'' }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  شروط واحكام المستخدمين  بالعربي : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.policyTerms_ar }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  شروط واحكام المستخدمين  بالانجليزي : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.policyTerms_en }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  شروط واحكام المندوبين  بالعربي : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.terms_provider_ar }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  شروط واحكام المندوبين  بالانجليزي : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.terms_provider_en }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  عن التطبيق بالعربي : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.aboutUs_ar }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  عن التطبيق   بالانجليزي : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.aboutUs_en }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >    الرسوم     : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.fees }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >    الضريبة     : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.tax }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >    القيمة المضافة     : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.value_added_tax }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >    ارقام التليفونات     : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> <span v-for="(phone, index) in record.phones" :key="index"> - ({{phone}})  </span></b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >    الايميلات       : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> <span v-for="(email, index) in record.emails" :key="index"> - ({{email}})  </span></b>
                            </div>
                        </div>
                        <hr>
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
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`app_settings/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   الاعدادات `,
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
