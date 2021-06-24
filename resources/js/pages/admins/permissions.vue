<template>
    <div class="m-3" >
    <form  @submit.prevent="onSubmit" class="border border-5 border-primary rounded form">
        <h3>
           تعديل الصلاحيات
        </h3>
        <hr>
        <div class="row">
            <div class="col mt-3" v-for="(permissionModule,moduleName,i) in permissions" :key="i">
                <div class="card " style="width: 18rem;">
                    <h5 class="card-header">{{permissionModule.name_ar}}</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item position-relative" v-for="(val,key,index) in permissionModule.permissions" :key="index">
                            <div class="form-check">
                                <label class="form-check-label  position-absolute top-0 end-0" :for="moduleName+index+i" >
                                    {{lang[key]}}
                                </label>
                                <input class="form-check-input position-absolute top-0 start-50"
                                       type="checkbox" :id="moduleName+index+i"
                                       v-model="record.permissions[moduleName].permissions[key]"
                                       >
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary btn-lg mt-2" :disabled="allValidation == false ">
            <span v-if="loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                جاري التحميل ...
            </span>
            <span v-else>
                 حفظ
            </span>
        </button>
    </form>
  </div>
</template>

<script>

  export default {
    components: {
    },
    data() {
        return {
            loading : false,
            permissions:[],
            record:{
                id:'',
            },
            lang:{
                'create':'إضافة',
                'update':'تعديل',
                'view':'مشاهدة',
                'delete':'حذف',
            }
        }
    },
    methods: {
        async onSubmit() {
            this.loading=true;
            let response = await this.Api('PUT',`admins/${this.record.id}`,this.record);
            if(response.status== 200){
                this.$swal("تم التعديل بنجاح", "", "success")
                this.loading=false;
            }
        },
    },
    computed: {

        allValidation(){
            return  !this.loading
        }
    },
    async created(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`admins/${this.$route.params.id}`);
        let response1 = await this.Api('GET',`permissions`);
        this.record = response.data.record;
        this.permissions = response1.data.permissions
    },
    metaInfo() {
        return {
            title: `${this.$store.state.appName} -   تعديل الصلاحيات للمسؤول  `,
        }
    }
}
</script>
