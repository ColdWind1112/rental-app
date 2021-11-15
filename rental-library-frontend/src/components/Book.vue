<template>
  <b-card>
    <div>
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">
        <b-form-group
          id="input-group-1"
          label="Book title:"
          label-for="input-1"
        >
          <b-form-input
            id="input-1"
            v-model="form.title"
            placeholder="Enter book title"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-2" label="Author:" label-for="input-2">
          <b-form-select
            id="input-2"
            v-model="form.author_id"
            :options="authors"
            required
          ></b-form-select>
        </b-form-group>
        <b-form-group id="input-group-3" label-for="input-3">
            <b-form-checkbox id="input-3" value="1" inline v-model="form.is_borrowed">Is this Book borrowed ?</b-form-checkbox
            >
        </b-form-group>
        <b-button type="submit" variant="primary">Submit</b-button>
      </b-form>
      <b-card class="mt-3" header="Form Data Result">
        <pre class="m-0">{{ form }}</pre>
      </b-card>
    </div>
  </b-card>
</template>

<script>
export default {
  name: "Book",
  data() {
    return {
      authors: [],
      show: true,
      form: {
        title: "",
        author_id: null,
        is_borrowed: 0,
      },
      id: null,
    };
  },
  mounted() {
    if (this.$route.params.id !== undefined) {
      this.id = this.$route.params.id;
      fetch(process.env.VUE_APP_API_URL + "/books/" + this.id, {
        method: "get",
        headers: {
          "content-type": "application/json",
        },
      })
        .then((res) => {
          return res.json();
        })
        .then((json) => {
          this.form.title = json.title;
          this.form.author_id = json.author_id;
          this.is_borrowed = json.is_borrowed;
        });
    }

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
        this.authors = json.map((author) => {
          return { value: author.id, text: author.name + " " + author.surname };
        });
      });
  },
  methods: {
    onSubmit() {
      let method = "POST";
      let address = process.env.VUE_APP_API_URL + "/books";
      if (this.id !== null) {
        address = address + "/" + this.id;
        method = "PUT";
      }

      const requestOptions = {
        method: method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(this.form),
      };

      fetch(address, requestOptions).then(() => {
        this.$router.push({ path: "/books" });
      });
    },
  },
};
</script>