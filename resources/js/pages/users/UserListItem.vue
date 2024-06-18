<script setup>
import moment from 'moment';
import { ref } from 'vue';
import { useToastr } from '../../toastr';
import { boolean } from 'yup';


const props = defineProps({
    user: Object,
    index: Number,
    selectAll: Boolean,
});
const toastr = useToastr();

// const userIdBeingDeleted = ref(null);

const emit = defineEmits(['userDeleted', 'editUser', 'confirmUserDeletion']);

// const confirmUserDeletion = (user) => {
//     userIdBeingDeleted.value = user.id;
//     $('#deleteUserModal').modal('show');
// };

// const deleteUser = () => {
//     axios.delete('/api/users/' + userIdBeingDeleted.value)
//         .then(() => {
//             $('#deleteUserModal').modal('hide');
//             toastr.success('User Delete');
//             emit('userDeleted', userIdBeingDeleted.value);
//         });
// };

// const deleteUser = () => {
//     axios.delete(`/api/users/${userIdBeingDeleted.value}`)
//         .then(() => {
//             $('#deleteUserModal').modal('hide');
//             toastr.success('User deleted successfully!');
//             users.value.data = users.value.data.filter(user => user.id !== userIdBeingDeleted.value);
//         });
// };

const toggleSelection = () => {
    emit('toggleSelection', props.user);
}

// const editUser = (user) => {
//     emit('editUser', user);
// };



</script>

<template>
    <tr>
        <th><input type="checkbox" :checked="selectAll" @change="toggleSelection" /></th>
        <td>{{ index + 1 }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ moment(user.created_at).format('DD-MM-YYYY') }}</td>
        <td>-</td>
        <td> <a href="#" @click.prevent="emit('editUser', user)" style="color: #565656;"><i
                    class="fas fa-edit"></i><span>Edit</span></a>
            <a href="#" @click.prevent="emit('confirmUserDeletion', user.id)" style="color: red;"><i
                    class="fas fa-trash text-danger ml-3"></i><span class="ml-2">Delete</span></a>
        </td>
    </tr>
</template>