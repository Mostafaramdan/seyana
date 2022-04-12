<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >الدولة : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{ record.country ? record.country.name_ar :'' }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >  شروط واحكام المستخدمين  بالعربي : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.policyTerms_ar }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >  شروط واحكام المستخدمين  بالانجليزي : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.policyTerms_en }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >  شروط واحكام المندوبين  بالعربي : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.terms_provider_ar }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >  شروط واحكام المندوبين  بالانجليزي : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.terms_provider_en }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >  عن التطبيق بالعربي : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.aboutUs_ar }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >  عن التطبيق   بالانجليزي : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.aboutUs_en }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >    الرسوم     : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.fees }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >    الضريبة     : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.tax }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >    القيمة المضافة     : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> {{record.value_added_tax }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >    ارقام التليفونات     : </h3></label>
                            </div>
                            <div class="col-md-9">
                                <b> <span v-for="(phone, index) in record.phones" :key="index"> - ({{phone}})  </span></b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 ">
                                <label><h3 >    الايميلات       : </h3></label>
                            </div>
                            <div class="col-md-9">
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
