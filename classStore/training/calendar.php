<!-- 插入日历的容器 -->
<script type="text/javascript">
    $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
    $(function() {
        $("#datepicker").on("change",function(){
            var selected = $(this).val();
            window.location.href = "?date="+ selected;
        });
    });

</script>

<?php
    echo $_GET["date"];
?>
