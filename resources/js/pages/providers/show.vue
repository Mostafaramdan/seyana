<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <vue-easy-lightbox
                                :imgs="record.images"
                                scDisabled
                                moveDisabled
                                :visible="visible"
                                :index="0"
                                @hide='visible=false'
                        ></vue-easy-lightbox>
                        <hr>
                        <h5 class="card-title">الصور :
                            <button class="btn btn-info w-25"  @click="visible=true">
                                <i class="fas fa-image" ></i>
                            </button>
                        </h5>
                        <hr>
                        <h5 class="card-title">الاسم  : {{ record.name }}</h5>
                        <h5 class="card-title">الايميل  : {{ record.email }}</h5>
                        <h5 class="card-title">التليفون  : {{ record.phone }}</h5>
                        <h5 class="card-title">الرصيد  : {{ record.balance }}</h5>
                        <hr>
                        <h3>معلومات الاشتراك</h3>
                        <h5 class="card-title">تاريخ اول اشتراك   : {{ record.first_subscription }}</h5>
                        <h5 class="card-title">تاريخ بداية الاشتراك الحالي   : {{ record.subscription_at }}</h5>
                        <h5 class="card-title">تاريخ نهاية الاشتراك الحالي  : {{ record.subscription_end }}</h5>

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
    methods:{
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        },


    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`providers/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -  ${this.record.name}`,
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
