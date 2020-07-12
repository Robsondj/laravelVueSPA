import AllProperties from './components/AllProperties.vue';
import AddProperty from './components/AddProperty.vue';
import EditProperty from './components/EditProperty.vue';

import AllContracts from './components/AllContracts.vue';
import AddContract from './components/AddContract.vue';
import EditContract from './components/EditContract.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllProperties
    },
    {
        name: 'addProperty',
        path: '/addProperty',
        component: AddProperty
    },
    {
        name: 'editProperty',
        path: '/edit/:id',
        component: EditProperty
    },
    {
        name: 'allContracts',
        path: '/contracts',
        component: AllContracts
    },
    {
        name: 'addContract',
        path: '/AddContract',
        component: AddContract
    },
    {
        name: 'editContract',
        path: '/editContract/:id',
        component: EditContract
    }
];