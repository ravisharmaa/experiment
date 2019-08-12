<template>
    <highcharts :options="chartOptions"></highcharts>
</template>

<script>
    import Highcharts from 'highcharts'
    export default {
        name: "TestComponent",
        props: ['cpuLoad'],
        data () {
          return {
              chartOptions : {
                  chart: {
                      type: 'areaspline',
                      zoomType:'x'
                  },
                  xAxis: {
                      type: 'datetime',
                      dateTimeLabelFormats: {
                          day: '%e of %b'
                      },

                      title: {
                          text: 'Cpu Load'
                      }
                  },
                  yAxis: {
                      title: {
                          text: 'Load Points'
                      },
                      min:0,
                      max:4
                  },
                  legend: {
                      enabled: true
                  },
                  plotOptions: {
                      area: {
                          fillColor: {
                              linearGradient: {
                                  x1: 0,
                                  y1: 0,
                                  x2: 0,
                                  y2: 1
                              },
                              stops: [
                                  [0, Highcharts.getOptions().colors[0]],
                                  [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                              ]
                          },
                          marker: {
                              radius: 2
                          },
                          lineWidth: 1,
                          states: {
                              hover: {
                                  lineWidth: 1
                              }
                          },
                          threshold: null
                      }
                  },
                  series: [{
                      name:"Cpu Load",
                      data: this.cpuLoad,
                      pointStart:this.cpuLoad[0][0]
                  }]
              },
          }
        },
    }
</script>

<style scoped>

</style>