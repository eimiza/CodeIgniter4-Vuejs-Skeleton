<div id="app">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Example Data</h3>

                    <div class="card-tools">
                        
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Data</th>
                            <th width="100px" class="text-right">
                                <button class="btn btn-sm btn-default" @click="show_filter = true" v-show="!show_filter">
                                    <i class="fas fa-filter"></i> Show Filter
                                </button>
                                <button class="btn btn-sm btn-default" @click="show_filter = false" v-show="show_filter">
                                    <i class="fas fa-filter"></i> Hide Filter
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-show="show_filter">
                            <td></td>
                            <td>
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" v-model="search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default" @click="get_data(1)">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr v-for="(c, index) in contents">
                            <td>{{((page-1)*per_page)+index+1}}</td>
                            <td>{{c}}</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                    <a @click="show_edit(c.id)" href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <a @click="delete_data(c.id)" href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            <!-- /.card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="pagination">
                                <li class="page-item" :class="{ active: index == page }" v-for="index in total_page" :key="index">
                                    <a @click="get_data(index)" class="page-link" href="#">{{index}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 text-right">
                            Showing page {{page}} of {{total_page}} ({{total_data}} total results)
                        </div>
                    </div>
                
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script type="module">
  import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

  createApp({
    data() {
      return {
        message: 'Hello Vue!',
        datenow: '',
        show_filter: false,

        //employee data
        contents: [],
        search: '',
        page: 1,
        total_page: 1,
        per_page: 0,
        total_data: 0,
      }
    },
    methods: {
        show_date(){
            this.datenow = moment().format();
        },
        get_data(page = 1){
            this.page = page;
            var self = this;
            $.post('/api/employee', {
                page: self.page,
                search: self.search
            }, function(res){
                self.contents = res.data;
                self.total_page = res.total_page;
                self.per_page = res.per_page;
                self.total_data = res.total_data;
                console.log(res);
            })
        },
        show_edit(id){
            $('#edit').modal('show');
        },
        delete_data(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        },
    },
    mounted(){
        this.show_date();
        this.get_data();
    },
  }).mount('#app')
</script>
