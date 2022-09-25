<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Detail Blog</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{blogs.title}}</h5>
                            <p class="card-text">{{blogs.description}}</p>
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
  
        created() {
            axios.get(`http://localhost:8000/api/blog/${this.$route.params.id}`)
            .then((response) => {
                this.blogs = response.data.data
            });
        },
    }
</script>