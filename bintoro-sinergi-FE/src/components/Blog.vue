<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Blog</h1>
            </div>
            <div class="row" v-if="blogs && blogs.length">
                <div class="col-3" v-for="blog of blogs">
                    <div class="card">
                        <img class="card-img-top" :src="getImageUrl(blog.id)">
                        <div class="card-body">
                            <h5 class="card-title">{{blog.title}}</h5>
                            <p class="card-text">{{blog.resume}}</p>
                            <router-link :to="{name: 'detail-blog', params:{id: blog.id }}" class="btn btn-primary">Read More</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" v-if="errors && errors.length">
                <li v-for="error of errors">
                    {{error.message}}
                </li>
            </div>
        </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        blogs: [],
        errors: []
      }
    },

    methods : {
        getImageUrl(imageId) {
            axios.get(`http://localhost:8000/api/blog/`+imageId)
            .then(response => {
                // console.log('http://localhost:8000/image/' + response.data.data.image)
                return 'http://localhost:8000/image/' + response.data.data.image
            })
        }
    },

    created() {
        axios.get(`http://localhost:8000/api/blog/list`)
        .then(response => {
            this.blogs = response.data.data
        })
        .catch(e => {
            this.errors.push(e)
        })
    }
  }
</script>