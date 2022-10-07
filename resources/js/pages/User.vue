<template>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List User</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div> -->
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
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <div class="col-1">
                <button
                  type="button"
                  class="btn btn-primary btn-block"
                  data-toggle="modal"
                  data-target="#modal-default"
                  style="margin-top: 5px; margin-left: 12px"
                  v-on:click="popup('Add')"
                >
                  Add User
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user, index) in users">
                      <td>{{ user.id }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-default"
                          data-toggle="modal"
                          data-target="#modal-default"
                          :data-user-id="user.id"
                          v-on:click="popup('edit', user.id)"
                        >
                          Edit
                        </button>

                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#modal-sm"
                          v-on:click="popupDeleted(user.id)"
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
                      <th>Email</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- <create_update></create_update> -->
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">{{ title }} User</h4>
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
                            <label for="exampleInputEmail1">Email address</label>
                            <input
                              type="email"
                              class="form-control"
                              name="email"
                              id="email"
                              v-model="email"
                              placeholder="Enter email"
                            />
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input
                              type="password"
                              class="form-control"
                              name="password"
                              id="password"
                              v-model="password"
                              placeholder="Password"
                            />
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password Confirm</label>
                            <input
                              type="password"
                              class="form-control"
                              name="password_confirm"
                              id="password_confirm"
                              v-model="password_confirmation"
                              placeholder="Password confirm"
                            />
                            <input
                              type="hidden"
                              v-model="user_id"
                              name="user_id"
                              id="user_id"
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
                      <h4 class="modal-title">Delete User</h4>
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
                      <p>Bạn muốn xóa user {{ user_id }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary"
                        v-on:click="deleteUser()"
                      >
                        Save changes
                      </button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <!-- /.modal -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  mounted() {
    $(function () {
      $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
      });
    });
    this.getUsers();
  },
  data() {
    return {
      users: [],
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      user_id: "",
      title: "",
    };
  },
  methods: {
    popup: function (title, id) {
      this.user_id = "";
      this.title = "";
      if (id == null) {
        this.name = "";
        this.email = "";
        this.password = "";
        this.password_confirmation = "";
        this.title = title;
        $("#password").attr("disabled", false);
        $("#password_confirm").attr("disabled", false);
      } else {
        $("#password").attr("disabled", true);
        $("#password_confirm").attr("disabled", true);
        axios
          .get(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/user/" + id)
          .then((res) => {
            this.user_id = res.data.data.id;
            this.name = res.data.data.name;
            this.email = res.data.data.email;
            this.title = title;
          })
          .catch((error) => console.log(error));
      }
    },
    update: function () {
      axios
        .put(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/user/" + this.user_id, {
          email: this.email,
          name: this.name,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.name = "";
            this.email = "";
            this.getUsers();
          }
        })
        .catch((error) => console.log(error));
    },
    register: function (e) {
      axios
        .post(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/user/signup", {
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          name: this.name,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User add successfully");
            this.getUsers();
          } else {
            toastr.error("Please fill in form");
          }
        })
        .catch((error) => console.log(error));
    },
    submit: function () {
      if (this.user_id != "") {
        this.update();
      } else {
        this.register();
      }
    },
    popupDeleted: function (id) {
      this.user_id = id;
    },
    deleteUser: function () {
      axios
        .delete(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/user/" + this.user_id)
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-sm").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User delete successfully");
            this.name = "";
            this.email = "";
            this.getUsers();
          }
        })
        .catch((error) => console.log(error));
    },
    getUsers: function () {
      axios
        .get(process.env.MIX_SENTRY_DSN_PUBLIC + "/api/user")
        .then((res) => {
          this.users = res.data.data;
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
