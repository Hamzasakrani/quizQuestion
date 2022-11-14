<template>
  <apexchart type="pie" width="380" :options="chartOptions" :series="series"></apexchart>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";

export default {
  name: "MyComponent",

  components: {
    apexchart: VueApexCharts,
  },
  props: {
    values: Array,
    titles: Array,
  },
  data: () => ({
    series: [],
    chartOptions: {
      chart: {
        width: 380,
        type: "pie",
      },
      labels: [],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
    },
  }),
  created() {
    this.series = this.values;
    this.chartOptions.labels = this.titles;
  },
};
</script>
