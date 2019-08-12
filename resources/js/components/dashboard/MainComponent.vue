<template>
    <div>
    <div class="col-md-3">
      <div class="x_panel">
        <div class="x_title">
          <h2>Load Average</h2>
        </div>
        <div class="x_content">
          <div class="graph_grid">
            <div class="graph_grid__top">
              <div class="graph_grid__top__left">
                <span class="text--heightlight">hello world</span>/10
              </div>
            </div>
            <div class="graph_grid__body">
                <!-- Children Component will pass data here -->
               <!-- <apexchart type=radialBar height=200 :options="chartOptions" :series="series"/> -->
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
import Vue from 'vue'
import CpuComponent from './CpuComponent'

Vue.extend ({
  template : CpuComponent
});

</script>       

<style scoped>
</style>