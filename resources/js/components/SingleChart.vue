<template>
    <div>
        <highcharts class="chart" :options="chartOptions"></highcharts>
    </div>

</template>

<script>
    export default {
        name: "SingleChart",
        props: ["status", "attributes", "createdAt"],
        data() {
            return {
                createdTime:'',
                chartOptions : {
                    time: {
                        useUTC: false,
                    },

                    chart: {
                        type: 'line',
                        zoomType:'x'
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: this.attributes[0].toUpperCase() + this.attributes.slice(1)
                        },
                    },
                    yaxis: {
                        title: {
                            text: 'Service Status',
                            style: {"color": "#686E73", "fontSize": "16px"},
                        },
                        tickAmount: 1,
                        min: 0 ,
                        max: 1
                    },
                    plotOptions: {
                        column: {
                            pointStart: '' // feb 12, 2015
                        }
                    },

                    colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

                    // Define the data points. All series have a dummy year
                    // of 1970/71 in order to be compared on the same x axis. Note
                    // that in JavaScript, months start at 0 for January, 1 for February etc.
                    series: [{
                        data: [],
                        pointStart:'',
                        pointInterval: 24 * 3600 * 1000,
                    }]
                },
            }
        },

        mounted() {
            if (this.attributes !== "date") {
                this.chartOptions.series.push({
                    name: this.attributes,
                    data: this.status
                });
            }


        }
    };
</script>

<style>
</style>