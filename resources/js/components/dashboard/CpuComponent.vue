<template>
    <div class="col-md-3">
      <div class="x_panel">
        <div class="x_title">
          <h2>Cpu Load</h2>
        </div>
        <div class="x_content">
          <div class="graph_grid">
            <div class="graph_grid__body">
              <div class="graphPlot">
                 <div class="graphPlot__iner">
                   <apexchart type=radialBar height=300 :options="chartOptions" :series="series"/>
                 </div>
              </div>
            </div>
            <div class="graph_grid__foot">
              <div class="graph_grid__foot__left">
                <span class="symbolAlerts symbolAlerts--warning"> </span>Warning Threshold : {{pivotValues.warning_threshold}}%
              </div>
              <div class="graph_grid__foot__right">
                 <span class="symbolAlerts symbolAlerts--danger"></span>Critical Threshold : {{pivotValues.critical_threshold}}%
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
  name: "PieComponent",
  props: ["loadaverage",'attribute'],
  components: {
    apexchart: VueApexCharts
  },

  data() {
    return {
        pivotValues: JSON.parse(this.attribute),
        series: [parseFloat(this.loadaverage)],
        chartOptions: {
          plotOptions: {
            radialBar: {
              hollow: {
                margin:0,
                size: '20%',
                opacity:1,
                background: 'transparent',
              },
              track:{
                show: true,
                background: '#b1b1b1',
                opacity:1,
                dropShadow: {
                  opacity: 1
                }
              }

            },
          },
          labels: [''],
          colors:['#4290e2'],

        }
    };
  },
  mounted() {

  }
};
</script>

<style scoped>
</style>