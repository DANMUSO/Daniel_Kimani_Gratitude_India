<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card direct-chat direct-chat-primary">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">List of Questions</h3>

                <div class="card-tools">
                 <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" @click="newModal">
                Add Questions
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" v-show="!editmode" id="exampleModalLongTitle">Add Question</h5>
                            <h5 class="modal-title" v-show="editmode" id="exampleModalLongTitle">Update Question details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                     <form @submit.prevent="editmode ? updateQuestion() : addQuestion() ">
                
                         <br>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputEmail4">Question</label>
                        <textarea class="form-control" name="question" v-model="form.question">
                        </textarea>
                        <div v-if="form.errors.has('question')" style="color:red;" v-html="form.errors.get('question')" />
                        </div>
                        <div class="form-group col-md-12">
                        <label for="">Question Category</label>
                        <select class="form-control" name="category" v-model="form.category" placeholder="Question Category">
                        <option value="Technical">Technical</option>
                        <option value="Aptitude">Aptitude</option>
                        <option value="Logical">Logical</option>
                        </select>
                        <div v-if="form.errors.has('category')" style="color:red;" v-html="form.errors.get('category')" />
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Option One</label>
                        <input type="text" class="form-control" name="option1" v-model="form.option1" placeholder="Option One">
                        <div v-if="form.errors.has('category')" style="color:red;" v-html="form.errors.get('category')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Option Two</label>
                        <input type="text" class="form-control" name="option2" v-model="form.option2" placeholder="Option Two">
                        <div v-if="form.errors.has('option2')" style="color:red;" v-html="form.errors.get('option2')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Option Three</label>
                        <input type="text" class="form-control" name="option3" v-model="form.option3" placeholder="Option Three">
                        <div v-if="form.errors.has('option3')" style="color:red;" v-html="form.errors.get('option3')" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Option Four</label>
                        <input type="text" class="form-control" name="option4" v-model="form.option4" placeholder="Option Four">
                        <div v-if="form.errors.has('option4')" style="color:red;" v-html="form.errors.get('option4')" />
                    </div>
                    </div>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Add Question</button>
                    </form>
                    </div>
                    </div>
                </div>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                 <tr role="row">
                  <th>Id</th>
                  <th>Question</th>
                  <th>Question Category</th>
                  <th>Option One</th>
                  <th>Option Two</th>
                  <th>Option Three</th>
                  <th>Option Four</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <tr v-for="question in questions" :key="question.id">
                    <td>{{ question.id}}</td>
                    <td>{{question.question}}</td>
                    <td>{{ question.category}}</td>
                    <td>{{ question.option1}}</td>
                    <td>{{ question.option2}}</td>
                    <td>{{ question.option3}}</td>
                    <td>{{ question.option4}}</td>
                    <td><button type="button" @click="EditModal(question)" class="btn btn-warning" aria-label="Left Align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </button> 
                    <br>
                    <br>
                    <button @click="deleteQuestion(question.id)" type="button" class="btn btn-danger" aria-label="Left Align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg></button></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                  <th>Id</th>
                  <th>Question</th>
                  <th>Question Category</th>
                  <th>Option One</th>
                  <th>Option Two</th>
                  <th>Option Three</th>
                  <th>Option Four</th>
                  <th>Action</th>
                  </tr>
                </tfoot>
              </table>
              </div>
               
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                questions: {},
                form: new Form({
                    id : '',
                    question : '',
                    category: '',
                    option1: '',
                    option2: '',
                    option3: '',
                    option4: ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            addQuestion() {
                this.$Progress.start();
                this.form.post('api/question').then(() =>{
                   toast.fire({
                    icon: 'success',
                    title: 'Added successfully'
                })
                }).catch(() => {
                    
                })
                this.$Progress.finish();
            },
            loadQuestions() {
                axios.get('api/question').then( ({ data}) => (this.questions = data.data))
            },
            EditModal(question) {
            this.editmode = true;
            $('#addNew').modal('show');
            this.form.fill(question);
            },
            newModal() {
                this.editmode = false;
                $('#addNew').modal('show');
            },
            updateQuestion() {
                this.$Progress.start();
                this.form.put('api/question/'+this.form.id).then(() => {
                     toast.fire({
                    icon: 'success',
                    title: 'Updated successfully'
                })
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            deleteQuestion(id){
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                   
                if (result.isConfirmed) {
                    this.form.delete('api/question/'+id);
                    swal.fire(
                    'Deleted!',
                    'Product has been deleted.',
                    'success'
                    )
                }
                })
            }

        },
        created() {
            this.loadQuestions();
            setInterval(() => this.loadQuestions(), 4000);
        }
    }
</script>
