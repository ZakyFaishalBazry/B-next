<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ isEditMode ? 'Edit' : 'Create' }} Appointment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link to="/CRUD">Appointments</router-link>
                        </li>
                        <li class="breadcrumb-item active">{{ isEditMode ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="handleSubmit">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" v-model="form.first_name" class="form-control"
                                                id="first_name" placeholder="Enter First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" v-model="form.last_name" class="form-control"
                                                id="last_name" placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" v-model="form.email" class="form-control" id="email"
                                                placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Tabungan</label>
                                            <select v-model.number="form.status" id="status" class="form-control">
                                                <option :value="1">WADIYAH</option>
                                                <option :value="2">MUDHARABAH</option>
                                                <option :value="3">VALAS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ isEditMode ? 'Update' : 'Submit'
                                    }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const isEditMode = ref(false);
const form = reactive({
    first_name: '',
    last_name: '',
    email: '',
    status: 1
});

const fetchAppointment = async (id) => {
    try {
        const { data } = await axios.get(`/api/appointments/${id}`);
        form.first_name = data.client.first_name;
        form.last_name = data.client.last_name;
        form.email = data.client.email;
        form.status = data.status;
    } catch (error) {
        console.error(error);
    }
};

const handleSubmit = async () => {
    try {
        if (isEditMode.value) {
            await axios.put(`/api/appointments/${route.params.id}`, form);
        } else {
            await axios.post('/api/appointments', form);
        }
        router.push('/CRUD');
    } catch (error) {
        console.error(error);
    }
};

onMounted(() => {
    if (route.params.id) {
        isEditMode.value = true;
        fetchAppointment(route.params.id);
    }
});
</script>
