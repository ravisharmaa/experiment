<template>
    <div>
        <div class="form-group">
            <label>Server Name</label>
            <input type="text" name="server_name" v-model="formData.server_name" class="form-control"
                   placeholder="Enter Server Name">
            <p v-if="errors.server_name">{{errors.server_name[0]}}</p>
        </div>

        <button type="submit" class="btn btn-primary" @click.prevent="submitForm">Submit</button>
    </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'FormComponent',
    data () {
      return {
        // customers: [],
        formData: {
          server_name: ''
        },
        errors: [],
      }
    },

    methods: {
      submitForm () {
        return axios.post('servicetypes', this.formData).then(response => {
          this.formData = ''
          window.location.reload()
        }).catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors
          }
        })
      }
    },

    mounted () {
      // axios.get('customers/create').then(response => {
      //   this.customers = response.data
      // })
    }
  }
</script>

<style scoped>

</style>
