<template>
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img
        class="animation__shake"
        :src="`${publicPath}/dist/img/AdminLTELogo.png`"
        alt="AdminLTELogo"
        height="60"
        width="60"
      />
    </div>

    <!-- Navbar -->
    <Navbar></Navbar>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <Sidebar></Sidebar>
    <!-- Content Wrapper. Contains page content -->
    <router-view></router-view>
    <!-- /.content-wrapper -->
    <Footer></Footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</template>

<script>
import Navbar from "./_navbar";
import Footer from "./_footer";
import Sidebar from "./_sidebar";
export default {
  components: { Navbar, Footer, Sidebar },
  data() {
    return {
      publicPath: process.env.MIX_SENTRY_DSN_PUBLIC
    }
  },
  mounted() {
    // if((localStorage.getItem('authenticate') == false) || !(localStorage.getItem('authenticate'))) {
    //      window.location.href='/admin/login';
    // }
    // console.log(localStorage.getItem('authenticate'));
  },

};
</script>
