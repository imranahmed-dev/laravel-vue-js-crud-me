<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">
              Edit Category
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
                <form @submit.prevent="updateCategory">
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
                      Update
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
    updateCategory() {
        let id = this.$route.params.id;
      this.form.put(`/api/category/${id}`).then(({}) => {
        this.$toast.success({
          title: "Success",
          message: "Category Updated Successfully",
        });
      });
    },
    loadCategory() {
          let id = this.$route.params.id;
         axios.get(`/api/category/${id}/edit`).then((response) => {
          this.form.name = response.data.name;
      });
    },
  },
  mounted(){
      this.loadCategory();
  },
};
</script>
<style scoped>
</style>
