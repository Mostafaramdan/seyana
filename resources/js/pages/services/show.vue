<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                         <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  الاسم بالعربي: </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.name_ar }}</b>
                            </div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  الاسم بالانجليزي: </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.name_en }}</b>
                            </div>
                        </div>
                        <hr>
                         <div class="row" v-if="record.category">
                            <div class="col-md-3 ">
                                <label><h5 > القسم : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b>
                                    <router-link :to="{name: 'categoriesShow', params:{id:record.categories_id}}">
                                        {{record.category.name_ar }} 
                                    </router-link>
                                </b>
                            </div>
                        </div>
                         <hr>
                         <div class="row" v-if="record.category">
                            <div class="col-md-3 ">
                                <label><h5 > الدولة : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b>{{record.category.country.name_ar }}</b>
                            </div>
                        </div>
                         <hr>
                         <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  الضمان : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.warranty_period }} ({{record.warranty_type_ar }})</b>
                            </div>
                        </div>
                         <hr>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label><h5 >  السعر : </h5></label>
                            </div>
                            <div class="col-md-3">
                                <b> {{record.price }}</b>
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
