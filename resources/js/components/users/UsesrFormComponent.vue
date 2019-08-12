<template>
    <div>
        <div class="form-group">
            <label>Company Name</label>
            <select class="form-control" name="username" v-model="formData.username"
                    @change="fillUserName(formData.username)" required>
                <option value="">Please Select Customer Name</option>
                <option v-for="customer in customers" :value="customer.slug">{{customer.name}}</option>
            </select>
            <p v-if="errors.username">{{errors.username[0]}}</p>
        </div>

        <div class="form-group">
            <label>User Role</label>
            <select class="form-control" name="role" v-model="formData.role" required>
                <option value="">Please Select</option>
                <option value="admin">Admin</option>
                <option value="guest">Guest</option>
            </select>
            <p v-if="errors.role">{{errors.role[0]}}</p>
        </div>
        <div class="form-group">
            <input type="text" name="username" v-model="formData.name" class="form-control"
                   placeholder="Enter username" disabled>
            <p v-if="errors.name">{{errors.name[0]}}</p>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" v-model="formData.email" class="form-control"
                   placeholder="Enter Email">
            <p v-if="errors.email">{{errors.email[0]}}</p>
        </div>

        <div class="form-group">
            <label>Time Zone</label>
            <select class="form-control" name="timezone" v-model="formData.timezone" required>
                <option disabled value="">Please select one</option>
                <option v-for="timezone in timezones" :value="timezone.name">{{timezone.name}}</option>
            </select>
            <p v-if="errors.timezone">{{errors.timezone[0]}}</p>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" v-model="formData.password" class="form-control" name="password">
            <p v-if="errors.password">{{errors.password[0]}}</p>
        </div>
        <div class="form-group">
            <label>Password Confirmation</label>
            <input type="password" v-model="formData.password_confirmation" class="form-control" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary" @click.prevent="submitForm">Submit</button>
    </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'FormComponent',
    data () {
      // console.log(customers);
      return {
        customers: [],
        timezones:[
          {name:'Asia/Kathmandu'},
          {name:'Europe/Amsterdam'}
        ],
        formData: {
          username: '',
          role: '',
          name: '',
          email: '',
          password: '',
          password_confirmation:'',
          timezone:''
        },
        errors: [],
      }
    },

    methods: {
      fillUserName (companyName) {
        return this.formData.name = companyName
      },

      submitForm () {
        return axios.post('users', this.formData).then(response => {
          this.formData = '';
          window.location.reload();

        }).catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.formData.password = '';
            this.formData.password_confirmation = '';
          }
        })
      }
    },

    mounted () {
      axios.get('users/create').then(response => {
        this.customers = response.data
      })
    }
  }
</script>

<style scoped>

</style>