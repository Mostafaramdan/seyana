<template>
    <div>
        <b-sidebar
            id="sidebar-right"
            :title="' مرحبا ' + $store.getters.getUser.name"
            right
            shadow
            style="width: 100%"
        >
            <div class="px-3 py-2">
                <b-list-group>
                    <router-link :to="{name: 'statistics'}" >
                        <b-list-group-item :active="$route.name.includes('statistics')">
                            الاحصائيات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'users'}" >
                        <b-list-group-item :active="$route.name.includes('user')">
                            العملاء
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'providers'}" >
                        <b-list-group-item :active="$route.name.includes('provider')">
                            مزودي الخدمات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'companies'}" >
                        <b-list-group-item :active="$route.name.includes('companies')">
                            الشركات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'orders'}">
                        <b-list-group-item :active="$route.name.includes('orders')">
                             الطلبات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'categories'}">
                        <b-list-group-item :active="$route.name.includes('categories')">
                             الاقسام
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'services'}">
                        <b-list-group-item :active="$route.name.includes('services')">
                             الخدمات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'countries'}"  >
                        <b-list-group-item :active="$route.name.includes('countries') || $route.name.includes('cities') || $route.name.includes('districts')">
                             الدول / المدن / المناطق
                        </b-list-group-item >
                    </router-link>
                     <router-link :to="{name: 'contacts'}"  >
                        <b-list-group-item :active="$route.name.includes('contacts')">
                             الشكاوي والاقتراحات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'vouchers'}"  >
                        <b-list-group-item :active="$route.name.includes('vouchers')">
                             أكواد الخصم
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'notifications'}"  >
                        <b-list-group-item :active="$route.name.includes('notifications')">
                             الاشعارات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'currencies'}"  >
                        <b-list-group-item :active="$route.name.includes('currencies')">
                             العملات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'app_settings'}"  >
                        <b-list-group-item :active="$route.name.includes('app_settings')">
                             الاعدادات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'admins'}"  >
                        <b-list-group-item :active="$route.name.includes('admins')">
                             المسؤولين
                        </b-list-group-item >
                    </router-link>
                </b-list-group>
            </div>
        </b-sidebar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            userLink: "users",
            allPermissions: this.$store.state.user.permissions ? this.$store.state.user.permissions : null
        };
    },
    
};
</script>
