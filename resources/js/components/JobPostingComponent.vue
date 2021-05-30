<template>
    <div>
        <h1>Job Posting List</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Job Description</th>
                    <th>Vacants</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in postingList" :key="item.id">
                    <td>{{item.job_name}}</td>
                    <td>{{item.job_description}}</td>
                    <td>{{item.vacants}}</td>
                    <td>
                        <button class="btn btn-secondary" @click="edit(item,index)"><i class="fa fa-edit"></i>Edit</button>
                        <button class="btn btn-danger" @click="remove(item,index)"><i class="fa fa-trash"></i>Delete</button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input Job name" v-model="form.job_name">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input Job Description" v-model="form.job_description">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Input Job Vacant" v-model="form.vacants">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <button class="btn btn-primary" @click="submit"><i class="fa fa-plus"></i>Add</button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Job Name</label>
                            <input type="text" class="form-control" placeholder="Input Job name" v-model="formEdit.job_name">
                    </div>
                    <div class="form-group">
                        <label for="">Job Description</label>
                            <input type="text" class="form-control" placeholder="Input Job Description" v-model="formEdit.job_description">
                    </div>
                    <div class="form-group">
                        <label for="">Vacants</label>
                            <input type="number" class="form-control" placeholder="Input Job Vacant" v-model="formEdit.vacants">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="update()">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            postingList: this.data,
            form: {
                job_name: null,
                job_description: null,
                vacants: 0
            }, 
            formEdit: {
                job_name: null,
                job_description: null,
                vacants: 0
            },
            selectedId: null
        }
    },
    methods: {
        submit() {
            const vm = this;
            axios.post(`/job_postings`,  this.form) 
            .then(function (response) {
                vm.postingList.push(response.data.data)
                vm.form.job_name = null,
                vm.form.job_description = null,
                vm.form.vacants = 0
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        remove(item,index) {
            const vm = this;
            axios.delete(`/job_postings/${item.id}`) 
            .then(function (response) {
                vm.postingList.splice(index, 1)
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        edit(item,index) {
            const vm = this;
            $('#modal_edit').modal('show');
            axios.get(`/job_postings/${item.id}`) 
            .then(function (response) {
                let result = response.data.data;
                console.log(result)
                vm.formEdit.job_name = result.job_name;
                vm.formEdit.job_description = result.job_description;
                vm.formEdit.vacants = result.vacants;
                vm.selectedId = result.id;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        update() {
            const vm = this;
            axios.put(`/job_postings/${vm.selectedId}`,  this.formEdit) 
            .then(function (response) {
                vm.postingList.push(response.data.data)
                vm.formEdit.job_name = null,
                vm.formEdit.job_description = null,
                vm.formEdit.vacants = 0
            })
            .catch(function (error) {
                console.log(error);
            });
        },
    }
    
}
</script>
