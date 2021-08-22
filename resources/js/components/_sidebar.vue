<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img
        src="dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            src="dist/img/user2-160x160.jpg"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ infoUser.name }}</a>
        </div>
        <div class="info">
          <a href="#" class="d-block" v-on:click="logout">Log out</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input
            class="form-control form-control-sidebar"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="[{active: $route.name === 'user'}]"
                    :to="{name: 'user'}"
                >
                    <i class="nav-icon fas fa-user"></i>
                    <p>Users</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="[{active: $route.name === 'category'}]"
                    :to="{name: 'category'}"
                >
                    <i class="nav-icon fas fa-list"></i>
                    <p>Category</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="[{active: $route.name === 'product'}]"
                    :to="{name: 'product'}"
                >
                    <i class="fas fa-box"></i></i>
                    <p>Product</p>
                </router-link>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {
  mounted() {

    axios
      .get("https://ecommerce.test/api/user/me")
      .then((res) => {
        this.infoUser = res.data;
      })
      .catch((error) => window.location.href='/admin/login');
  },
  data() {
    return {
      token: "",
      infoUser: "",
    };
  },
  methods: {
    logout: function () {
      axios
        .delete("https://ecommerce.test/api/user/logout")
        .then((res) => {
            if(res.data = 'success') {
                // this.$cookies.remove('token');
                localStorage.removeItem('authenticate');
                window.location.href='/admin/login';
            }
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
