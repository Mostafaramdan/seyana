import login from '@/pages/authentication/login';
import users from '@/routes/users';
import categories from '@/routes/categories';
import companies from '@/routes/companies';
import services from '@/routes/services';
import providers from '@/routes/providers';
import app_settings from '@/routes/app_settings';
import admins from '@/routes/admins';
import currencies from '@/routes/currencies';
import regions from '@/routes/regions';
import orders from '@/routes/orders';
import contacts from '@/routes/contacts';
import notifications from '@/routes/notifications';
import statistics from '@/routes/statistics';
import vouchers from '@/routes/vouchers';
const baseDash= '/dashboard';

const routes=
[

    ...companies,
    ...categories,
    ...services,
    ...users,
    ...providers,
    ...app_settings,
    ...admins,
    ...currencies,
    ...regions,
    ...orders,
    ...contacts,
    ...notifications,
    ...statistics,
    ...vouchers,
    {
        path: `${baseDash}/login`,
        name: 'login',
        component: login,
    },
    {
        path: '*',
        redirect: { name: 'statistics' }
    }


];
export default routes;
