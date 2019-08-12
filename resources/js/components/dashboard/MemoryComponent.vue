<template>
  <div class="col-md-3">
    <div class="x_panel">
      <div class="x_title">
        <h2>Memory Consumption</h2>
      </div>
      <div class="x_content">
        <div class="graph_grid">
          <div class="graph_grid__body">
            <div class="graphPlot">
              <div class="graphPlot__iner">
                <apexchart type="pie" height="190" :options="chartOptions" :series="series"/>
              </div>
            </div>
          </div>
          <div class="graph_grid__foot">
            <div class="graph_grid__foot__left">
              <span class="symbolAlerts symbolAlerts--warning"></span>
              Warning Threshold :
              {{pivotValues.warning_threshold}}%
            </div>
            <div class="graph_grid__foot__right">
              <span class="symbolAlerts symbolAlerts--danger"></span>
              Critical Threshold :
              {{pivotValues.critical_threshold}}%
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";

export default {
  name: "MemoryComponent",
  props: ["freeMemory", "usedMemory", "attribute"],
  components: {
    apexchart: VueApexCharts
  },

  data() {
    return {
      pivotValues: JSON.parse(this.attribute),
      series: [parseFloat(this.freeMemory), parseFloat(this.usedMemory)],
      chartOptions: {
        labels: ["Free Memory", "Used Memory"],
        responsive: [
          {
            breakpoint: 320,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: "bottom"
              }
            }
          }
        ],
        pie: {
          expandOnClick: false
        },
        colors: ["#b1b1b1", "#4290e2"],
        tooltip: {
          enabled: false,
          formatter: function(val) {
            console.log(val);
            return val;
          }
        }
      }
    };
  },

  mounted() {
    //console.log(typeof this.freeMemory);
    //console.log('hello');
    //console.log(parseFloat(this.freeMemory));
    //console.log(this.usedMemory);
  }
};
</script>

<style scoped>
</style>