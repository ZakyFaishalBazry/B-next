<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B-Next</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color:rgb(80, 77, 77)">
    <div class="container px-1 pt-5 ">
        <div class="row">
            <div class="col-7 mb-5 " style="z-index: 10">
                <img src="img/logo Bsi.png" alt="BSI">
                <div id="parent">
                    <div class="continer"><b style="color: #04ACA0">Catatan</b></div>
                    <div class="continet py-3 px-2"><b>1. Apabila anda memiliki masalah dengan sistem, silahkan open
                            tiket pada</b>
                        <a href="" class=" py-3 px-3">Https://userid.bankbsi.co.id</a>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="Infor"><b style="color: #04ACA0">Informasi</b></div>
                    <div class="infonet"><b></b>
                    </div>
                </div>
                <div class="mt-5">
                    <h1 style="color: #F7AF2E">B-Next</h1>
                    <h1 style="color: #F7AF2E">Brach New Exa Trasformaion</h1>
                </div>
            </div>

            <div class="col-lg-2 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div id="app">
                    <router-view>
                        <login />
                    </router-view>
                </div>
                {{-- <div class="card ">
                    <div class="card-body p-5 ">
                        <form>
                            <!-- 2 column grid layout with text inputs for the first and last names -->
                            <div class="d-flex">
                                <div class="mb-4">
                                    <h3>Login To </h3>
                                    <h3>B-Next Aplication</h3>
                                </div>
                                <i class="fas fa-lock fa-3x mt-2" style="margin-left: 40px; color:wheat"></i>
                            </div>

                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-3">
                                <label>Email</label>
                                <input type="email" id="form3Example3" class="form-control "
                                    style="border-radius: 13px" />
                            </div>

                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-5">
                                <label>Password</label>
                                <input type="password" id="form3Example4" class="form-control p-3"
                                    style="border-radius: 13px" />
                            </div>

                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block mb-4">
                                Login
                            </button>
                            <!-- Checkbox -->
                            <div class="text-center mb-4">
                                <a href="">Forgot Password ?</a>
                            </div>

                            <!-- Submit button -->
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- <div id="app" class="hold-transition login-page">
        <router-view>
            <login />
        </router-view>
    </div> --}}
</body>

<style>
    html * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-image: url(img/BKG.jpeg);
        background-size: cover;
        background-repeat: no-repeat;
        opacity: 0.5;
    }

    .card {
        height: 580px;
        width: 388px;
        border-radius: 20px;
        margin-left: 100px;
        background: linear-gradient(#B2FFF9, #FAFFFF);
    }

    #parent {
        position: relative;
    }

    .continer {
        background-color: #FAFFFF;
        height: 28px;
        width: 130px;
        padding-left: 10px;
        margin-top: 90px;
        border: solid #04ACA0;
    }

    .continet {
        background-color: #FAFFFF;
        height: 90px;
        outline: solid #04ACA0;
    }

    .Infor {
        background-color: #FAFFFF;
        height: 28px;
        width: 130px;
        padding-left: 10px;
        border: solid #04ACA0;
    }

    .infonet {
        background-color: #FAFFFF;
        height: 90px;
        outline: solid #04ACA0;
        padding-top: 120px
    }

    /* body {
        background-image: url(img/BKG.jpeg)
    } */
</style>

</html>
