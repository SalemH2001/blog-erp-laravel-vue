import { createRouter,createWebHistory } from "vue-router";
import About from '../pages/About.vue'
import Blog from '../pages/Blog.vue'
import Contact from '../pages/Contact.vue'
import Home from '../pages/Home.vue'
import singleBlog from '../pages/singleBlog.vue'
import Login from '../pages/auth/Login.vue'
import Register from '../pages/auth/Register.vue'
import Dashboard from '../pages/auth/Dashboard.vue'
import createCategory from '../pages/auth/categories/Create.vue'
import categoriesList from '../pages/auth/categories/List.vue'
import editCategories from '../pages/auth/categories/Edit.vue'

const routes =[
    {
        path:'/',
        name:'Home',
        component: Home
    },
    {
        path:'/about',
        name:'About',
        component: About   
    },
    {
        path:'/contact',
        name:'Contact',
        component: Contact
    },
    {
        path:'/blog/:slug',
        name:'singleBlog',
        component: singleBlog
    },
    {
        path:'/blog',
        name:'Blog',
        component: Blog,
        props:true
    },
    {
        path:'/login',
        name:'Login',
        component: Login,
        meta:{requiresGuest:true}
    },
    {
        path:'/register',
        name:'Register',
        component: Register,
        meta:{requiresGuest:true}
    },
    {
        path:'/dashboard',
        name:'Dashboard',
        component: Dashboard,
        meta:{requiresAuth:true}
    },
    {
        path:'/category/create',
        name:'createCategory',
        component: createCategory,
        meta:{requiresAuth:true}
    },
    {
        path:'/categories',
        name:'categoriesList',
        component: categoriesList,
        meta:{requiresAuth:true}
    },
    {
        path:'/categories/edit/:id',
        name:'editCategories',
        component: editCategories,
        meta:{requiresAuth:true},
        props:true
    },


]

const router =createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to,from)=>{
    const authenticated = localStorage.getItem('authanticated')
    if(to.meta.requiresGuest && authenticated){
        return{
            name:'Dashboard'
        }
    }else if(to.meta.requiresAuth && !authenticated){
        return{
            name:'Login'
        }
    }
});

export default router