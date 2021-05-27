<template>
    <div>
        <h1 ref="myref">Hook tutorial</h1>
        <h2>My name is {{ name }}</h2>
    </div>
</template>

// Local Memory 
<script>
export default({
    data() {
        return {
            name: 'bryan'
        }
    },
    // Hook (before even the created Hook)
    beforeCreate(){
        console.log(this.name);
        // we can check routing ? and redirect user if we want.
    },

    // Hook (before HTML is rendered)
    created(){
        // We mostly call initial data from it.
        // It can access data, methods, computed, related to vue JS
        // Used to call API, data from server
        console.log("data and other functions are available but not HTML : ", this.name);
    },

    // Hook, after HTML is rendered
    mounted(){
        // Local storage, and you can access HTML elements
        // What is it ? 
        console.log("rendered after HTML : ", this.$refs.myref);

    }
})
</script>
