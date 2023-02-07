<template>
    <section class="single-blog-post" >
        <h1>{{ post.title }}</h1>

        <p class="time-and-author">
            {{ formatDate(post.created_at) }}
            <span>Written By {{ post.user.name }}</span>
        </p>

        <div class="single-blog-post-ContentImage" data-aos="fade-left">
            <img :src="`/${post.ImagePath}`"  alt="" />
        </div>

        <div class="about-text">
            <p v-html="post.body"></p>
        </div>
    </section>
    <section class="recommended">
        <p>Related</p>
        <div class="recommended-cards">
            <RouterLink  v-for="post in relatedPosts" :key="post.id" :to="{ name: 'singleBlog', params: { slug: post.slug } }">
                <div class="recommended-card">
                    <img :src="`/${post.ImagePath}`" alt="" loading="lazy" />
                    <h4>
                        {{ post.title }}
                    </h4>
                </div>
            </RouterLink>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    props: ['slug'],
    emits: ['updateSidebar'],
    data() {
        return {
            post: {
                user:{}
            },
            relatedPosts:[]
        };
    },
    mounted() {
        axios.get(`/api/posts/${this.slug}`)
            .then(res => {
                this.post = res.data;
            })
            .catch(err => {
                console.error(err);
            });

        axios.get(`/api/relatedPosts/${this.slug}`).then((res)=>{
            this.relatedPosts=res.data
        }).catch((err)=>{
            console.log(err)
        })
    },
    methods: {
        formatDate(date) {
            return moment(date).fromNow();
        }
    }
};
</script>
