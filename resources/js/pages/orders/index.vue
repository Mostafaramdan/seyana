<template >
    <div v-if="authorized.view">
        <div class="input-group mb-3">
            <input type="search" class="form-control" v-model.trim="search" list="wizards-list" placeholder=" ابحث من هنا " aria-label="Example text with button addon" aria-describedby="button-addon1">
            <button v-b-modal.new-swap-shift-modal class="btn  btn-outline-primary" type="button" id="button-addon1"><i class='fas fa-filter'></i> فلترة </button>
        </div>

        <b-modal id="new-swap-shift-modal" @ok="$router.push({  query: { ...$route.query,...features(),page:1 }})" hide-header-close title="فلترة النتائج" ok-hide='true' ok-title = "فلترة"  cancel-title = "إلفاء">
            <div class="d-block text-center">
                <div class="form-group" >
                    <label   >ترتيب علي حسب</label>
                    <select class="custom-select" v-model="filterBy">
                        <option value="name_ar">الاسم </option>
                        <option value="id">التاريخ</option>
                    </select>
                </div>
                <div class="form-group" >
                    <label   >نوع الترتيب  </label>
                    <select class="custom-select" v-model="filterType">
                        <option value="ASC">تصاعدي </option>
                        <option value="DESC">تنازلي</option>
                    </select>
                </div>
                <div class="form-group" >
                    <label > نوع الطلب </label>
                    <select class="custom-select" v-model="status">
                        <option value="">الكل </option>
                        <option value="waiting">الانتظار </option>
                        <option value="coming">قادم</option>
                        <option value="resident">مقيم الان</option>
                        <option value="finished">انتهي</option>
                        <option value="cancelled">ملغي</option>
                        <option value="refused">مرفوض  </option>

                    </select>
                </div>
            </div>
        </b-modal>
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
                <thead >
                    <tr >
                        <th >#</th>
                        <th >الحالة </th>
                        <th>المستخدم</th>
                        <th>مزود الخدمة</th>
                        <th>المنطقة</th>
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
                    <tr v-for="(record,index) in records" :key="index">
                        <td>{{record.id}}</td>
                        <td>{{record.status}}</td>
                        <td><router-link :to="{name:'usersShow' , params: { id:record.users_id }}"> {{ record.user.name }} </router-link></td>
                        <td>
                            <router-link  v-if="record.provider" :to="{name:'providersShow' , params: { id:record.providers_id }}">
                                {{ record.provider.name }}
                            </router-link>
                        </td>
                        <td><router-link :to="{name:'regionsShow' , params: { id:record.user.regions_id }}"> {{ record.user.region.name_ar }} </router-link></td>
                        <td>{{record.servives_price}}</td>
                        <td>{{record.fees}} % </td>
                        <td>{{record.total}}  </td>
                        <td>
                            <button class="btn btn-danger" @click="deleteRecord(index)" v-if="authorized.delete"><i class="fas fa-trash "></i></button>
                            <button class="btn btn-secondary" @click="show(index)"><i class="fas fa-eye "></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination :currentPage="parseInt($route.query.page?$route.query.page:1)"  :totalPages="totalPages" @paginate="paginate($event)"></pagination>
        </div>
    </div>
</template>
<script>
import Pagination from '../../components/layouts/pagination.vue';

export default {
    components:{
        Pagination
    },
    data(){
        return {
            records:[],
            currentPage: this.$route.query.page?? 1,
            totalPages:0,
            search:'',
            filterBy:'id',
            filterType:'DESC',
            status:'',
            timeOut :false,
            visible:false
        }
    },
    methods:{
        create(){
             this.$router.push( {name:'ordersCreate',query:{...this.$route.query} });
        },
        update(index){
             this.$router.push( {name:'ordersUpdate', params: { id: this.records[index].id }});
        },
        show(index){
             this.$router.push( {name:'ordersShow' , params: { id: this.records[index].id }});
        },
        async paginate(currentPage){
            this.$router.push({  query: { ...this.$route.query,'page': currentPage }});
        },
        async getRecords(){

            let response = await this.Api('GET','orders',this.features());
            this.records=response.data.records ;
            this.totalPages=response.data.totalPages ;
        },
         async deleteRecord(index){

            if(confirm('هل انت متأكد من مسح هذا العنصر')){
                await this.Api('DELETE',`orders/${this.records[index].id}`);
                this.records.splice(index,1);
            }
        },
        features:function(){
            return {
                ...this.$route.query,
                'page':this.currentPage,
                'search':this.search,
                'filterBy':this.filterBy,
                'filterType':this.filterType,
                'status':this.status,
            };
        }
    },
    async mounted(){
        await this.getRecords();
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   الطلبات `,
        }
    },
    watch :{
        search:function(val){
            clearTimeout(this.timeOut);
            this.timeOut=
            setTimeout(()=>{
                this.$store.state.isLoading = false;
                this.$router.push({  query: { ...this.$route.query,...this.features(),page:1 }});
            },1000)
        },
        $route:function(){
            this.currentPage= this.$route.query.page;
            this.getRecords();
        }
    }

}
</script>
