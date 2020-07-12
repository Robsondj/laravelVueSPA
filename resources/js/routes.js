import AllProperties from './components/AllProperties.vue';
import AddProperty from './components/AddProperty.vue';
import EditProperty from './components/EditProperty.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllProperties
    },
    {
        name: 'add',
        path: '/add',
        component: AddProperty
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProperty
    }
];