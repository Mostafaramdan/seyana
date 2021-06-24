import companies from '@/pages/companies/index';
import create from '@/pages/companies/create';
import update from '@/pages/companies/update';
import show from '@/pages/companies/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/companies`,
        name: `companies`,
        component: companies,
    },
    {
        path: `${baseDash}/companies/create`,
        name: `companiesCreate`,
        component: create,
    },
    {
        path: `${baseDash}/companies/update/:id`,
        name: `companiesUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/companies/:id`,
        name: `companiesShow`,
        component: show,
    }
];
