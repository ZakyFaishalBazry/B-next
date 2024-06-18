import Dashboard from './components/Dashboard.vue';
import Crud from './pages/crud/Crud.vue';
import CrudFrom from './pages/crud/CrudFrom.vue';
import Users from './pages/users/UsersList.vue';
import Profile from './pages/profile/UpdateProfile.vue';
import Settings from './pages/settings/UpdateSetting.vue';
import Login from './pages/auth/Login.vue';

export default [

    {
        path:'/',
        name:'/',
        component: Dashboard,
    },

    {
        path:'/CRUD',
        name:'/CRUD',
        component: Crud,
    },

    {
        path:'/CRUD/Create',
        name:'/CRUD/Create',
        component: CrudFrom,
    },

    {
        path: '/CRUD/Edit/:id',
        name: 'editAppointment',
        component: CrudFrom,
        props: true,
    },


    {
        path:'/Users',
        name:'/Users',
        component: Users,
    },
    {
        path:'/Profile',
        name:'/Profile',
        component: Profile,
    },
    
    {
        path:'/Settings',
        name:'/Settings',
        component: Settings,
    },

    {
        path:'/login',
        name:'/login',
        component: Login,
    },


]