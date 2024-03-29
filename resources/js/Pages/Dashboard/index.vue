<template>
    <AppLayout>
        <template #content>
            <div class="container">
      
                <h1 class="text-center text-success display-1 font-monospace fw-bolder p-3"  >
                    Student CRUD Application
                </h1>
                
                <!-- @if($status == 0)v-if="status == 0" -->
                <div class="buttonalign d-flex justify-content-center m-2" >
                    <Link type="button" href="javascript:void(0)" class="btn btn-outline-primary btn-lg m-3" data-bs-toggle ="modal" data-bs-target="#addStudent">Add Student</Link>
                </div>
                
                <!-- @endif -->
                <div class="row" >
                    <div class="d-flex justify-content-center"  >
                        <!-- @if($status == 0) -->
                        
                            <table class="table table-striped  text-center" >
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-content-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- @foreach ($students as $key => $student) -->
                                    <tr v-for="(student,key) in student_list" >
                                        {{student.images}}
                                        <th scope="row">{{ ++key  }}</th>
                                        <td>{{ student.name}}</td>
                                        <td><img :src="getImageUrl(student.image)" alt="name" width="20px" height="20px"></td>
                                        <td>{{ student.age}}</td>
                                        <td >
                                            <!-- @if ($student->status == 0) -->
                                            <span class="badge bg-warning" v-if="student.status == 0">Inactive</span>
                                            <!-- @else -->
                                            <span class="badge bg-success" v-if="student.status == 1">Active</span>   
                                            <!-- @endif                     -->
                                        </td>
                                        <td>
                                            <Link type="button" @click.prevent="deleteStudent(student.id)" class="btn badge bg-danger" >Delete</Link>
                                            <Link type="button" @click.prevent="editStudent(student.id)" class="btn badge bg-info" data-bs-toggle ="modal" data-bs-target="#updateStudent">Edit</Link>
                                            <Link type="button" @click.prevent="updateStatus(student.id)" class="btn badge bg-success" >Change Status</Link>
                                        </td>
                                    </tr>
                                <!-- @endforeach -->
                                </tbody>
                            </table>
        
                      
                      </div>
                      </div>
                    
            </div>
                <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center ">
                                <h1 class="modal-title fs-5 fw-semibold " id="addStudentLabel">Please Fil the Details</h1>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="dataStore">
                                
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" v-model="data.name">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image" @change="onChange"  accept="iamge/png, image/jpg, image/jpeg">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Age</label>
                                    <input type="number" class="form-control" name="age" id="age" v-model="data.age">
                                </div>
                                <div class="form-footer d-flex justify-content-center ">
                                    <button type="submit" class="btn btn-primary m-3">Add Student</button>
                                    <button type="button" class="btn btn-secondary m-3" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="updateStudent" tabindex="-1" aria-labelledby="updateStudentLabel" aria-hidden="true" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center ">
                                <h1 class="modal-title fs-5 fw-semibold " id="updateStudentLabel">You Can Update Data</h1>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="updateStudent">
                                
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" v-model="update_data.name">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image" @change="onChange1"  accept="iamge/png, image/jpg, image/jpeg">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Age</label>
                                    <input type="number" class="form-control" name="age" id="age" v-model="update_data.age">
                                </div>
                                <div class="form-footer d-flex justify-content-center ">
                                    <button type="submit" class="btn btn-primary m-3">Update Student</button>
                                    <button type="button" class="btn btn-secondary m-3" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </template>
    </AppLayout>
</template>


<script >
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
//     import { useForm } from '@inertiajs/vue3'

// const data = useForm({
//   name: null,
//   avatar: null,
// })

    
    export default {
        components : {
            AppLayout,
            Link,
            ResponsiveNavLink
        },
        
        data() {
            return {
                data: {
                    name: '',
                    image:'',
                    age: ''

                },
                update_data: {
                    name: '',
                     image:'',
                    age: '',

                },
                student_list: []
            }
        },
        beforeMount() {
            this.getStudents()
        },
        methods: {
            getImageUrl(imageName) {
             return imageName ? `/storage/app/uploads/${imageName}` : ''; // Adjust the path as needed
            },
            onChange(e){
                this.data.image = e.target.files[0];
            },
            onChange1(e){
                this.update_data.image = e.target.files[0];
            },
            async getStudents(){
                const datas = (await axios.get(route('student.list'))).data
                this.student_list = datas
            },
            async dataStore(){
                const formData = new FormData();
                formData.append('name', this.data.name);
                formData.append('image', this.data.image);
                formData.append('age', this.data.age);

                await axios.post(route('student.store'), formData);

                this.data.name = '';
                this.data.image = '';
                this.data.age = '';
                //await axios.post(route('student.store'), this.data)
                this.getStudents();
            },
            async deleteStudent(id){
                await axios.delete(route('student.delete',id))
                this.getStudents();
            },
            async updateStatus(id){
                await axios.get(route('student.status',id))
                this.getStudents();
            },
            async updateStudent(){
                const formData1 = new FormData();
                formData1.append('name', this.update_data.name);
                formData1.append('image', this.update_data.image);
                formData1.append('age', this.update_data.age);

                await axios.post(route('student.update', this.update_data.id), formData1);

                this.update_data.name = '';
                this.update_data.image = '';
                this.update_data.age = '';
                this.getStudents();
                $('#updateStudent').modal('hide');
            },
            async editStudent(id){
                const data = (await axios.get(route('student.get',id))).data
                this.update_data = data
                console.log(this.update_data);
                $('#updateStudent').modal('show');
            },
            
        }
    }

    function goBack() {
        window.history.back();
    }
</script>

<style lang="scss" scoped>

</style>