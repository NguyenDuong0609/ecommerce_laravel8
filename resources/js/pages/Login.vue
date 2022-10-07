<template>
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form @submit.prevent="login">
                <div class="input-group mb-3">
                <input type="email" class="form-control" v-model="email" placeholder="Email" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                </div>
                <div class="input-group mb-3">
                <input type="password" class="form-control" v-model="password" placeholder="Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center">Register a new membership</a>
            </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</template>

<script>
    import axios from 'axios';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login: function (e) {
                console.log(process.env.MIX_SENTRY_DSN_PUBLIC);
                e.preventDefault();
                axios.post(process.env.MIX_SENTRY_DSN_PUBLIC + '/api/user/login', { email: this.email, password: this.password})
                    .then((res) => {
                        if(!res.data.errors) {
                            localStorage.setItem('authenticate', true);
                            window.location.href='/admin/product';
                        }else {
                            alert('Please login');
                        }
                    })
                    .catch((error) => console.log(error));
            }
        }
    }
</script>
