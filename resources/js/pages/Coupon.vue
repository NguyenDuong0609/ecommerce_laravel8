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
            Add Coupon
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
                      <th>Code</th>
                      <th>Type</th>
                      <th>Valur</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(coupon, index) in coupons">
                      <td>{{ coupon.id }}</td>
                      <td>{{ coupon.name }}</td>
                      <td>{{ coupon.code }}</td>
                      <td>{{ coupon.type }}</td>
                      <td>{{ coupon.value }}</td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-default"
                          data-toggle="modal"
                          data-target="#modal-default"
                          v-on:click="popup('edit', coupon.id)"
                        >
                          Edit
                        </button>

                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#modal-sm"
                          v-on:click="popupDeleted(coupon.id)"
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
            <h4 class="modal-title">{{ title }} Coupon</h4>
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
                  <label for="exampleInputEmail1">Code</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="code"
                    name="code"
                    id="code"
                  />
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Type</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="type"
                    name="type"
                    id="type"
                  />
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Value</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="value"
                    name="value"
                    id="value"
                  />
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
            <p>Bạn muốn xóa coupon {{ coupon_id }}</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              style="color: white"
              v-on:click="deleteCoupon()"
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
    this.getCoupons();
  },
  data() {
    return {
      coupons: [],
      coupon_id: "",
      title: "",
      name: "",
      code: "",
      type: "",
      value: ""
    };
  },
  methods: {
    getCoupons: function () {
      axios
        .get("https://ecommerce.test/api/coupon/")
        .then((res) => {
          this.coupons = res.data.data;
        })
        .catch((error) => console.log(error));
    },
    popup: function (title, id) {
      this.coupon_id = "";
      this.title = "";
      if (id == null) {
        (this.title = title), (this.name = ""), (this.code = ""), (this.type = ""), (this.value = "");
      } else {
        console.log(id);
        axios
          .get("https://ecommerce.test/api/coupon/" + id)
          .then((res) => {
            this.coupon_id = res.data.data[0].id;
            this.name = res.data.data[0].name;
            this.code = res.data.data[0].code;
            this.type = res.data.data[0].type;
            this.value = res.data.data[0].value;
            this.title = title;
          })
          .catch((error) => console.log(error));
      }
      $("#modal-default").addClass("modal fade show");
    },
    update: function () {
      axios
        .put("https://ecommerce.test/api/coupon/" + this.coupon_id, {
          name: this.name,
          code: this.code,
          type: this.type,
          value: this.value,
        })
        .then((res) => {
          if (!res.data.error) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.parentSelected = "";
            this.name = "";
            this.code = "";
            this.type = "";
            this.value = "";
            this.getCoupons();
          } else {
              toastr.success(res.data.error);
          }
        })
        .catch((error) => console.log(error));
    },
    add: function (e) {
      console.log(this.slug);
      axios
        .post("https://ecommerce.test/api/coupon/add", {
          name: this.name,
          code: this.code,
          type: this.type,
          value: this.value
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User add successfully");
            this.getCoupons();
          } else {
            toastr.error("Please fill in form");
          }
        })
        .catch((error) => console.log(error));
    },
    submit: function () {
      if (this.coupon_id != "") {
        this.update();
      } else {
        this.add();
      }
    },
    popupDeleted: function (id) {
      this.coupon_id = id;
    },
    deleteCoupon: function () {
      axios
        .delete("https://ecommerce.test/api/coupon/" + this.coupon_id)
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-sm").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.name = "";
            this.code = "";
            this.type = "";
            this.value = "";
            this.getCoupons();
          } else {
            toastr.error(res.data.errors);
          }
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
