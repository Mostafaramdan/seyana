import services from '@/pages/services/index';
import create from '@/pages/services/create';
import update from '@/pages/services/update';
import show from '@/pages/services/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/services`,
        name: `services`,
        component: services,
    },
    {
        path: `${baseDash}/services/create`,
        name: `servicesCreate`,
        component: create,
    },
    {
        path: `${baseDash}/services/update/:id`,
        name: `servicesUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/services/:id`,
        name: `servicesShow`,
        component: show,
    }
];
