<template>
  <div>
    <h1>Books</h1>
    <b-spinner v-if="loading"></b-spinner>
    <div v-if="!loading && this.data.length > 0">
      <div class="py-4">
        <b-form-group>
          <b-form-input
            v-model="filter"
            placeholder="Filter by authors name or book title"
          ></b-form-input>
        </b-form-group>
        <b-form-group>
          <b-form-checkbox inline v-model="showBorrowed"
            >Show borrowed</b-form-checkbox
          >
        </b-form-group>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Borrowed</th>
            <th>
              <router-link
                size="md"
                title="Add new book"
                class="btn btn-success"
                to="/add-book"
              >
                <b-icon icon="file-earmark-plus" aria-label="Help"> </b-icon>
              </router-link>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr :key="item" v-for="item in filteredData">
            <td>{{ item.id }}</td>
            <td v-html="highlightMatches(item.title)"></td>
            <td
              v-html="
                highlightMatches(item.authors.name + ' ' + item.authors.surname)
              "
            ></td>
            <td>{{ item.is_borrowed }}</td>
            <td>
              <b-button-toolbar class="justify-content-center">
                <b-button-group>
                  <router-link
                    title="Update book"
                    class="btn btn-warning"
                    :to="'/add-book/' + item.id"
                  >
                    <b-icon
                      icon="file-earmark-arrow-up"
                      aria-hidden="true"
                    ></b-icon>
                  </router-link>
                  <b-button
                    variant="danger"
                    title="Delete book"
                    @click="deleteBook(item.id)"
                  >
                    <b-icon icon="file-earmark-x" aria-hidden="true"></b-icon>
                  </b-button>
                  <b-button
                    :variant="item.is_borrowed ? 'secondary' : 'primary'"
                    title="Borrow book"
                    @click="borrowBook(item.id, item.is_borrowed)"
                  >
                    <b-icon
                      icon="file-earmark-lock"
                      aria-hidden="true"
                    ></b-icon>
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
        title="Add new book"
        class="btn btn-success"
        to="/add-book"
      >
        <b-icon icon="file-earmark-plus" aria-label="Help"> </b-icon>
      </router-link>
      <br />
      <small>Books list is empty!</small>
    </div>
  </div>
</template>
<script>
export default {
  name: "Books",
  data() {
    return {
      filter: "",
      showBorrowed: true,
      data: [],
      loading: true,
    };
  },
  mounted() {
    this.initData();
  },
  computed: {
    filteredData() {
      return this.data.filter((item) => {
        const title = item.title.toLowerCase();
        const author = (
          item.authors.name +
          " " +
          item.authors.surname
        ).toLowerCase();
        const searchTerm = this.filter.toLowerCase();
        let show = true;
        if (!this.showBorrowed) {
          show = item.is_borrowed == 1 ? false : true;
        }

        return (
          (title.includes(searchTerm) || author.includes(searchTerm)) && show
        );
      });
    },
  },
  methods: {
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
    initData() {
      fetch(process.env.VUE_APP_API_URL + "/books", {
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
          console.log(json);
          this.loading = false;
        });
    },
    borrowBook(id, borrowed) {
      let borrow = borrowed == 1 ? 0 : 1;
      fetch(process.env.VUE_APP_API_URL + "/books/" + id, {
        method: "put",
        headers: {
          "content-type": "application/json",
        },
        body: JSON.stringify({ is_borrowed: borrow }),
      }).then(() => {
        this.$swal({
          icon: "info",
          title: "Book status changed!",
          showConfirmButton: false,
          timer: 1000,
        });

        let index = this.data.findIndex((item) => {
          if (item.id == id) {
            return true;
          }
        });
        console.log(index);

        this.data[index].is_borrowed = borrow;
      });
    },
    deleteBook(id) {
      fetch(process.env.VUE_APP_API_URL + "/books/" + id, {
        method: "delete",
        headers: {
          "content-type": "application/json",
        },
      }).then(() => {
        this.$swal({
          icon: "success",
          title: "Book successfully deleted !",
          showConfirmButton: false,
          timer: 1500,
        });
        let index = this.data.findIndex((item) => {
          if (item.id == id) {
            return true;
          }
        });
        this.data.splice(index, 1);
      });
    },
  },
};
</script>
<style scoped>
</style>
