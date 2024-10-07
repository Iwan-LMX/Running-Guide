<!--第二步：添加如下 HTML 代码-->
<h1 style="text-align: center">跑步数据总览</h1>
<table id="table_id_example" class="display" >
    <thead>
    <tr>
        <th>运动日期</th>
        <th>平均速度</th>
        <th>距离</th>
        <th>心率</th>
        <th>步频</th>
    </tr>
    </thead>
    <tbody>
    <?php
        //生成table的主要内容
        require_once "Config/database.php";
        session_start();
        $userid = $_SESSION["UserID"];
        $blank = "<tr><td>None</td><td>None</td><td>None</td><td>None</td><td>None</td></tr>";
        //判断是否已有用户登录
        if($userid){
            //获取当前用户数据库中的运动信息,并转换为array类型
            $sql = "SELECT * FROM `runing` WHERE `user_id` = {$userid} ORDER BY rundate DESC ";
            $results = mysqli_query($connID,$sql)-> fetch_all();
            //将获取的信息输出
            foreach ($results as $result){
                echo "<tr>";
                for($i=1; $i<6; $i++){
                    echo "<td>";
                    echo $result[$i];
                    echo "</td>";
                }
                echo "</tr>";
            }
        }else{ echo $blank;}
    ?>
    </tbody>
</table>

<script type="text/javascript">
    <!--第三步：初始化Datatables-->
    $(document).ready( function () {
        $('#table_id_example').DataTable();
    } );
</script>

