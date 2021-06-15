<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card direct-chat direct-chat-primary">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">List of Developers</h3>

                <div class="card-tools">
                 <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Add Developers
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="color:#fff;">Add developer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                     <form @submit.prevent="addDeveloper">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Developer Name</label>
                        <input type="text" class="form-control" name="name" v-model="form.name" placeholder="Developer Name">
                        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Dev Type</label>
                        <input type="text" class="form-control" name="dev-type" v-model="form.devtype" placeholder="Dev Type">
                       <div v-if="form.errors.has('devtype')" v-html="form.errors.get('devtype')" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" v-model="form.email" placeholder="Email">
                        <div v-if="form.errors.has('email')" style="color:red;" v-html="form.errors.get('email')" />
                    </div>
                    <div class="form-group">
                        <label for="">Mobile</label>
                        <input type="tel" class="form-control" name="phone" v-model="form.phone" placeholder="Mobile phone">
                        <div v-if="form.errors.has('phone')" style="color:red;" v-html="form.errors.get('phone')" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputCity">Image</label>
                        <input type="file" @change="devImage" class="form-control" name="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
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
                  <th>Profile</th>
                  <th>Dev Name</th>
                  <th>Dev Phone No</th>
                  <th>Dev Email</th>
                  <th>Dev Type</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <tr v-for="developer in developers" :key="developer.id">
                    <td>{{ developer.id}}</td>
                    <td><img v-bind:src="'/img/product/'+developer.image" width="25%"/></td>
                    <td>{{ developer.name}}</td>
                    <td>{{ developer.phone}}</td>
                    <td>{{ developer.email}}</td>
                    <td>{{ developer.devtype}}</td>
                    <td><button type="button" class="btn btn-default" aria-label="Left Align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </button> 
                    <br>
                    <br>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg></button></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                   <th>Id</th>
                  <th>Profile</th>
                  <th>Dev Name</th>
                  <th>Dev Phone No</th>
                  <th>Dev Email</th>
                  <th>Dev Type</th>
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
                developers: {},
                form: new Form({
                    id : '',
                    name : '',
                    devtype: '',
                    phone: '',
                    email: '',
                    image: ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            addDeveloper() {
                console.log('Developer');
                this.form.post('api/developer');
            },
            loadDevelopers() {
                axios.get('api/developer').then( ({ data}) => (this.developers = data.data))
            },
            devImage(e) {
                //console.log('Uploading');
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                reader.onloadend = (file) =>  {
                    this.form.photo= reader.result;
                    console.log('RESULT', reader.result)
                }
                reader.readAsDataURL(file);
            }

        },
        created() {
            this.loadDevelopers();
            setInterval(() => this.loadDevelopers(), 4000);
        }
    }
</script>
