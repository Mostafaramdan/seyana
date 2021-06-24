<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <h5 class="card-title">الاسم بالعربي  : {{ record.name_ar }}</h5>
                        <h5 class="card-title">الاسم بالانجليزي  : {{ record.name_en }}</h5>
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
        }

    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`services/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -  ${this.record.name_ar} `,
        }
    }
}
</script>
