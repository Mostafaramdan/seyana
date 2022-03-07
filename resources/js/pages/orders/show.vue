<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <h5 class="card-title"> مواد اخري : {{ record.materials }}</h5>
                        <h5 class="card-title">  وصف : {{ record.description }}</h5>
                        <h5 class="card-title"> الحالة : {{ record.status }}</h5>
                        <h5 class="card-title"> الحالة : {{ record.status }}</h5>
                        <h5 class="card-title">سعر الخدمات : {{ record.servives_price }}</h5>
                        <h5 class="card-title"> الرسوم : {{ record.fees }} %</h5>
                        <h5 class="card-title">الاجمالي بعد الخصم  : {{ record.priceAfterDiscount }}</h5>
                        <h5 class="card-title" v-if='record.voucher'>الخصم :
                            <button class="btn btn-secondary" @click="goToVoucher(record.vouchers_id)"> <i class="fas fa-eye "></i> {{record.voucher.discount}} % </button>
                        </h5>
                        <h5 class="card-title"> اليوم : {{  record.date}}</h5>
                        <h5 class="card-title"> الوقت : {{ record.time}}</h5>
                        <h5 class="card-title" v-if='record.user'> العميل : <router-link :to="{name:'usersShow',params:{id:record.users_id}}" >{{record.user.name}}</router-link></h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
                    <thead >
                        <tr >
                            <th >#</th>
                            <th >اسم الخدمة</th>
                            <th >السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cart,index) in record.carts" :key="index">
                            <td>{{cart.id}}</td>
                            <td> <router-link class="text-white" :to="{name:'servicesShow',params:{ id:cart.services_id}}" >{{cart.service_name}}</router-link></td>
                            <td>{{cart.price}}</td>
                        </tr>
                    </tbody>
                </table>
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
            datetime:'',
            sliding: null,
        }
    },
    methods:{
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        },
        goToHousing(id){
             this.$router.push( {name:'housing_unitsShow' , params: { id: id }});
        },
        goToVoucher(id){
             this.$router.push( {name:'vouchersShow' , params: { id: id }});
        },

    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`orders/${this.$route.params.id}`);
        this.record = response.data.record;
        let datetime = new Date(this.record.date * 1000);
        var month =parseInt(datetime.getMonth())+ 1;
        this.datetime =  datetime.getDate() +' - '+ month + ' - ' + datetime.getFullYear()
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   تفاصيل الطلب `,
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
