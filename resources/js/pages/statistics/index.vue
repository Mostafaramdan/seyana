<template >
    <div class="row" >
        <div class="col-md-4 m-2">
            <label for="from" class="form-label"> من : </label>
            <input type="date" class="form-control" v-model="from" id="from">
        </div>
        <div class="col-md-4 m-2">
            <label for="to" class="form-label"> الي : </label>
            <input type="date" class="form-control"  v-model="to" id="to">
        </div>
        <hr>
        <div class="col  text-white bg-primary m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات في وضع الانتظار</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.waiting}}</h5>
            </div>
        </div>

        <div class="col  text-white bg-secondary m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات في وضع المعالجة</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.processing}}</h5>
            </div>
        </div>

        <div class="col  text-white bg-info m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات المنتهية</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.finished}}</h5>
            </div>
        </div>

        <div class="col  text-white bg-warning  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات الملغية</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.cancelled}}</h5>
            </div>
        </div>

        <div class="col  text-white bg-danger  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات المرفوضة</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.refused}}</h5>
            </div>
        </div>
        <hr>
        <div class="col  text-white bg-primary  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي الطلبات </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.orders}}</h5>
            </div>
        </div>

        <div class="col  text-white bg-dark  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي المبيعات </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.total}}</h5>
            </div>
        </div>

        <div class="col  text-white bg-dark  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي فوائد التطبيق </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.fees}}</h5>
            </div>
        </div>
        <hr>
        <div class="col  text-white bg-info m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي عدد الخدمات الموجود في التطبيق </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.services}}</h5>
            </div>
        </div>
        <div class="col  text-white bg-info m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي عدد الاقسام الموجود في التطبيق </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.categories}}</h5>
            </div>
        </div>
        <hr>
        <a href="/download-orders" class="btn btn-success">تحميل في ملف <i class="fas fa-file-excel"></i> </a>
        <div class="col table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
                <thead >
                    <tr >
                        <th >#</th>
                        <th >الحالة </th>
                        <th >سعر الخدمات </th>
                        <th >الرسوم</th>
                        <th >الاجمالي</th>
                        <th >#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show="false">
                        <div class="text-center mb-3 d-flex justify-content-between">
                            <b-spinner
                                style="width: 6rem; height: 6rem;"
                                variant="light"
                                key="light">
                            </b-spinner>
                        </div>
                    </tr>
                    <tr v-for="(order,index) in record.allOrders" :key="index">
                        <td>{{order.id}}</td>
                        <td>{{order.status}}</td>
                        <td>{{order.servives_price}}</td>
                        <td>{{order.fees}} % </td>
                        <td>{{order.total}}  </td>
                        <td>
                            <button class="btn btn-secondary" @click="show(order.id)"><i class="fas fa-eye "></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>

export default {
    data(){
        return {
            record:{},
            from:'',
            to:'',
            visible:false
        }
    },
    methods:{
        show(id){
             this.$router.push( {name:'ordersShow' , params: { id: id }});
        },
        update(index){
             this.$router.push( {name:'statisticsUpdate', params: { id: this.record.id }});
        },
        async getRecords(){
            this.$store.state.isLoading = true;
            let response = await this.Api('GET','statistics',{from:this.from,to:this.to});
            this.record=response.data.record ;
            this.$store.state.isLoading = false;
        },
    },
    async mounted(){
        await this.getRecords();
    },
    watch: {
        from:function(c){
            this.getRecords();
        },
        to:function(){
            this.getRecords();
        },
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   الاحصائيات `,
        }
    },
}
</script>
s
