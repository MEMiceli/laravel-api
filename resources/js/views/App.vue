<template>
    <h1>Vue JS finalmente</h1>
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
            console.log(response.data);
        })
        .catch((e) => {
            console.log(e);
        });
    }
}
</script>

<style>

</style>
