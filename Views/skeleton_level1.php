<div id="app">
    {{ message }}
    {{ datenow }}
    {{ example }}
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
