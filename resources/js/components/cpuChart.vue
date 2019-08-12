<template>
    <highcharts class="chart" :options="chartOptions" :updateArgs="updateArgs"></highcharts>
</template>

<script>
    import moment from 'moment';
    export default {
        props: ['chartData', 'routeLocation'],
        data() {
            return {
                title: 'CPU Usages',
                initCPU: [],
                chartType: 'Spline',
                seriesColor: '#6fcd98',
                colorInputIsSupported: null,
                animationDuration: 1000,
                updateArgs: [true, true, {duration: 1000}],
                chartOptions: {
                    chart: {
                        type: 'areaspline',
                        zoomType: 'x'
                    },

                    title: {
                        text: 'CPU Usages',
                        style: {"color": "#686E73", "fontSize": "20px", "fontWeight": "Bold"}
                    },
                    xAxis: {
                        type: 'datetime'
                    },
                    yAxis: {
                        title: {
                            text: 'CPU Load (%)',
                            style: {"color": "#686E73", "fontSize": "16px"},
                        }
                    },

                    series: [{
                        name: "CPU Usages",
                        data: [],
                        dataGrouping: {
                            forced: true,
                            units: [
                                ['month', [1]]
                            ]},
                        color: '#00965e',
                        pointStart: '',
                        pointInterval: 3600 * 80 //5 min intervals
                    }]
                }
            }
        },

        created() {
            this.chartData.forEach((value) => {
                this.initCPU.push(value.loadaverage);
            });

            let createdAt = new Date(this.chartData[0].created_at);
            this.chartOptions.series[0].data = this.initCPU;
            this.chartOptions.series[0].pointStart = Date.UTC(createdAt.getFullYear(), createdAt.getMonth(), createdAt.getDate(), createdAt.getHours(), createdAt.getMinutes(), createdAt.getSeconds());
            if (this.routeLocation === 'today') {
                this.chartOptions.series[0].pointInterval = 3600 * 80; //hour
            } else if (this.routeLocation === 'week') {
                this.chartOptions.series[0].pointInterval = 3600 * 80; //day
            } else if (this.routeLocation === 'month') {
                this.chartOptions.series[0].pointInterval = 24 * 2780 ; //day
            } else if (this.routeLocation === 'year') {
                this.chartOptions.series[0].pointInterval = 3600 * 1000000; //day
            }
        },

    }
</script>