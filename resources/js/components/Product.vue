<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">
              Product
              <router-link
                :to="{ name: 'create-product' }"
                class="btn btn-primary btn-sm float-right"
                >Create Product</router-link
              >
            </h5>
          </div>

          <div class="card-body">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Product Title</th>
                  <th>Product Price</th>
                  <th>Product Slug</th>
                  <th>Product Image</th>
                  <th>Product Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products" :key="product.id">
                  <td>{{ product.id }}</td>
                  <td>{{ product.title }}</td>
                  <td>{{ product.price }}</td>
                  <td>{{ product.slug }}</td>
                  <td><img width="50" :src="product.image" alt="image"></td>
                  <td>{{ product.description }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'edit-product',
                        params: { id: product.id },
                      }"
                      class="btn btn-info btn-sm"
                      >Edit</router-link
                    >
                    <a @click.prevent="deleteProduct(product)" href="" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
    };
  },
  methods: {
    loadProducts() {
      axios.get("/api/product").then((response) => {
        this.products = response.data;
      });
    },
    deleteProduct(product) {
      axios.delete(`/api/product/${product.id}`).then(() => {
        this.loadProducts();
        this.$toast.success({
          title: "Success",
          message: "Product Deleted Successfully",
        });
        
      });
      // let index = this.categories.indexOf(category);
      // this.categories.splice(index,1);
    },
  },
  mounted() {
    this.loadProducts();
  },
};
</script>
<style scoped>
</style>
