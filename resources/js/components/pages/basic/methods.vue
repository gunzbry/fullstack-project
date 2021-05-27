<template>
    <div>
        <h1>The Number is : {{ views }}</h1>
        <button @click="updateCounter(1)">Increase</button>
        <button @click="updateCounter(-1)">Decrease</button>
        <br><br><br>

        <div v-for="(blog, i) in blogs" :key="i" v-if="blogs.length">
            <h1>{{ blog.title }}</h1>
            <p>{{ blog.post }}</p>
        </div>

        <br><br><br>

        <div>
            <h1 v-if="showItem">Show this item if "showItem" is true</h1>
            <h1 v-else>Show this item if "showItem" is false</h1>

            <button @click="changeShowItem()">Change status of showItem</button>

        </div>
    </div>
</template>

<script>
export default ({
    data() {
        return {
            views : 0,
            // blog object 
            blogs : [],
            showItem : false
        }
    },
    methods : {
        updateCounter(number){
            this.views += number;
        },
        changeShowItem(){
            // Change from true to false, or false to true
            this.showItem =! this.showItem;
        }
    },
    // Initial View value is 100. (Data from backend / Server)
    created(){
        this.views = 100;
        // Get the blog posts
        let posts = [
            {title : 'this is the blog title 1', 'post' : 'This is the Blog bost 1', 'id' : 1},
            {title : 'this is the blog title 2', 'post' : 'This is the Blog bost 2', 'id' : 2},
            {title : 'this is the blog title 3', 'post' : 'This is the Blog bost 3', 'id' : 3},
            {title : 'this is the blog title 4', 'post' : 'This is the Blog bost 4', 'id' : 4},
        ]

        this.blogs = posts;
    }
})
</script>
