<div id="app">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Example Data</h3>

                    <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" v-model="search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default" @click="get_data(1)">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Data</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(c, index) in contents">
                            <td>{{index+1}}</td>
                            <td>{{c}}</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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

</div>

<script type="module">
  import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'
  import moment from '<?php echo base_url() ?>/node_modules/moment/dist/moment.js'

  createApp({
    data() {
      return {
        message: 'Hello Vue!',
        datenow: '',

        //employee data
        contents: [],
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
    },
    mounted(){
        this.show_date();
        this.get_data();
    },
  }).mount('#app')
</script>
