<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row card-header justify-content-center">
                   <div class="col-md-10">
                    <div >Product Component</div>
                    </div>
                    <div class="col-md-2">
                    <button type="button" class="btn btn-success" @click="newModal">
                    Add Product 
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode" id="exampleModalLongTitle">Add product</h5>
                            <h5 class="modal-title" v-show="editmode" id="exampleModalLongTitle">Update product's details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         <form @submit.prevent="editmode ? updateProduct() : addProduct()">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Vendor Name</label>
                            <input type="text" name="vendorName" v-model="form.vendorName" class="form-control" placeholder="Vendor Name">
                            <div v-if="form.errors.has('vendorName')" v-html="form.errors.get('vendorName')" style="color:red;"/>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Vendor Email</label>
                            <input type="text" name="vendorEmail" v-model="form.vendorEmail" class="form-control" placeholder="Vendor Email">
                           <div v-if="form.errors.has('vendorEmail')" v-html="form.errors.get('vendorEmail')" style="color:red;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Vendor Phone</label>
                            <input type="text" name="vendorPhone" v-model="form.vendorPhone" class="form-control" placeholder="Vendor Phone">
                            <div v-if="form.errors.has('vendorPhone')" v-html="form.errors.get('vendorPhone')" style="color:red;"/>
                         </div>
                        <div class="form-group">
                            <label for="inputAddress2">Product Name</label>
                            <input type="text" name="productName" v-model="form.productName" class="form-control" placeholder="Product Name">
                            <div v-if="form.errors.has('productName')" v-html="form.errors.get('productName')" style="color:red;"/>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputCity">Product Type</label>
                            <input type="text" name="type" v-model="form.type" class="form-control" placeholder="Product Type">
                            <div v-if="form.errors.has('type')" v-html="form.errors.get('type')" style="color:red;"/>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputState">Product Description</label>
                            <input type="text" name="desc" v-model="form.desc" class="form-control" placeholder="Product Description">
                            <div v-if="form.errors.has('desc')" v-html="form.errors.get('desc')" style="color:red;"/>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="inputZip">Product Image</label>
                            <input type="file" @change="ProductImage" name="image" class="form-control" id="inputZip">
                            <div v-if="form.errors.has('image')" v-html="form.errors.get('image')" style="color:red;"/>
                            </div>
                        </div>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="card-body">
              <div id="example1_wrapper" 
              class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
              <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="example1_length">
              <label>Show <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  </select> entries</label></div></div>
                  <div class="col-sm-12 col-md-6">
                  <div id="example1_filter" class="dataTables_filter">
                  <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
                  </div></div></div><div class="row"><div class="col-sm-12">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                 <tr role="row">
                  <th>Id</th>
                  <th>Photo</th>
                  <th>Vendor Name</th>
                  <th>Vendor Email</th>
                  <th>Vendor Phone No</th>
                  <th>Product Name &<br> Image</th>
                  <th>Product Type</th>
                  <th>Product Desc</th>
                  <th>Date</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <tr class="odd" v-for="product in products" :key="product.id">
                    <td>{{product.id}}</td>
                    <td><img v-bind:src="'/img/product/'+product.image" width="100%"/></td>
                    <td>{{product.vendorName}}</td>
                    <td>{{product.vendorPhone}}</td>
                    <td>{{product.vendorEmail}}</td>
                    <td>{{product.productName}} <br>{{product.image}}</td>
                    <td>{{product.type}}</td>
                    <td>{{product.desc}}</td>
                    <td>{{product.created_at |myDate}}</td>
                    <td><button type="button" @click="EditModal(product)" class="btn btn-warning" aria-label="Left Align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </button> 
                    <br>
                    <br>
                    <button @click="deleteProduct(product.id)" type="button" class="btn btn-danger" aria-label="Left Align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg></button></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                  <th>Id</th>
                  <th>Photo</th>
                  <th>Vendor Name</th>
                  <th>Vendor Email</th>
                  <th>Vendor Phone No</th>
                  <th>Product Name  &<br>Image</th>
                  <th>Product Type</th>
                  <th>Product Desc</th>
                  <th>Action</th>
                  </tr>
                </tfoot>
              </table>
              </div></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
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
                products: {},
                form: new Form({
                    id : '',
                    vendorName: '',
                    vendorEmail: '',
                    vendorPhone: '',
                    productName: '',
                    type: '',
                    desc: '',
                    image: ''
                })
            }
        },
        methods: {
            updateProduct() {
                this.$Progress.start();
                this.form.put('api/product/'+this.form.id).then(() => {
                     toast.fire({
                    icon: 'success',
                    title: 'Updated successfully'
                })
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            EditModal(product) {
            this.editmode = true;
            $('#addNew').modal('show');
            this.form.fill(product);
            },
            newModal() {
                this.editmode = false;
                $('#addNew').modal('show');
            },
            loadProducts(){
                axios.get("api/product").then(({ data }) => (this.products = data.data))
            },
            addProduct() {
                this.$Progress.start();
                this.form.post('api/product').then(() =>{
                   toast.fire({
                    icon: 'success',
                    title: 'Added successfully'
                })
                }).catch(() => {
                    
                })
                this.$Progress.finish();
                
            },
            ProductImage(e){
                //console.log('Uploading');
                let file = e.target.files[0];
                //console.log(file); 
                let reader = new FileReader();
                reader.onloadend = (file) =>  {
                    this.form.photo= reader.result;
                    //console.log('RESULT', reader.result)
                }
                
                 reader.readAsDataURL(file);
            },
            deleteProduct(id)
            {
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
                    this.form.delete('api/product/'+id);
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
            this.loadProducts();
            setInterval(() => this.loadProducts(), 4000);
        }
    }
</script>
