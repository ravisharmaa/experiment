<template>
    <highcharts :options="chartOptions"></highcharts>
</template>

<script>
    import Highcharts from 'highcharts'

    export default {
        name: "MemoryTestComponent",
        props: ['totalMemory', 'freeMemory', 'usedMemory'],
        data() {
            return {
                chartOptions: {
                    chart: {
                        type: 'spline',
                        zoomType: 'x'
                    },
                    rangeSelector: {

                        buttons: [{
                            type: 'day',
                            count: 3,
                            text: '3d'
                        }, {
                            type: 'week',
                            count: 1,
                            text: '1w'
                        }, {
                            type: 'month',
                            count: 1,
                            text: '1m'
                        }, {
                            type: 'month',
                            count: 6,
                            text: '6m'
                        }, {
                            type: 'year',
                            count: 1,
                            text: '1y'
                        }, {
                            type: 'all',
                            text: 'All'
                        }],
                        selected: 3
                    },
                    xAxis: {
                        type: 'datetime',

                        title: {
                            text: 'Cpu Load'
                        }
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
                            }
                        }
                    },

                    colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

                    series: [{
                        name: "Total Memory",
                        data: this.totalMemory,
                        pointStart: ''
                    }, {
                        name: "Memory Free",
                        data: this.freeMemory,
                        color: '#909cff',
                        pointStart: '',
                        pointInterval: 3600 * 80
                    },
                        {
                            name: "Memory Used",
                            data: this.usedMemory,
                            color: '#909cff',
                            pointStart: '',
                            pointInterval: 3600 * 80
                        }
                    ]
                },
            }
        },
    }
</script>

<style scoped>

</style>