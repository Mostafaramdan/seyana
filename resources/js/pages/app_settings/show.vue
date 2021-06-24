<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <h5 class="card-title">الدولة   : {{ record.country ? record.country.name_ar :'' }}</h5>
                        <h5 class="card-title">سياسة الاستخدام بالعربي    : {{ record.policyTerms_ar }}</h5>
                        <h5 class="card-title">سياسة الاستخدام بالانجليزي    : {{ record.policyTerms_en }}</h5>
                        <h5 class="card-title"> عن التطبيق بالعربي    : {{ record.aboutUs_ar }}</h5>
                        <h5 class="card-title"> عن التطبيق بالانجليزي    : {{ record.aboutUs_en }}</h5>
                        <h5 class="card-title">سياسة الاستخدام بالعربي    : {{ record.privacy_ar }}</h5>
                        <h5 class="card-title">سياسة الاستخدام بالانجليزي    : {{ record.privacy_en }}</h5>
                        <h5 class="card-title">الرسوم : {{ record.fees }}</h5>
                        <h5 class="card-title">الايميلات    :
                            <span v-for="(phone, index) in record.phones" :key="index"> - ({{phone}})  </span>
                        </h5>
                        <h5 class="card-title">ارقام التليفونات    :
                            <span v-for="(email, index) in record.emails" :key="index"> - ({{email}})  </span>
                        </h5>
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
