<div id="{{ $id }}" style="width: 100%; height:100%;"></div>
<script src="
https://cdn.jsdelivr.net/npm/echarts@6.0.0/dist/echarts.min.js
"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var chartDom = document.getElementById('{{ $id }}');
        var myChart = echarts.init(chartDom);

        var option = {
            tooltip: { trigger: 'axis' },
            animation: false,
            grid: {
                left: '5%',
                right: '5%',
                top: 0,
                bottom: 0
            }
        };

        myChart.setOption(option);
    });

</script>