<template>
  <div>
    <h1>Authors</h1>
    <b-spinner v-if="loading"></b-spinner>
    <div v-if="!loading && this.data.length > 0">
      <div class="py-4">
        <b-form-input
          v-model="filter"
          placeholder="Filter by authors name or surname"
        ></b-form-input>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Number of books written</th>
            <th>
              <router-link
                size="md"
                title="Add new author"
                class="btn btn-success"
                to="/add-author"
              >
                <b-icon icon="file-earmark-plus" aria-label="Help"> </b-icon>
              </router-link>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr :key="item" v-for="item in filteredData">
            <th>{{ item.id }}</th>
            <td v-html="highlightMatches(item.name)"></td>
            <td v-html="highlightMatches(item.surname)"></td>
            <td>{{ item.books.length }}</td>
            <td>
              <b-button-toolbar class="justify-content-center">
                <b-button-group>
                  <router-link
                    title="Update author"
                    class="btn btn-warning"
                    :to="'/add-author/' + item.id"
                  >
                    <b-icon
                      icon="file-earmark-arrow-up"
                      aria-hidden="true"
                    ></b-icon>
                  </router-link>
                  <b-button
                    variant="danger"
                    title="Delete author"
                    @click="deleteAuthor(item.id)"
                  >
                    <b-icon icon="file-earmark-x" aria-hidden="true"></b-icon>
                  </b-button>
                </b-button-group>
              </b-button-toolbar>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="!loading && this.data.length === 0">
      <router-link
        size="md"
        title="Add new author"
        class="btn btn-success"
        to="/add-author"
      >
        <b-icon icon="file-earmark-plus" aria-label="Help"> </b-icon>
      </router-link>
      <br />
      <small>Author list is empty!</small>
    </div>
  </div>
</template>
<script>
export default {
  name: "Authors",
  data() {
    return {
      filter: "",
      data: [],
      loading: true,
    };
  },
  computed: {
    filteredData() {
      return this.data.filter((item) => {
        const name = item.name.toLowerCase();
        const surname = item.surname.toLowerCase();
        const searchTerm = this.filter.toLowerCase();

        return name.includes(searchTerm) || surname.includes(searchTerm);
      });
    },
  },
  mounted() {
    this.initData();
  },
  methods: {
    initData() {
      fetch(process.env.VUE_APP_API_URL + "/authors", {
        method: "get",
        headers: {
          "content-type": "application/json",
        },
      })
        .then((res) => {
          return res.json();
        })
        .then((json) => {
          this.data = json;
          this.loading = false;
        });
    },
    highlightMatches(text) {
      const matchExists = text
        .toLowerCase()
        .includes(this.filter.toLowerCase());
      if (!matchExists) return text;

      const re = new RegExp(this.filter, "ig");
      return text.replace(
        re,
        (matchedText) => `<strong>${matchedText}</strong>`
      );
    },
    deleteAuthor(id) {
      const buttons = this.$swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      buttons
        .fire({
          title: "Are you sure?",
          text: "This delete all authors books too",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            fetch(process.env.VUE_APP_API_URL + "/authors/" + id, {
              method: "delete",
              headers: {
                "content-type": "application/json",
              },
            }).then(() => {
              this.$swal({
                icon: "success",
                title: "Author successfully deleted !",
                showConfirmButton: false,
                timer: 3000,
              });
              let index = this.data.findIndex((item) => {
                if (item.id == id) {
                  return true;
                }
              });
              this.data.splice(index, 1);
            });
          }
        });
    },
  },
};
</script>
<style scoped>
</style>
