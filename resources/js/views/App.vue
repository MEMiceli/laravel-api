<template>
    <div>
        <h1>Lista posts</h1>
        <ul>
            
            <li v-for="post in posts" :key="post.slug">
                {{post.title}}
            </li>
        </ul>
    </div>
</template>

<script>

export default {
    name: 'App',
    data() {
        return {
            posts:[]
        };
    },
    created() {
        axios.get('http://localhost:8001/api/posts')
        .then((response) =>{
            this.posts = response.data;
        })
        .catch((e) => {
            console.log(e);
        });
    }
}
</script>

<style>

</style>
