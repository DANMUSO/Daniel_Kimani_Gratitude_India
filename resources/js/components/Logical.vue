<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card direct-chat direct-chat-primary">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">List of Logical Questions</h3>

                
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
            loadQuestions() {
                axios.get('api/logical').then( ({ data}) => (this.questions = data.data))
            }
        },
        created() {
            this.loadQuestions();
            setInterval(() => this.loadQuestions(), 4000);
        }
    }
</script>
