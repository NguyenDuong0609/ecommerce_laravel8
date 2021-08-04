<template>
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
                mounted() {
                    console.log('Component mounted.')
                }
            }
</script>
