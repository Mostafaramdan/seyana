export default {
    data(){
        return {
            baseUrlDashboard: window.location.origin+ '/apiDashboard/',
            response: null,
            authorized:[]
        }
    },
    methods:{
        async Api(method,url,data){
            if(url != 'login' && localStorage.getItem('login_at') < (new Date()).getTime() - (1000*60*60*8)){
                let response= await this.axios({
                    method: method,
                    url: this.baseUrlDashboard+url,
                    data,
                    headers: {
                        'Authorization': `${this.$store.getters.getUser.apiToken}`,
                        "Content-Type": "application/json",
                        "Access-Control-Allow-Origin": "*"
                    },
                })
                .catch(function (error) {
                    console.log(error);
                });;
                this.$store.dispatch('logoutAction')
                this.$router.push({ path: '/dashboard/login' })
                return response;
            }else{
                let response=  await this.axios({
                    method: method,
                    url: this.baseUrlDashboard+url,data,
                    headers: {
                        'Authorization': `${this.$store.getters.getUser.apiToken}`,
                        "Content-Type": "application/json",
                        "Access-Control-Allow-Origin": "*"
                    },
                    params: method=='GET'? data: '',
                    data
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.$store.state.isLoading = false;
                return response;
            }
        },
        async generalApi(method,url,data){
            let response=  await this.axios({
                method: method,
                url: `${window.location.origin+url}`,
                headers: {
                    'Authorization': `${this.$store.getters.getUser.apiToken}`,
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": "*"
                },
                params: data,
                data
            })
            .catch(function (error) {
                 console.log(error);
            });
            this.$store.state.isLoading = false;
            return response;
        },
        toggle(column,id){
            let model = window.location.pathname.split('/')[2];
            this.Api('GET',`toggle/${model}/${column}/${id}`)
        },
        setAuth(){
            var current = window.location.pathname.split('/')[2]
            if(current== 'countries' || current == 'cities' || current== 'districts')
                current = 'regions';
            if(this.$store.state.user.permissions)
                this.authorized= this.$store.state.user.permissions[current].permissions
        }
    },
    mounted(){
        this.setAuth()
        var permissions = this.$store.state.user.permissions;
        if(permissions){
            let links = Array.prototype.slice.call(document.getElementById('sidebar-right').getElementsByTagName('a'));
            links.forEach(element => {
                var href= element.href.split('/')[4];
                href = href=='countries'? 'regions' : href;
                if(permissions[href])
                    if(!permissions[href].permissions.view)element.remove();
            });
        }
    },
    watch:{
        $route:function(){
            this.setAuth()
        }
    }

}
