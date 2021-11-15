<template>
  <b-card>
    <div>
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">
        <b-form-group
          id="input-group-1"
          label="Author name:"
          label-for="input-1"
        >
          <b-form-input
            id="input-1"
            v-model="form.name"
            placeholder="Enter authors name"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="input-group-2"
          label="Author surname:"
          label-for="input-2"
        >
          <b-form-input
            id="input-2"
            v-model="form.surname"
            placeholder="Enter authors surname"
            required
          ></b-form-input>
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
  name: "Author",
  data() {
    return {
      show: true,
      form: {
        name: "",
        surname: "",
      },
      id: null,
    };
  },
  mounted() {
    if (this.$route.params.id !== undefined) {
      this.id = this.$route.params.id;
      fetch(process.env.VUE_APP_API_URL + "/authors/" + this.id, {
        method: "get",
        headers: {
          "content-type": "application/json",
        },
      })
        .then((res) => {
          return res.json();
        })
        .then((json) => {
          this.form.name = json.name;
          this.form.surname = json.surname;
        });
    }
  },
  methods: {
    onSubmit() {
      let method = "POST";
      let address =  process.env.VUE_APP_API_URL + "/authors";
      if (this.id !== null) {
        address = address + "/" + this.id;
        method = "PUT";
      }

      const requestOptions = {
        method: method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(this.form),
      };

      fetch(address, requestOptions)
        .then(() => {
          this.$swal({
            icon: "success",
            title: "Author successfully saved !",
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .then(() => {
          this.$router.push({ path: "/authors" });
        });
    },
  },
};
</script>