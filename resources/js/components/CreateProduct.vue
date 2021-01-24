<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">
              Create Product
              <router-link
                :to="{ name: 'product' }"
                class="btn btn-primary btn-sm float-right"
                >Product List</router-link
              >
            </h5>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-2"></div>
              <div class="col-8">
                <form @submit.prevent="createProduct">
                  <div class="form-group">
                    <label for="">Product Title</label>
                    <input
                      id="title"
                      name="title"
                      value=""
                      autofocus="autofocus"
                      class="form-control"
                      type="text"
                      v-model="form.title"
                      placeholder="Title"
                    />
                    <span v-if="errors.title" class="text-danger">{{
                      errors.title[0]
                    }}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Product Price</label>
                    <input
                      type="text"
                      class="form-control"
                      name="price"
                      v-model="form.price"
                      placeholder="Product price"
                      :class="{ 'is-invalid': form.errors.has('price') }"
                    />
                    <has-error :form="form" field="price"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="">Product Image</label>
                    <input
                      @change="onImageChange"
                      type="file"
                      class="form-control"
                      name="image"
                      :class="{ 'is-invalid': form.errors.has('image') }"
                    />
                    <has-error :form="form" field="image"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="">Product Description</label>
                    <textarea
                      class="form-control"
                      name="description"
                      v-model="form.description"
                      placeholder="Product description"
                      :class="{ 'is-invalid': form.errors.has('description') }"
                    />
                    <has-error :form="form" field="description"></has-error>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-success btn-sm" type="submit">
                      Create
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";

export default {
  data() {
    return {
      form: new Form({
        title: "",
        price: "",
        image: "",
        description: "",
      }),
      errors: [],
      success: false,
    };
  },
  methods: {
    createProduct() {
      let formData = new FormData();

      formData.append("title", this.form.title);
      formData.append("price", this.form.price);
      formData.append("image", this.form.image);
      formData.append("description", this.form.description);

      axios
        .post("/api/product", formData)
        .then((res) => {
          this.errors = [];
          this.form.name = "";
          this.form.description = "";
          this.success = true;
          this.$toast.success({
            title: "Success",
            message: "Category Created Successfully",
          });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.success = false;
        });
    },
    onImageChange(e) {
      this.form.image = e.target.files[0];
    },
  },
};
</script>
<style scoped>
</style>
