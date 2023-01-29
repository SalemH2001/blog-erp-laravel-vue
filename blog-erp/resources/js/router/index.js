import { createRouter,createWebHistory } from "vue-router";
import About from '../pages/About.vue'
import Blog from '../pages/Blog.vue'
import Contact from '../pages/Contact.vue'
import Home from '../pages/Home.vue'
import singleBlog from '../pages/singleBlog.vue'
import Login from '../pages/auth/Login.vue'
import Register from '../pages/auth/Register.vue'
import Dashboard from '../pages/auth/Dashboard.vue'

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
    },
    {
        path:'/register',
        name:'Register',
        component: Register,
    },
    {
        path:'/dashboard',
        name:'Dashboard',
        component: Dashboard,
    },


]

const router =createRouter({
    history:createWebHistory(),
    routes
})

export default router