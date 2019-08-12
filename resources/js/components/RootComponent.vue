<template>
  <div>
    <div class="content__topPanel">
      <div class="content__topPanel-left">
        <h2 class="content__topPanel-title">
          {{ dataSet.customers[0].name }}:
          <small>{{ dataSet.hostname }}</small>
        </h2>
      </div>
      <div class="content__topPanel-middle">
        <div class="periodSelect">
          <a class="btn" :class="{active: isHour}" href="?period=last_hour">Last Hour</a>
          <a class="btn" :class="{active: isToday}" href="?period=today">Today</a>
          <a class="btn" :class="{active: isWeek}" href="?period=week">Week</a>
          <a class="btn" :class="{active: isMonth}" href="?period=month">Month</a>
          <!--<a class="btn" :class="{active: isYear}" href="?period=year">Year</a>-->
        </div>
      </div>
      <div class="content__topPanel-right">
        <small class="headerIP">IP: {{dataSet.ipaddress}}</small>
      </div>
    </div>
    <div class="content__body container-fluid control-container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="cpPanel">
            <div class="cpPanel__left">
              <div class="systemUpTime">
                <h4>System Uptime:</h4>
                {{ dataSet.latest_value.systemuptime }}
              </div>
            </div>
            <div class="cpPanel__right">
              <div class="systemContactPerson">
                <h4>Contact Person:</h4>
                {{dataSet.customers[0].contact_person}}
              </div>
            </div>
          </div>
          <div class="dashboard_graph x_panel">
            <div class="row x_title x_flat_title">
              <div class="col-md-6">
                <h3>CPU Usages</h3>
              </div>
            </div>
            <div class="graphBlock">
              <cpu-chart :chartData="chartData" :routeLocation="routeLocation"></cpu-chart>
            </div>
          </div>
          <div class="dashboard_graph x_panel">
            <div class="row x_title x_flat_title">
              <div class="col-md-6">
                <h3>Memory Usages</h3>
              </div>
            </div>
            <mem-chart :chartData="chartData" :routeLocation="routeLocation"></mem-chart>
          </div>
        </div>
        <div class="col-md-12 graphBlock">
          <div class="dashboard_graph x_panel">
            <div class="row x_title x_flat_title">
              <div class="col-md-6">
                <h3>Services</h3>
              </div>
            </div>
            <trend-chart :additional_attributes="additional_info"></trend-chart>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CpuChart from "./cpuChart.vue";
import MemChart from "./memChart.vue";
import TrendChart from "./TrendChart.vue";
export default {
  name: "RootComponent",
  props: ["entity", "additional_info"],
  data() {
    return {
      dataSet: this.entity,
      server_attributes: [],
      selectPeriod: "last_hour",
      isHour: false,
      isToday: false,
      isWeek: false,
      isMonth: false,
      isYear: false,
      chartData: this.entity.latest_values,
      routeLocation: this.entity.urlParams
    };
  },
  components: {
    CpuChart,
    MemChart,
    TrendChart
  },
  watch: {},
  computed: {},

  methods: {},

  mounted() {
    if (this.dataSet.urlParams == "last_hour") {
      this.isHour = true;
    } else if (this.dataSet.urlParams == "today") {
      this.isToday = true;
    } else if (this.dataSet.urlParams == "week") {
      this.isWeek = true;
    } else if (this.dataSet.urlParams == "month") {
      this.isMonth = true;
    } else if (this.dataSet.urlParams == "year") {
      this.isYear = true;
    } else {
      this.isHour = true;
    }
  }
};
</script>