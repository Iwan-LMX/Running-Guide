<?php
    $date=array('"????-??-??"', '"????-??-??"', '"????-??-??"', '"????-??-??"', '"????-??-??"', '"????-??-??"', '"????-??-??"');
    $quotients = array(0, 0, 0, 0 ,0 ,0, 0);
    $works=0; //为下面计算运动数使用
    require_once "Config/database.php";
    error_reporting(E_ERROR); //关闭warning
    session_start();
    $userid = $_SESSION["UserID"];
    if($userid){
        //确定登录 获取user在quotient表中最后7项跑力值
        require_once "classStore/dataCenter/Getquotient.php";
        $results = new Getquotient();
        $data = $results->weekquotients($userid);
        for($i=0; $i<7; $i++){
            $date[6-$i] ='"'. $data[$i][2] .'"';
            $quotients[6-$i] =  $data[$i][3];
            //计算本周跑步次数
            $diff = date_diff(date_create($data[$i][2]), date_create());
                if($diff->days < 7){
                    $works++;
                }
        }
        //记录works && 最新跑力值
        setcookie("works", $works);
        setcookie("quotient", $data[0][3]);
        setcookie("date", $data[0][2]);
    }else{
        setcookie("works", "无");
        setcookie("quotient", 0);
        setcookie("date", "????-??-??");
    }
    //将$date和$quotient转变成字符串
    $strdate = "[" . implode(", ", $date) . "]";
    $strquotients = "[" . implode(", ", $quotients) . "]";
?>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('graph'));
    // 指定图表的配置项和数据
    var option = {
        tooltip: {
            trigger: 'item',
            formatter: '跑力值: {c} <br/> 日期: {b}'
        },
        title: {
            text: '7天跑力值',
            x: 'center'
        },
        xAxis: {
            type: 'category',
            data: <?php echo $strdate?> //x轴的日期值
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                data: <?php echo $strquotients?>, //y轴的跑力值
                type: 'line'
            }
        ]
    };
    let currentIndex = -1;

    setInterval(function() {
        var dataLen = option.series[0].data.length;
        // 显示 tooltip
        myChart.dispatchAction({
            type: 'showTip',
            seriesIndex: 0,
            dataIndex: currentIndex
        });
    }, 1000);
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
