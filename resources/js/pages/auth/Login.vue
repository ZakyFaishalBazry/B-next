<script setup>
import axios from 'axios';
import { reactive, ref } from 'vue';
import { useToastr } from '../../toastr';


const toastr = useToastr();


const form = reactive({
    email: '',
    password: '',
});

const handleSubmit = () => {
    axios.post('/login', form)
        .then(() => {
            window.location.href = "/";
        })
        .catch((error) => {
            toastr.error('Error Email or Password is not Valid');
        });
};

</script>

<template>
    <div class="card ">
        <div class="card-body p-5 mt-5">
            <form @submit.prevent="handleSubmit">
                <!-- 2 column Diatas-->
                <div class="d-flex">
                    <div class="mb-4">
                        <h4>Login To </h4>
                        <h4>B-Next Aplication</h4>
                    </div>
                    <i class="fas fa-lock fa-4x" style="margin-left: 40px; color: #F7AF2E;"></i>
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-3">
                    <label>Email</label>
                    <input v-model="form.email" type="email" id="form3Example3" class="form-control "
                        style="border-radius: 13px" />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label>Password</label>
                    <input v-model="form.password" type="password" id="form3Example4" class="form-control p-3"
                        style="border-radius: 13px" />
                </div>
                <!-- Login Btn -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-warning btn-block btn-lg shadow-lg white text-white mb-5">
                    Login
                </button>
                <!-- Forgot -->
                <div class="text-center mb-4">
                    <a href="#" style="color: #04ACA0 ;">Forgot Password ?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1">B-Next</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form @submit.prevent="handleSubmit">
                    <div class="input-group mb-3">
                        <input v-model="form.email" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input v-model="form.password" type="password" class="form-control" placeholder="Password">
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

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>

                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>

        </div>
    </div> -->
</template>