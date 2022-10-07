<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="col-1" style="margin-left: -20px; margin-bottom: 5px">
          <button
            type="button"
            class="btn btn-primary btn-block"
            data-toggle="modal"
            data-target="#modal-default"
            style="margin-top: 5px; margin-left: 12px"
            v-on:click="popup('Add')"
          >
            Add Type
          </button>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(typeProduct, index) in typeProducts">
                      <td>{{ typeProduct.id }}</td>
                      <td>{{ typeProduct.name }}</td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-default"
                          data-toggle="modal"
                          data-target="#modal-default"
                          :data-type-product-id="typeProduct.id"
                          v-on:click="popup('edit', typeProduct.id)"
                        >
                          Edit
                        </button>

                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#modal-sm"
                          v-on:click="popupDeleted(typeProduct.id)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <!-- Create Producer -->
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">{{ title }} Type Product</h4>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form @submit.prevent="submit">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input
                              type="text"
                              class="form-control"
                              v-model="name"
                              name="name"
                              id="name"
                              placeholder="Enter name"
                            />
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input
                              type="text"
                              class="form-control"
                              v-model="slug"
                              name="slug"
                              id="slug"
                              disabled="disabled"
                            />
                          </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="modal-sm">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Delete Type Product</h4>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Bạn muốn xóa Type {{ type_id }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary"
                        style="color: white"
                        v-on:click="deleteTypeProduct()"
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
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getTypeProduct();
  },
  watch: {
    name() {
      this.slug = this.sanitizeTitle(this.name);
    },
  },
  data() {
    return {
      typeProducts: [],
      title: "",
      name: "",
      slug: "",
      type_id: "",
    };
  },
  methods: {
    getTypeProduct: function () {
      axios
        .get(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/type_product")
        .then((res) => {
          this.typeProducts = res.data.data;
        })
        .catch((error) => console.log(error));
    },
    popup: function (title, id) {
      this.type_id = "";
      this.title = "";
      if (id == null) {
        (this.title = title), (this.name = ""), (this.slug = "");
      } else {
        axios
          .get(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/type_product/" + id)
          .then((res) => {
            this.type_id = res.data.data[0].id;
            this.name = res.data.data[0].name;
            this.slug = res.data.data[0].slug;
          })
          .catch((error) => console.log(error));
      }
      $("#modal-default").addClass("modal fade show");
    },
    update: function () {
      axios
        .put(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/type_product/" + this.type_id, {
          name: this.name,
          slug: this.slug,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("Type Product update successfully");
            this.name = "";
            this.slug = "";
            this.getTypeProduct();
          }
        })
        .catch((error) => console.log(error));
    },
    add: function (e) {
      axios
        .post(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/type_product/add", {
          name: this.name,
          slug: this.slug,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("Type Product add successfully");
            this.getTypeProduct();
          } else {
            toastr.error("Please fill in form");
          }
        })
        .catch((error) => console.log(error));
    },
    submit: function () {
      if (this.type_id != "") {
        this.update();
      } else {
        this.add();
      }
    },
    popupDeleted: function (id) {
      this.type_id = id;
    },
    deleteTypeProduct: function () {
      axios
        .delete(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/type_product/" + this.type_id)
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-sm").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("Type Product delete successfully");
            this.name = "";
            this.slug = "";
            this.getTypeProduct();
          } else {
            toastr.error(res.data.errors);
          }
        })
        .catch((error) => console.log(error));
    },
    sanitizeTitle: function (title) {
      var slug = "";
      // Change to lower case
      var titleLower = title.toLowerCase();
      // Letter "e"
      slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, "e");
      // Letter "a"
      slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, "a");
      // Letter "o"
      slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, "o");
      // Letter "u"
      slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, "u");
      // Letter "d"
      slug = slug.replace(/đ/gi, "d");
      // Trim the last whitespace
      slug = slug.replace(/\s*$/g, "");
      // Change whitespace to "-"
      slug = slug.replace(/\s+/g, "-");

      return slug;
    },
  },
};
</script>
