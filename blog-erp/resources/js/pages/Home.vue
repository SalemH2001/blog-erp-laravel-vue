<template>
    <header class="header">
        <div class="header-text">
            <h1>Salem Blog</h1>
            <h4>Home of verified news...</h4>
        </div>
        <div class="overlay"></div>
    </header>
    <h2 class="header-title">Latest Blog Posts</h2>
    <section class="cards-blog latest-blog">
        <div class="card-blog-content" v-for="post in posts" :key="post.id">
            <img :src="post.ImagePath" alt="" />
            <p>
                {{ formatDate(post.created_at) }}
                <span style="float: right">Written By {{ post.user.name }}</span>
            </p>
            <h4 style="font-weight: bolder">
                <RouterLink :to="{ name: 'singleBlog', params: { slug: post.slug } }">
                    {{ post.title }}
                </RouterLink>
            </h4>
        </div>
    </section>
</template>
<script>
import moment from 'moment'
export default {
    emits: ['updateSidebar'],

    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        axios.get('/api/home-posts').then((res) => {
            this.posts = res.data
        }).catch(() => {
            console.log(err)
        })
    },
    methods: {
        formatDate(date) {
            return moment(date).fromNow()
        },

    }
}
</script>