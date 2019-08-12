<template>
  <div>
    <div class="col-md-3">
      <div class="x_panel">
        <div class="x_title">
          <h2>Disk</h2>
        </div>
        <div class="x_content">
          <div class="graph_grid">
            <div class="graph_grid__top">
              <div class="graph_grid__top__left">
                <span
                  class="text--heightlight"
                >{{parseFloat(Object.values(JSON.parse(this.disk_used)))}}</span>/10
              </div>
            </div>
            <div class="graph_grid__body">Disk will come here
              
            </div>
            <div class="graph_grid__foot">
              <div class="graph_grid__foot__left">
                <span class="circle--active"></span>
                <span>Hello world</span>
              </div>
              <div class="graph_grid__foot__right">
                <span class="circle--inactive"></span>
                <span>hello world</span>
              </div>
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
  name: "DiskComponent",
  props: ["disk_used", "disk_total"],
  components: {
    apexchart: VueApexCharts
  },

  data() {
    return {
      pivotValues: '',
    };
  },
  mounted() {
    //console.log(JSON.parse(this.attribute));
    console.log(parseFloat(Object.values(JSON.parse(this.disk_used))));
    // console.log(Object.keys(JSON.parse(this.disk_total)));
  }
};
</script>       

<style scoped>
</style>