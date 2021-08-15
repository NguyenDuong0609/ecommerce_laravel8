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
            Add Category
          </button>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table class="table table-bordered table-hover" id="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Parent</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category, index) in categories">
                      <td>{{ category.id }}</td>
                      <td>{{ category.name }}</td>
                      <td>{{ category.slug }}</td>
                      <td>{{ category.parent_id }}</td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-default"
                          data-toggle="modal"
                          data-target="#modal-default"
                          v-on:click="popup('edit', category.id)"
                        >
                          Edit
                        </button>

                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#modal-sm"
                          v-on:click="popupDeleted(category.id)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- edit component -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ title }} Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                <div class="form-group">
                  <label>Select</label>
                  <select class="form-control" v-model="parentSelected">
                    <option disabled>Please select one</option>
                    <option value="">Parent</option>
                    <option
                      v-for="(parent, index) in parentCate"
                      v-bind:value="parent.id"
                    >
                      {{ parent.name }}
                    </option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="color: white">
                  Submit
                </button>
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
            <h4 class="modal-title">Delete User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn muốn xóa cate {{ cate_id }}</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              style="color: white"
              v-on:click="deleteCategory()"
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
  mounted() {
    this.getCategories();
  },
  watch: {
    name() {
      this.slug = this.sanitizeTitle(this.name);
    },
  },
  data() {
    return {
      categories: [],
      parentCate: [],
      parentSelected: "",
      cate_id: "",
      title: "",
      name: "",
      slug: "",
    };
  },
  methods: {
    getCategories: function () {
      axios
        .get("https://ecommerce.test/api/category/")
        .then((res) => {
          this.categories = res.data.data;
        })
        .catch((error) => console.log(error));
    },
    getParentCate: function () {
      axios
        .get("https://ecommerce.test/api/category/parent-cate")
        .then((res) => {
          this.parentCate = res.data.data;
        })
        .catch((error) => console.log(error));
    },
    popup: function (title, id) {
      this.getParentCate();
      this.cate_id = "";
      this.title = "";
      if (id == null) {
        (this.title = title), (this.name = ""), (this.slug = "");
      } else {
        console.log(id);
        axios
          .get("https://ecommerce.test/api/category/" + id)
          .then((res) => {
            this.cate_id = res.data.data[0].id;
            this.name = res.data.data[0].name;
            this.slug = res.data.data[0].slug;
            this.parentSelected = res.data.data[0].parent_id;
            this.title = title;
          })
          .catch((error) => console.log(error));
      }
      $("#modal-default").addClass("modal fade show");
    },
    update: function () {
      console.log(this.parentSelected);
      axios
        .put("https://ecommerce.test/api/category/" + this.cate_id, {
          name: this.name,
          slug: this.slug,
          parent_id: this.parentSelected,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.parentSelected = "";
            this.name = "";
            this.slug = "";
            this.getCategories();
          }
        })
        .catch((error) => console.log(error));
    },
    add: function (e) {
      console.log(this.slug);
      axios
        .post("https://ecommerce.test/api/category/add", {
          name: this.name,
          slug: this.slug,
          parent_id: this.parentSelected,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User add successfully");
            this.getCategories();
          } else {
            toastr.error("Please fill in form");
          }
        })
        .catch((error) => console.log(error));
    },
    submit: function () {
      if (this.cate_id != "") {
        this.update();
      } else {
        this.add();
      }
    },
    popupDeleted: function (id) {
      this.cate_id = id;
    },
    deleteCategory: function () {
      axios
        .delete("https://ecommerce.test/api/category/" + this.cate_id)
        .then((res) => {
          console.log(res);
          if (!res.data.errors) {
            $("#modal-sm").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.name = "";
            this.slug = "";
            this.getCategories();
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
