<template>
    <div>
        <div class="form-group">
            <label>Customer</label>

            <select class="form-control" name="customer_id" v-model="formData.customer_id" required>
                <option value="">Please Select</option>
                <option v-for="customer in customers" :value="customer.id">{{customer.name}}</option>
            </select>
            <p v-if="errors.customer_id">{{errors.customer_id[0]}}</p>
        </div>

        <div class="form-group">
            <label>Hostname</label>
            <!--<form-error v-if="errors.host"-->
            <input type="text" name="hostname" v-model="formData.hostname" class="form-control"
                   placeholder="Enter hostname">
            <p v-if="errors.hostname">{{errors.hostname[0]}}</p>
        </div>

        <div class="form-group">
            <label>Ip Address</label>
            <input type="text" name="ipaddress" v-model="formData.ipaddress" class="form-control"
                   placeholder="Enter Ipaddress">
            <p v-if="errors.ipaddress">{{errors.ipaddress[0]}}</p>
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
        customers: [],
        formData: {
          customer_id: '',
          hostname: '',
          ipaddress: ''
        },
        errors: [],
      }
    },

    methods: {
      submitForm () {
        return axios.post('servers', this.formData).then(response => {
          this.formData = ''
          window.location.reload();
        }).catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors
          }
        })
      }
    },

    mounted () {
      axios.get('servers/create').then(response => {
        this.customers = response.data
      })
    }
  }
</script>

<style scoped>

</style>
