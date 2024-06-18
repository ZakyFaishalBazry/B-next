<!-- <template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>General Report</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="status-cards">
                <div v-for="status in statuses" :key="status.name" class="card">
                    <h2>{{ status.name }}</h2>
                    <p>{{ status.count }}</p>
                </div>
            </div>
        </div>
    </div>

</template> -->

<!-- <template>
    
    <div>
        <h1>Dashboard</h1>
        <div class="status-cards">
            <div v-for="status in statuses" :key="status.name" class="card">
                <h2>{{ status.name }}</h2>
                <p>{{ status.count }}</p>
            </div>
        </div>
    </div>
</template> -->

<!-- <script>
export default {
    data() {
        return {
            statuses: []
        };
    },
    mounted() {
        this.fetchStatusCounts();
    },
    methods: {
        async fetchStatusCounts() {
            try {
                const response = await axios.get('/api/appointments-status');
                this.statuses = response.data;
            } catch (error) {
                console.error('Error fetching status counts:', error);
            }
        }
    }
};
</script>

<style scoped>
.status-cards {
    display: flex;
    gap: 70px;
}

.card {
    background-color: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    width: 400px;
}

.card h2 {
    margin: 0;
    font-size: 24px;
}

.card p {
    margin: 10px 0 0;
    font-size: 18px;
    color: #333;
}
</style> -->


<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const totalAppointmentsCount = ref('all');
const wadiyahCount = ref(0);
const mudharabahCount = ref(0);
const valasCount = ref(0);

const getAppointmentsCount = () => {
    axios.get('/api/stats/appointments')
        .then((response) => {
            wadiyahCount.value = response.data.wadiyahCount;
            mudharabahCount.value = response.data.mudharabahCount;
            valasCount.value = response.data.valasCount;
        });
};

onMounted(() => {
    getAppointmentsCount();
});


</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">General Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ }}</h3>
                            <p>Wadiyah Nasabah</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-th"></i>
                        </div>
                        <router-link to="/CRUD" class="small-box-footer">
                            View Nasabah Wadiyah
                        </router-link>
                    </div>
                </div> -->
                <!-- Wadiyah Card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ wadiyahCount }}</h3>
                            <p>Total Wadiyah Nasabah</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-solid fa-chart-line"></i>
                        </div>
                        <router-link to="/CRUD" class="small-box-footer">
                            View Nasabah Wadiyah
                        </router-link>
                    </div>
                </div>
                <!-- Mudharabah Card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ mudharabahCount }}</h3>
                            <p> Total Mudharabah Nasabah</p>
                        </div>
                        <div class="icon">
                            <i class=" nav-icon fas fa-regular fa-chart-pie"></i>
                        </div>
                        <router-link to="/CRUD" class="small-box-footer">
                            View Nasabah Mudharabah
                        </router-link>
                    </div>
                </div>
                <!-- Valas Card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ valasCount }}</h3>
                            <p> Total Valas Nasabah</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-regular fa-credit-card"></i>
                        </div>
                        <router-link to="/CRUD" class="small-box-footer">
                            View Nasabah Valas
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
/* Add any custom styles here */
</style>
