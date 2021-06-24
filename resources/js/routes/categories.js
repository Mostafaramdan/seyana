import categories from '@/pages/categories/index';
import create from '@/pages/categories/create';
import update from '@/pages/categories/update';
import show from '@/pages/categories/show';
const baseDash= '/dashboard';

export default [
    {
        path: `${baseDash}/categories`,
        name: `categories`,
        component: categories,
    },
    {
        path: `${baseDash}/categories/create`,
        name: `categoriesCreate`,
        component: create,
    },
    {
        path: `${baseDash}/categories/update/:id`,
        name: `categoriesUpdate`,
        component: update,
    },
    {
        path: `${baseDash}/categories/:id`,
        name: `categoriesShow`,
        component: show,
    }
];
