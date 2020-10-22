import Router from 'vue-router';
import Vue from 'vue';
Vue.use(Router);
let router = new Router({
    mode :'history',
    routes: [
        {
            path:'/characters/import',
            name: 'Import',
            component: require('./pages/Import.vue').default,
            meta: {
                title: 'Import Characters',
                label: 'Import',
            }
        },
        {
            path:'/characters/mass-update',
            name: 'Update',
            component: require('./pages/MassUpdate.vue').default,
            meta: {
                title: 'Update Characters',
                label: 'Update',
            }
        },
    ]
});
export default router;
