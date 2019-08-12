<template>
    <div>
        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="name" v-model="formData.name" class="form-control"
                   placeholder="Enter Company Name">
            <p v-if="errors.name">{{errors.name[0]}}</p>
        </div>

        <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" v-model="formData.contact_person" class="form-control"
                   placeholder="Enter Contact Person">
            <p v-if="errors.contact_person">{{errors.contact_person[0]}}</p>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" v-model="formData.email" class="form-control"
                   placeholder="Enter Email">
            <p v-if="errors.email">{{errors.email[0]}}</p>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" v-model="formData.phone" class="form-control"
                   placeholder="Enter Email">
            <!--<p v-if="errors.phone">{{errors.phone[0]}}</p>-->
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" v-model="formData.address" class="form-control"
                   placeholder="Enter Address">
            <!--<p v-if="errors.address">{{errors.address[0]}}</p>-->
        </div>

        <div class="form-group">
            <label>Remarks</label>
            <input type="text" name="remarks" v-model="formData.remarks" class="form-control"
                   placeholder="Enter Address">
            <!--<p v-if="errors.remarks">{{errors.remarks[0]}}</p>-->
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
          name: '',
          contact_person: '',
          email: '',
          phone: '',
          address: '',
          remarks: ''
        },
        errors: [],
      }
    },

    methods: {
      submitForm () {
        return axios.post('customers', this.formData).then(response => {
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