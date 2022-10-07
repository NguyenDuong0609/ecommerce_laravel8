<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table class="table table-bordered table-hover" id="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Avatar</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(customer, index) in customers">
                      <td>{{ customer.id }}</td>
                      <td>{{ customer.name }}</td>
                      <td>{{ customer.email }}</td>
                      <td>{{ customer.avatar }}</td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-default"
                          data-toggle="modal"
                          data-target="#modal-default"
                          v-on:click="popup('edit', customer.id)"
                        >
                          Edit
                        </button>

                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#modal-sm"
                          v-on:click="popupDeleted(customer.id)"
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
            <h4 class="modal-title">Customer</h4>
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
                  <label for="exampleInputEmail1">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    v-model="email"
                    name="email"
                    id="email"
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
            <h4 class="modal-title">Delete Customer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn muốn xóa customer {{ customer_id }}</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              style="color: white"
              v-on:click="deleteCustomer()"
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
    this.getCustomers();
  },
  data() {
    return {
      customers: [],
      customer_id: "",
      email: "",
      name: ""
    };
  },
  methods: {
    getCustomers: function () {
      axios
        .get(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/customer/")
        .then((res) => {
          this.customers = res.data.data;
        })
        .catch((error) => console.log(error));
    },
    popup: function (title, id) {
        console.log(id);
      this.customer_id = "";
      this.title = "";
      if (id == null) {
        (this.title = title), (this.name = ""), (this.email = "");
      } else {
        axios
          .get(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/customer/" + id)
          .then((res) => {
              this.customer_id = res.data.data.id;
            this.name = res.data.data.name;
            this.email = res.data.data.email;
            this.title = title;
          })
          .catch((error) => console.log(error));
      }
      $("#modal-default").addClass("modal fade show");
    },
    update: function () {
      axios
        .put(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/customer/" + this.customer_id, {
          name: this.name,
          email: this.email,
        })
        .then((res) => {
          if (!res.data.error) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.name = "";
            this.email = "";
            this.getCustomers();
          } else {
              toastr.success(res.data.error);
          }
        })
        .catch((error) => console.log(error));
    },
    submit: function () {
      if (this.customer_id != "") {
        this.update();
      }
    },
    popupDeleted: function (id) {
      this.customer_id = id;
    },
    deleteCustomer: function () {
      axios
        .delete(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/customer/" + this.customer_id)
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-sm").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.name = "";
            this.email = "";
            this.getCustomers();
          } else {
            toastr.error(res.data.errors);
          }
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
