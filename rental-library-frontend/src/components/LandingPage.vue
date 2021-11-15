<template>
  <div>
    <h1>Landing page</h1>
    <b-card-group class="pt-4" deck>
      <b-card>
        <b-card title="Authors">
          <b-card-text> Show me list with all authors. </b-card-text>
          <router-link class="card-link" to="/authors"
            >Go to Authors</router-link
          >
        </b-card>
      </b-card>
      <b-card>
        <b-card title="Books">
          <b-card-text> Show me list with all books. </b-card-text>
          <router-link class="card-link" to="/books">Go to Books</router-link>
        </b-card>
      </b-card>
    </b-card-group>
  </div>
</template>
<script>
export default {
  name: "LandingPage",
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
