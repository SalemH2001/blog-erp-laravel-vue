<template>
    <!-- main -->
    <main class="container">
        <h2 class="header-title">All Blog Posts</h2>
        <div class="searchbar">
            <form action="">
                <input type="text" placeholder="Search..." name="search" v-model="title"/>

                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>

            </form>
        </div>
        <div class="categories">
            <ul>
                <li v-for="category in categories" :key="category.id">
                    <a href="#" @click="filterByCategory(category.name)">{{
                        category.name
                    }}</a>
                </li>
            </ul>
        </div>
        <section class="cards-blog latest-blog">
            <div class="card-blog-content" v-for="post in posts" :key="post.id">
                <img :src="post.ImagePath" alt="" />
                <p>
                    {{ formatDate(post.created_at) }}
                    <span>Written By {{ post.user.name }}</span>
                </p>
                <h4>
                    <RouterLink :to="{ name: 'singleBlog', params: { slug: post.slug } }">
                        {{ post.title }}
                    </RouterLink>
                </h4>
            </div>
        </section>
        <h3 v-if="!posts.length">Sorry no match was found</h3>
    </main>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
export default {
    emits: ['updateSidebar'],

    data() {
        return {
            posts: [],
            categories: [],
            title:''
        }
    },
    watch:{
        title(){
            axios.get('/api/posts', {
                params: {
                    search: this.title,
                },
            }).then((res) => {
                this.posts = res.data.data
            }).catch((err) => {
                console.log(err)
            })
        }
    },
    mounted() {
        axios.get('/api/posts').then((res) => {
            this.posts = res.data.data
            console.log(this.posts)
        }).catch(() => {
            console.log(err)
        }),

            axios.get('/api/categories').then((res) => {
                this.categories = res.data
            }).catch((err) => {
                console.log(err)
            })
    },
    methods: {
        formatDate(date) {
            return moment(date).fromNow()
        },

        filterByCategory(name) {
            axios.get('/api/posts', {
                params: {
                    category: name,
                },
            }).then((res) => {
                this.posts = res.data.data
            }).catch((err) => {
                console.log(err)
            })
        }

    }
}
</script>
<style scoped>
 h3{
    font-size: 30px;
    text-align: center;
    margin: 30px 0;
    color:#fff;
 }
</style>