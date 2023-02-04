<template>
    <div id="backend-view">
        <div class="logout"><a @click="logout">Log out</a></div>
        <h1 class="heading">Dashboard</h1>
        <span>Hi {{ name }} !</span>
        <div class="links">
            <ul>
                <li>
                    <RouterLink :to="{ name: 'createPosts' }">Create Post</RouterLink>
                </li>
                <li>
                    <RouterLink :to="{ name: 'createCategory' }">Create Category</RouterLink>
                </li>
                <li>
                    <a href="">Categories List </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: '',

        }
    },
    mounted() {
        axios.get('/api/user').then((response) => {
            this.name = response.data.name
        }).catch((err) => {
            if (err.response.status === "401") {
                localStorage.removeItem('authenticated')
                this.$emit('updateSidebar')
                this.$router.push({ name: 'Login' })
            }
        })
    },
    methods: {
        logout() {
            axios.post('/api/logout').then(() => {
                this.$router.push({ name: 'Home' })
                localStorage.removeItem('authenticated')
                this.$emit('updateSidebar')
            }).catch((err) => {
                console.log(err)
            })
        }
    }
}
</script>
<style scoped>
/* dashboard */
#backend-view {
    text-align: center;
    background: #101010;
    height: 100vh;
    padding-top: 15vh;
}

.logout {
    position: absolute;
    top: 30px;
    right: 40px;
}

.heading {
    margin-bottom: 5px;
}

.links {
    margin-top: 30px;
    margin-left: auto;
    margin-right: auto;
    background: #ffffff;
    max-width: 500px;
    padding: 15px;
    border-radius: 15px;
}

.links ul {
    list-style: none;
}

.links a {
    all: revert;
    font-size: 26px;
    display: inline-block;
    margin: 10px 0;
}
</style>