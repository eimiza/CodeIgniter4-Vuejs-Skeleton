<div id="app">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Example Data</h3>

                    <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
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
                        <tr v-for="(e, index) in example">
                            <td>{{index+1}}</td>
                            <td>{{e}}</td>
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
        example: [],
      }
    },
    methods: {
        show_date(){
            this.datenow = moment().format();
        },
        get_data(){
            var self = this;
            $.get('/api/department', function(res){
                self.example = res;
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
