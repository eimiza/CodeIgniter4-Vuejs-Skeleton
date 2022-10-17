<div id="app">
    {{ message }}
    {{ datenow }}
    {{ example }}
</div>

<script type="module">
  import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

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

        },
    },
    mounted(){
        this.show_date();

    },
  }).mount('#app')
</script>
