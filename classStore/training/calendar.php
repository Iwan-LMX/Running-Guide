<!-- 插入日历的容器 -->
<script type="text/javascript">
    //生成日历选择器, 把日历固定
    $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
    //通过javascript监听选中的日历
    $(function() {
        $("#datepicker").on("change",function(){
            var selected = $(this).val();
            window.location.href = "?date="+ selected;
        });
    });
</script>

