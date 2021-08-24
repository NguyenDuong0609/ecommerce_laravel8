<template>
  <div class="content-wrapper">
    <form @submit.prevent="submit">
      <section class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">Summernote</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Enter title"
                    id="title"
                    v-model="title"
                  />
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Short Description</label>
                  <textarea
                    id="shortDescription"
                    v-model="short_description"
                    name="shortDescription"
                  >
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea id="description" v-model="description">
                          Place <em>some</em> <u>text</u> <strong>here</strong>
                      </textarea
                  >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">specification</label>
                  <textarea id="specification" v-model="specification">
                          Place <em>some</em> <u>text</u> <strong>here</strong>
                      </textarea
                  >
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input
                        type="file"
                        class="custom-file-input"
                        id="file"
                        v-on:change="onFileChange"
                        multiple
                      />
                      <label class="custom-file-label" for="exampleInputFile"
                        >Choose file</label
                      >
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Enter price"
                    id="price"
                    v-model="price"
                  />
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Quality</label>
                  <input
                    type="number"
                    class="form-control"
                    id="quality"
                    placeholder="Enter quality"
                    v-model="quality"
                  />
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Slug</label>
                  <input
                    type="text"
                    class="form-control"
                    id="slug"
                    placeholder="Enter title"
                    v-model="slug"
                    disabled="disabled"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-outline card-info">
              <div class="card-body">
                <div class="form-group">
                  <label class="form-check-label">Trạng Thái</label>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      value="1"
                      v-model="status"
                    />
                    <label class="form-check-label">Hiển thị</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      value="0"
                      v-model="status"
                    />
                    <label class="form-check-label">Ẩn</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-outline card-info">
              <div class="card-body">
                <div class="form-group">
                  <label>Category</label>
                  <select
                    class="form-control select2"
                    style="width: 100%"
                    v-model="category_id"
                  >
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Product Type</label>
                  <select
                    class="form-control select2"
                    style="width: 100%"
                    v-model="product_type_id"
                  >
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Branch</label>
                  <select
                    class="form-control select2"
                    style="width: 100%"
                    v-model="brand_id"
                  >
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" style="color: white">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
//   computed: {
//     product() {
//       return this.$store.state.product;
//     },
//   },
  mounted() {
    $(function () {
      // Summernote
      $("#shortDescription").summernote();
      $("#description").summernote();
      $("#specification").summernote();

      // CodeMirror
      // var editor = CodeMirror.fromTextArea(document.getElementById("shortDescription"), {
      //     mode: "htmlmixed",
      //     lineNumbers: true,
      // });

      $(function () {
        bsCustomFileInput.init();
      });
      //Initialize Select2 Elements
      $(".select2").select2();
    });

    if (this.$route.params.idProduct !== undefined) {
      axios
        .get("https://ecommerce.test/api/product/" + this.$route.params.idProduct)
        .then((res) => {
          localStorage.setItem("short_description", res.data.data[0].short_description);
          localStorage.setItem("description", res.data.data[0].description);
          localStorage.setItem("specification", res.data.data[0].specification);
          this.title = res.data.data[0].title;
          this.price = res.data.data[0].price;
          this.quality = res.data.data[0].quality;
          this.slug = res.data.data[0].slug;
          this.status = res.data.data[0].status;
          this.images = res.data.data[0].images;
        })
        .catch((error) => console.log(error));
      this.short_description = localStorage.getItem("short_description");
      this.description = localStorage.getItem("description");
      this.specification = localStorage.getItem("specification");
    }
  },
  watch: {
    title() {
      this.slug = this.sanitizeTitle(this.title);
    },
  },
  data() {
    return {
      images: [],
      categories: "",
      product_types: "",
      brands: "",
      title: "",
      brand_id: 1,
      category_id: 1,
      product_type_id: 1,
      price: "",
      status: "",
      short_description: "",
      description: "",
      specification: "",
      quality: "",
      discount: 1,
      slug: "",
      files: [],
    };
  },
  methods: {
    onFileChange(e) {
      let selectedFile = e.target.files;
      for (let i = 0; i < selectedFile.length; i++) {
        this.files.push(selectedFile[i]);
      }
    },
    add() {
      this.short_description = $("#shortDescription").val();
      this.description = $("#description").val();
      this.specification = $("#specification").val();
      this.brand_id = 1;
      this.category_id = 1;
      this.product_type_id = 1;
      let formData = new FormData();
      formData.append("title", this.title);
      formData.append("brand_id", this.brand_id);
      formData.append("category_id", this.category_id);
      formData.append("product_type_id", this.product_type_id);
      formData.append("price", this.price);
      formData.append("status", this.status);
      formData.append("short_description", this.short_description);
      formData.append("description", this.description);
      formData.append("specification", this.specification);
      formData.append("quality", this.quality);
      formData.append("discount", this.discount);
      formData.append("slug", this.slug);
      for (let i = 0; i < this.files.length; i++) {
        formData.append("files[]", this.files[i]);
      }
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      axios
        .post("https://ecommerce.test/api/product/add", formData, config)
        .then((res) => {
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("Product add successfully");
            window.location.href = "/admin";
          } else {
            toastr.error("Please fill in form");
          }
        })
        .catch((error) => console.log(error));
    },
    update() {
      this.short_description = $("#shortDescription").val();
      this.description = $("#description").val();
      this.specification = $("#specification").val();
      this.brand_id = 1;
      this.category_id = 1;
      this.product_type_id = 1;
      let formData = new FormData();
      formData.append("title", this.title);
      formData.append("brand_id", this.brand_id);
      formData.append("category_id", this.category_id);
      formData.append("product_type_id", this.product_type_id);
      formData.append("price", this.price);
      formData.append("status", this.status);
      formData.append("short_description", this.short_description);
      formData.append("description", this.description);
      formData.append("specification", this.specification);
      formData.append("quality", this.quality);
      formData.append("discount", this.discount);
      formData.append("slug", this.slug);

      if (this.files.length > 0) {
        for (let i = 0; i < this.files.length; i++) {
          formData.append("files[]", this.files[i]);
        }
      }
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      axios
        .post(
          "https://ecommerce.test/api/product/" + this.$route.params.idProduct,
          formData,
          config
        )
        .then((res) => {
          console.log(res);
          if (!res.data.errors) {
            $("#modal-default").css("display", "none");
            $("div").removeClass("modal-backdrop fade show");
            toastr.success("Product updated successfully");
            window.location.href = "/admin";
          } else {
            toastr.error("Please fill in form");
          }
        })
        .catch((error) => console.log(error));
    },
    submit() {
      if (this.$route.params.idProduct !== undefined) {
        this.update();
      } else {
        this.add();
      }
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
