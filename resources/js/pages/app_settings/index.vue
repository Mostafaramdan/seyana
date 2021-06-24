<template >
    <div v-if="authorized.view">
        <div class="input-group mb-3">
            <input type="search" class="form-control" v-model.trim="search" list="wizards-list" placeholder=" ابحث من هنا " aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>
        <button class="btn btn-primary m-2 create"  @click="create"  v-if="authorized.create">
             إضافة
            <i class="fas fa-plus"></i>
        </button>
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
                <thead >
                    <tr >
                        <th >#</th>
                        <th >الدولة  </th>
                        <th >سياسة الاستخدام  </th>
                        <th >عن التطبيق  </th>
                        <th >الامان  </th>
                        <th >الرسوم  </th>
                        <th >نطاق البحث </th>
                        <th >#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(record,index) in records" :key="index">
                        <td>{{record.id}}</td>
                        <td>{{record.country.name_ar}}</td>
                        <td>{{record.policyTerms_ar.replace(/^(.{15}[^\s]*).*/, "$1")  }}</td>
                        <td>{{record.aboutUs_ar.replace(/^(.{15}[^\s]*).*/, "$1")  }}</td>
                        <td>{{record.privacy_ar.replace(/^(.{15}[^\s]*).*/, "$1")  }}</td>
                        <td>{{record.fees}}</td>
                        <td>{{record.distance}} KM</td>
                        <td>
                            <button class="btn btn-danger delete" @click="deleteRecord(index)" v-if="authorized.delete"><i class="fas fa-trash "></i></button>
                            <button class="btn btn-info update" @click="update(index)"  v-if="authorized.update"><i class="fas fa-edit"></i></button>
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
            timeOut :false,
        }
    },
    methods:{
        show() {
            this.visible = true
        },
        create(){
             this.$router.push( {name:'app_settingsCreate',});
        },
        update(index){
             this.$router.push( {name:'app_settingsUpdate', params: { id: this.records[index].id }});
        },
        show(index){
             this.$router.push( {name:'app_settingsShow' , params: { id: this.records[index].id }});
        },
        async paginate(currentPage){
            this.$router.push({  query: { ...this.$route.query,'page': currentPage }});
        },
        async getRecords(){

            let response = await this.Api('GET','app_settings',this.features());
            this.records=response.data.records ;
            this.totalPages=response.data.totalPages ;
        },
         async deleteRecord(index){

            if(confirm('هل انت متأكد من مسح هذا العنصر')){
                await this.Api('DELETE',`app_settings/${this.records[index].id}`);
                this.records.splice(index,1);
            }
        },
        features:function(){
            return {
                'page':this.currentPage,
                'search':this.search,
                'filterBy':this.filterBy,
                'filterType':this.filterType,
            };
        }
    },
    async mounted(){

        await this.getRecords();
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   الاعدادات `,
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
