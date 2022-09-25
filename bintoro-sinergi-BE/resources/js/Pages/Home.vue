<script setup>
    import Navigation from './Navigation.vue'
    import 'vue-router'
</script>

<template>
    <Navigation />
    <div class="container">
      <div class="card mt-4" style="border-radius: 25px">
        <div
          class="card-body"
          style="
            height: 300px;
            background-size: cover;
            background-position: center;
            background-image: linear-gradient(2deg, black, transparent), url('https://cdn.pixabay.com/photo/2012/08/27/14/19/mountains-55067_960_720.png');
            border-radius: 25px;">
          <div
            style="position: absolute; bottom: 0; margin: 10px"
            class="text-white">
            <h1>Selamat Datang di Home</h1>
            <h5>Belajar Membuat Aplikasi SPA dengan Laravel dan Vue</h5>
                <router-link ></router-link>
                <a href="#"><router-link :to="{ name: 'home' }" class="btn btn-dark me-2 mb-4 mt-3" >Home</router-link></a>
                <a href="#"><router-link :to="{ name: 'about' }" class="btn btn-dark me-2 mb-4 mt-3" >About</router-link></a>
          </div>
        </div>
      </div>
    </div>
</template>
  
<script>
    export default {
      
    };
</script>