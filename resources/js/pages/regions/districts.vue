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
                        <option value="name">الاسم </option>
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
            </div>
        </b-modal>
        <button class="btn btn-primary m-2 create"  @click="create"  v-if="authorized.create">
             إضافة
            <i class="fas fa-plus"></i>
        </button>
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
                <thead >
                    <tr >
                        <th >#</th>
                        <th >الاسم بالعربي </th>
                        <th >الاسم بالانجليزي </th>
                        <th>التفعيل</th>
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
                        <td>{{record.name_ar}}</td>
                        <td>{{record.name_en}}</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" @click="toggle('is_active',record.id)"  v-model="record.is_active" >
                                <span class="slider round"></span>
                            </label>
                        </td>
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
            cities_id:this.$route.query.cities_id,
            timeOut :false,
            country:true
        }
    },
    methods:{
        toggle(column,id){
            this.Api('GET',`toggle/${'regions'}/${column}/${id}`)
        },
        show() {
            this.visible = true
        },
        create(){
             this.$router.push( {name:'regionsCreate', query: {'cities_id': this.$route.query.cities_id} });
        },
        update(index){
             this.$router.push( {name:'regionsUpdate', params: { id: this.records[index].id }});
        },
        show(index){
             this.$router.push( {name:'regionsShow' , params: { id: this.records[index].id }});
        },
        async paginate(currentPage){
            this.$router.push({  query: { ...this.$route.query,'page': currentPage }});
        },
        async getRecords(){

            let response = await this.Api('GET','regions',this.features());
            this.records=response.data.records ;
            this.totalPages=response.data.totalPages ;
        },
         async deleteRecord(index){

            if(confirm('هل انت متأكد من مسح هذا العنصر')){
                await this.Api('DELETE',`regions/${this.records[index].id}`);
                this.records.splice(index,1);
            }
        },
        features:function(){
            return {
                'page':this.currentPage,
                'search':this.search,
                'filterBy':this.filterBy,
                'filterType':this.filterType,
                'cities_id':this.cities_id,
            };
        }
    },
    async mounted(){
        await this.getRecords();
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   المدن `,
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
            this.regions_id = this.$route.query.regions_id
            if(this.regions_id == null){
                this.country= true;
            }else{
                this.country= false;
            }
            this.currentPage= this.$route.query.page;
            this.getRecords();
        }
    }

}
</script>
