import providers from '@/pages/providers/index';
import create from '@/pages/providers/create';
import update from '@/pages/providers/update';
import show from '@/pages/providers/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/providers`,
        name: `providers`,
        component: providers,
    },
    {
        path: `${baseDash}/providers/create`,
        name: `providersCreate`,
        component: create,
    },
    {
        path: `${baseDash}/providers/update/:id`,
        name: `providersUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/providers/:id`,
        name: `providersShow`,
        component: show,
    }
];
