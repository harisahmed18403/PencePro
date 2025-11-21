<div id="{{ $id }}" style="width: 100%; height:100%;"></div>
<script src="
https://cdn.jsdelivr.net/npm/echarts@6.0.0/dist/echarts.min.js
"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var chartDom = document.getElementById('{{ $id }}');
        var myChart = echarts.init(chartDom);

        var option = {
            title: {
                text: '{{ $title }}'
            },
            tooltip: { trigger: 'axis' },
            xAxis: {
                type: 'category',
                data: @json($labels)
            },
            yAxis: { type: 'value' },
            series: [{
                data: @json($series),
                type: 'line',
                smooth: true,
                triggerLineEvent: true
            }],
            animation: false
        };

        myChart.setOption(option);

        myChart.on('click', (params) => {
            console.log(params);
        })
    });

</script>