<template>
  <div class="row">
    <div v-for="(item, attribute) in additional_attributes" class="col-md-12">
      <div v-if="attribute !== 'date'">
          <single-chart :status="item" :attributes="attribute" :created-at="additional_attributes['date']"></single-chart>
      </div>

    </div>
  </div>
</template>

<script>
import SingleChart from './SingleChart.vue'
export default {
  name: "TrendChart",
  props: ["additional_attributes"],
  components:{
    SingleChart,
  }
};
</script>

<style>
</style>
