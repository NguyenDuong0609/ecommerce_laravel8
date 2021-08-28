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
            Add Producer
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
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(producer, index) in producers">
                      <td>{{ producer.id }}</td>
                      <td>{{ producer.name }}</td>
                      <td>{{ producer.address }}</td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-default"
                          data-toggle="modal"
                          data-target="#modal-default"
                          :data-producer-id="producer.id"
                          v-on:click="popup('edit', producer.id)"
                        >
                          Edit
                        </button>

                        <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="modal"
                          data-target="#modal-sm"
                          v-on:click="popupDeleted(producer.id)"
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
                      <th>Address</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <!-- Create Producer -->
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">{{ title }} Producer</h4>
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
                            <label for="exampleInputEmail1">Address</label>
                            <input
                              type="text"
                              class="form-control"
                              name="address"
                              id="address"
                              v-model="address"
                              placeholder="Enter address"
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
                      <h4 class="modal-title">Delete Producer</h4>
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
                      <p>Bạn muốn xóa Producer {{ producer_id }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary"
                        style="color: white"
                        v-on:click="deleteProducer()"
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
    this.getProducers();
  },
  watch: {
    name() {
      this.slug = this.sanitizeTitle(this.name);
    },
  },
  data() {
    return {
      producers: [],
      title: "",
      name: "",
      address: "",
      slug: "",
      producer_id: "",
    };
  },
  methods: {
    getProducers: function () {
      axios
        .get("https://ecommerce.test/api/producer")
        .then((res) => {
          this.producers = res.data.data;
        })
        .catch((error) => console.log(error));
    },
    popup: function (title, id) {
      this.producer_id = "";
      this.title = "";
      if (id == null) {
        (this.title = title), (this.name = ""), (this.slug = ""), (this.address = "");
      } else {
        axios
          .get("https://ecommerce.test/api/producer/" + id)
          .then((res) => {
            this.producer_id = res.data.data[0].id;
            this.name = res.data.data[0].name;
            this.slug = res.data.data[0].slug;
            this.address = res.data.data[0].address;
          })
          .catch((error) => console.log(error));
      }
      $("#modal-default").addClass("modal fade show");
    },
    update: function () {
      axios
        .put("https://ecommerce.test/api/producer/" + this.producer_id, {
          name: this.name,
          slug: this.slug,
          address: this.address,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User updatr successfully");
            this.address = "";
            this.name = "";
            this.slug = "";
            this.getProducers();
          }
        })
        .catch((error) => console.log(error));
    },
    add: function (e) {
      axios
        .post("https://ecommerce.test/api/producer/add", {
          name: this.name,
          address: this.address,
          slug: this.slug,
        })
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("User add successfully");
            this.getProducers();
          } else {
            toastr.error("Please fill in form");
          }
        })
        .catch((error) => console.log(error));
    },
    submit: function () {
      if (this.producer_id != "") {
        this.update();
      } else {
        this.add();
      }
    },
    popupDeleted: function (id) {
      this.producer_id = id;
    },
    deleteProducer: function () {
      axios
        .delete("https://ecommerce.test/api/producer/" + this.producer_id)
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-sm").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("Producer updatr successfully");
            this.name = "";
            this.slug = "";
            this.address = "";
            this.getProducers();
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
