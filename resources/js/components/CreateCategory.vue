<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">
              Create Category
              <router-link
                :to="{ name: 'category' }"
                class="btn btn-primary btn-sm float-right"
                >Category List</router-link
              >
            </h5>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-2"></div>
              <div class="col-8">
                <form @submit.prevent="createCategory">
                  <div class="form-group">
                    <label for="">Category Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="name"
                      v-model="form.name"
                      placeholder="Category name"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error :form="form" field="name"></has-error>
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
        name: "",
      }),
    };
  },
  methods: {
    createCategory() {
      this.form.post("/api/category").then(({ data }) => {

        this.form.name = '';
        this.$toast.success({
          title: "Success",
          message: "Category Created Successfully",
        });
      });
    },
  },
};
</script>
<style scoped>
</style>
