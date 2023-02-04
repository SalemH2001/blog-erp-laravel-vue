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
            <a href="">
                <div class="recommended-card">
                    <img src="images/pic5.jpg" alt="" loading="lazy" />
                    <h4>
                        12 Health Benefits Of Pomegranate Fruit
                    </h4>
                </div>
            </a>
            <a href="">
                <div class="recommended-card">
                    <img src="images/pushups.jpg" alt="" loading="lazy" />
                    <h4>
                        The Truth About Pushups
                    </h4>
                </div>
            </a>
            <a href="">
                <div class="recommended-card">
                    <img src="images/smoothies.jpg" alt="" loading="lazy" />
                    <h4>
                        Healthy Smoothies
                    </h4>
                </div>
            </a>

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
    },
    methods: {
        formatDate(date) {
            return moment(date).fromNow();
        }
    }
};
</script>
