<template>
    <div class="form-group">
        <h6  > اختر {{label}} : </h6>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle btn-lg custom-class" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <span v-if="records_id && (records.find(item => item.id === records_id))">{{(records.find(item => item.id === records_id))[column]}} 
                </span>
                <span v-else>{{`اختر ${label} من هنا`}}</span>
            </button>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenuButton1">
                <input v-model="search" type='search' class="form-control"  placeholder="بحث"  >
                <a :class="['dropdown-item mdb-dropdownLink-1',{'active':records_id== record.id}]" @click="active(i,$event)" v-for="(record, i) in records" :key="i" >
                    {{record[column]}}
                    <span v-if="record.country">( {{record.country.name_ar}} )</span>
                    <span v-if="record.country_name">( {{record.country_name}} )</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        model: { required: true },
        records_id: { required: true },
        column: { required: true },
        label: { required: true },
        url: { required: false },

    },
    data() {
        return {
            records:[],
            timeOut :false,
            search :'',
      };
    },
    methods:{
        active(i,e){
            e.target.parentElement.parentElement.getElementsByTagName('button')[0].innerHTML= `  ${this.records[i][this.column]}  `;
            this.$emit('choosen',this.records[i].id)
        },
        async getRecords(){
            let url = this.url? this.url : `dropdown/${this.model}`;
            let response = await this.Api('GET',`${url}?search=${this.search}&column=${this.column}`,{});
            this.records= response.data.records;
        },
    },
    mounted(){
            this.getRecords()
    },
    watch :{
        search:function(val){
            clearTimeout(this.timeOut);
            this.timeOut=
            setTimeout(()=>{
                this.getRecords()
            },300)
        },

    }

}
</script>
