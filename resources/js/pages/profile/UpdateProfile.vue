<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <input ref="fileInput" type="file" class="d-none">
                                <img @click="openInput" class="profile-user-img img-circle" src="img/zoro.png"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ form.name }}</h3>

                            <p class="text-muted text-center">Admin</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab"><i
                                            class="fa fa-user mr-1"></i> Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab"><i
                                            class="fa fa-key mr-1"></i> Change
                                        Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <form @submit.prevent="updateProfile()" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input v-model="form.name" type="text" class="form-control"
                                                    id="inputName" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input v-model="form.email" type="email" class="form-control "
                                                    id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fa fa-save mr-1"></i> Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="changePassword">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="currentPassword" class="col-sm-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control " id="currentPassword"
                                                    placeholder="Current Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newPassword" class="col-sm-3 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control " id="newPassword"
                                                    placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirm
                                                New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control " id="passwordConfirmation"
                                                    placeholder="Confirm New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fa fa-save mr-1"></i> Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style>
.profile-user-img:hover {
    background-color: blue;
    cursor: pointer;
}
</style>

<script setup>
import { onMounted, ref } from 'vue';


const form = ref({
    name: '',
    email: '',
});

const getUser = () => {
    axios.get('/api/profile')
        .then((response) => {
            form.value = response.data;
        });
};

const updateProfile = () => {
    axios.put('/api/profile', form.value)
        .then((response) => {
            alert("profile saved")
        });
};

const fileInput = ref(null);

const openInput = () => {
    fileInput.value.click();
};

onMounted(() => {
    getUser();
});

</script>