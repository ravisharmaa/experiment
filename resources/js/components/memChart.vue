<template>
    <highcharts class="chart" :options="chartOptions" :updateArgs="updateArgs"></highcharts>
</template>

<script>
    export default {
        props: ['chartData', 'routeLocation'],
        data() {
            return {
                title: 'Memory Usages',
                initMemFree: [],
                initMemUsed: [],
                chartType: 'Spline',
                seriesColor: '#6fcd98',
                colorInputIsSupported: null,
                animationDuration: 1000,
                updateArgs: [true, true, {duration: 1000}],
                chartOptions: {
                    title: {
                        text: 'Memory Usages',
                        style: {"color": "#333333", "fontSize": "20px", "fontWeight": "Bold"}
                    },
                    xAxis: {
                        type: 'datetime'
                    },
                    yAxis: {
                        title: {
                            text: 'Memory Usage (GB)',
                            style: {"color": "#333333", "fontSize": "16px"},
                        }
                    },
                    series: [{
                        name: "Memory Used",
                        data: [],
                        color: '#00965e',
                        pointStart: '',
                        pointInterval: 3600 * 80
                    },
                    {
                        name: "Memory Free",
                        data: [],
                        color: '#909cff',
                        pointStart: '',
                        pointInterval: 3600 * 80
                    }]
                }
            }
        },
        created() {
            //console.log(this.chartData);
            this.chartData.forEach((value) => {

                //this.initMemFree.push(parseFloat(value.memfree / 1024 / 1024));
                this.initMemFree.push(parseFloat(value.memfree));
                //this.initMemUsed.push(parseFloat((value.memtotal - value.memfree) / 1024 / 1024));
                this.initMemUsed.push(parseFloat((value.memtotal - value.memfree)));
            });

            //console.log(this.chartOptions.series);


            this.chartOptions.series[0].data = this.initMemFree;
            this.chartOptions.series[1].data = this.initMemUsed;

            let createdAt = new Date(this.chartData[0].created_at);

            this.chartOptions.series[0].pointStart = Date.UTC(createdAt.getFullYear(), createdAt.getMonth(), createdAt.getDate(), createdAt.getHours(), createdAt.getMinutes(), createdAt.getSeconds());
            this.chartOptions.series[1].pointStart = Date.UTC(createdAt.getFullYear(), createdAt.getMonth(), createdAt.getDate(), createdAt.getHours(), createdAt.getMinutes(), createdAt.getSeconds());
            if (this.routeLocation == 'today') {
                this.chartOptions.series[0].pointInterval = 3600 * 80; //hour
                this.chartOptions.series[1].pointInterval = 3600 * 80; //hour
            } else if (this.routeLocation == 'week') {
                this.chartOptions.series[0].pointInterval = 3600 * 80; //day
                this.chartOptions.series[1].pointInterval = 3600 * 80; //day
            } else if (this.routeLocation == 'month') {
                this.chartOptions.series[0].pointInterval = 24 * 2780; //day
                this.chartOptions.series[1].pointInterval = 24 * 2780; //day
            } else if (this.routeLocation == 'year') {
                this.chartOptions.series[0].pointInterval = 3600 * 1000000; //months
                this.chartOptions.series[1].pointInterval = 3600 * 1000000; //months
            }
        },

        mounted() {

        }

    }
</script>