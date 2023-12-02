<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="col-1" style="margin-left: -20px; margin-bottom: 5px">
          <router-link
            class="btn btn-primary btn-block"
            :class="[{ active: $route.name === 'createproduct' }]"
            style="height: 38px; margin-left: 12px"
            :to="{ name: 'createproduct' }"
          >
            <p>Add Product</p>
          </router-link>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Nhà cung cấp</th>
                      <th>Tồn kho</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product, index) in products">
                      <td>
                        {{ product.id }}
                        <img
                          width="70"
                          height="70"
                          v-bind:src="product.images.split(',')[1]"
                          v-if="product.images.includes(',')"
                        />
                        <img
                          width="70"
                          height="70"
                          v-bind:src="APP_URL + product.images"
                          v-if="product.images.includes(',') == false"
                        />
                      </td>
                      <td>{{ product.title }}</td>
                      <td>{{ product.category.name }}</td>
                      <td>{{ product.brand_id }}</td>
                      <td>{{ product.quality }}</td>
                      <td>
                        <router-link
                          class="btn btn-default"
                          :class="[{ active: $route.name === 'getproduct' }]"
                          style="height: 38px; margin-left: 12px"
                          :to="{ name: 'getproduct', params: { idProduct: product.id } }"
                        >
                          <p>Edit Product</p>
                        </router-link>
                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#modal-sm"
                          v-on:click="popupDeleted(product.id)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Rendering engine</th>
                      <th>Browser</th>
                      <th>Platform(s)</th>
                      <th>Engine version</th>
                      <th>CSS grade</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <nav>
              <ul class="pagination">
                <li v-bind:class="{ disabled: !pagination.first_link }" class="page-item">
                  <a
                    href="#"
                    @click="getProducts(pagination.first_link)"
                    class="page-link"
                    >&laquo;</a
                  >
                </li>
                <li v-bind:class="{ disabled: !pagination.prev_link }" class="page-item">
                  <a href="#" @click="getProducts(pagination.prev_link)" class="page-link"
                    >&lt;</a
                  >
                </li>
                <li
                  v-for="n in pagination.last_page"
                  v-bind:key="n"
                  v-bind:class="{ active: pagination.current_page == n }"
                  class="page-item"
                >
                  <a
                    href="#"
                    @click="getProducts(pagination.path_page + n)"
                    class="page-link"
                    >{{ n }}</a
                  >
                </li>
                <li v-bind:class="{ disabled: !pagination.next_link }" class="page-item">
                  <a href="#" @click="getProducts(pagination.next_link)" class="page-link"
                    >&gt;</a
                  >
                </li>
                <li v-bind:class="{ disabled: !pagination.last_link }" class="page-item">
                  <a href="#" @click="getProducts(pagination.last_link)" class="page-link"
                    >&raquo;</a
                  >
                </li>
              </ul>
            </nav>
          </div>
          <div class="col-md-4">
            Page: {{ pagination.from_page }} - {{ pagination.to_page }} Total:
            {{ pagination.total_page }}
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="modal-sm">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Delete User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn muốn xóa product {{ idProduct }}</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              style="color: white"
              v-on:click="deleteProduct()"
            >
              Save changes
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>

<script>

export default {
    // computed: {
    //     products() {
    //         return this.$store.state.products.data;
    //     },
    // },
  mounted() {
    //   this.$store.dispatch('getProducts');
    this.getProducts();
  },
  data() {
    return {
      products: [],
      idProduct: "",
      pagination: {},
      AWS_URL: process.env.MIX_SENTRY_DSN_PUBLIC_AWS_URL,
      APP_URL: process.env.MIX_SENTRY_DSN_PUBLIC + "/"
    };
  },
  methods: {
    getProducts: function (pagi) {
      pagi = pagi || process.env.MIX_SENTRY_DSN_PUBLIC + "/api/product/";
      axios
        .get(pagi)
        .then((res) => {
          this.products = res.data.data.data;
          this.pagination = {
            current_page: res.data.data.current_page,
            last_page: res.data.data.last_page,
            from_page: res.data.data.from,
            to_page: res.data.data.to,
            total_page: res.data.data.total,
            path_page: res.data.data.path + "?page=",
            first_link: res.data.data.first_page_url,
            last_link: res.data.data.last_page_url,
            prev_link: res.data.data.prev_page_url,
            next_link: res.data.data.next_page_url,
          };
        })
        .catch((error) => console.log(error));
    },
    popupDeleted: function (id) {
      this.idProduct = id;
    },
    deleteProduct: function () {
      axios
        .delete(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/product/" + this.idProduct)
        .then((res) => {
          console.log(res);
          if (!res.data.errors) {
            $("#modal-sm").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("Delete product successfully");
            this.name = "";
            this.slug = "";
            this.getProducts();
          } else {
            toastr.error(res.data.errors);
          }
        })
        .catch((error) => console.log(error));
      // $("#modal-sm").css("display", "none");
      // $("div").removeClass("modal-backdrop fade show");
      // this.getProducts();
    },
  },
};
</script>
