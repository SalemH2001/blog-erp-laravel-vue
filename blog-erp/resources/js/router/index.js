import { createRouter,createWebHistory } from "vue-router";
import About from '../pages/About.vue'
import Blog from '../pages/Blog.vue'
import Contact from '../pages/Contact.vue'
import Home from '../pages/Home.vue'
import singleBlog from '../pages/singleBlog.vue'

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

]

const router =createRouter({
    history:createWebHistory(),
    routes
})

export default router