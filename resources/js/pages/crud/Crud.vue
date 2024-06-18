<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CRUD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <RouterLink to="/">Dashboard</RouterLink>
                        </li>
                        <li class="breadcrumb-item active">CRUD</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <RouterLink to="/CRUD/Create">
                                <button class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New
                                    Data</button>
                            </RouterLink>
                        </div>
                        <div class="btn-group">
                            <button @click="getAppointments()" type="button" class="btn"
                                :class="[!selectedStatus ? 'btn-secondary' : 'btn-default']">
                                <span class="mr-1">All</span>
                            </button>

                            <button v-for="status in appointmentStatus" @click="getAppointments(status.value)"
                                type="button" class="btn"
                                :class="[selectedStatus === status.value ? 'btn-secondary' : 'btn-default']">
                                <span class="mr-1">{{ status.name }}</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-between">
                            <input type="text" v-model="searchQuery" @input="debouncedGetAppointments"
                                placeholder="Search..." class="form-control" />
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div v-if="loading" class="text-center">Loading...</div>
                            <div v-else>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Client Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Tabungan</th>
                                            <th scope="col">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(appointment, index) in appointments.data" :key="appointment.id">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ appointment.client.first_name }} {{ appointment.client.last_name }}
                                            </td>
                                            <td>{{ appointment.client.email }}</td>
                                            <td>
                                                <span class="asasas">{{ appointment.status }}</span>
                                            </td>
                                            <td>
                                                <RouterLink
                                                    :to="{ name: 'editAppointment', params: { id: appointment.id } }">
                                                    <i class="fa fa-edit mr-2"></i>
                                                </RouterLink>

                                                <a href="#" @click.prevent="deleteData(appointment.id)">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Bootstrap4Pagination :data="appointments" @pagination-change-page="getPagination" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import { RouterLink, useRouter } from 'vue-router';
import Swal from 'sweetalert2';
import debounce from 'lodash/debounce';

const router = useRouter();
const selectedStatus = ref();
const appointmentStatus = ref([]);
const searchQuery = ref('');
const loading = ref(false);

const getAppointmentStatus = () => {
    axios.get('/api/appointments-status')
        .then((response) => {
            appointmentStatus.value = response.data;
        })
        .catch(error => {
            console.error(error);
        });
};

const appointments = ref({ data: [] });

const getAppointments = (status) => {
    loading.value = true;
    selectedStatus.value = status;
    const params = { status, search: searchQuery.value };

    axios.get('/api/appointments', { params })
        .then((response) => {
            appointments.value = response.data;
            loading.value = false;
        })
        .catch(error => {
            console.error(error);
            loading.value = false;
        });
};

const getPagination = (page = 1) => {
    loading.value = true;
    const params = { page, status: selectedStatus.value, search: searchQuery.value };

    axios.get('/api/appointments', { params })
        .then((response) => {
            appointments.value = response.data;
            loading.value = false;
        })
        .catch(error => {
            console.error(error);
            loading.value = false;
        });
};

const deleteData = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/appointments/${id}`)
                .then((response) => {
                    appointments.value.data = appointments.value.data.filter(appointment => appointment.id !== id);
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                });
        }
    });
};

const debouncedGetAppointments = debounce(getAppointments, 300);

onMounted(() => {
    getAppointments();
    getAppointmentStatus();
});
</script>
