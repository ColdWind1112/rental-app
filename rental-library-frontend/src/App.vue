<template>
  <top-navigation></top-navigation>
  <div class="container">
    <router-view></router-view>
  </div>
</template>
<script>
import TopNavigation from '../src/components/TopNavigation.vue'
export default {
  name: "App",
  components:{
    TopNavigation
  }
};
</script>

<style>
.container{
  padding-top:20px;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
