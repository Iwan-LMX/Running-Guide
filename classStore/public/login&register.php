<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>注册登录</title>
  <link rel="stylesheet" type="text/css" href="https://www.layuicdn.com/layui/css/layui.css" />
  <script src="https://www.layuicdn.com/layui/layui.js" charset="utf-8"></script>
</head>
<body>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>登录&注册</legend>
</fieldset>
<div style="padding: 20px; background-color: #F2F2F2;">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md6">
      <div class="layui-card">
        <div class="layui-card-header">注册</div>
        <div class="layui-card-body">
          <form class="layui-form" action="register.php" method="post" onsubmit="return checkForm(this)" lay-filter="example">
            <div class="layui-form-item">
              <label class="layui-form-label">输入框</label>
              <div class="layui-input-block">
                <input type="text" name="username" placeholder="请输入账号" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">密码框</label>
              <div class="layui-input-block">
                <input type="password" name="password" placeholder="请输入密码" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <div class="layui-input-block">
                <input type="submit" class="layui-btn layui-btn-normal" value="立即注册"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="layui-col-md6">
      <div class="layui-card">
        <div class="layui-card-header">登录</div>
        <div class="layui-card-body">
          <form class="layui-form" action="login.php" method="post" onsubmit="return checkForm(this)" lay-filter="example">
            <div class="layui-form-item">
              <label class="layui-form-label">输入框</label>
              <div class="layui-input-block">
                <input type="text" name="username" placeholder="请输入账号" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">密码框</label>
              <div class="layui-input-block">
                <input type="password" name="password" placeholder="请输入密码" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <div class="layui-input-block">
                <input type="submit" class="layui-btn layui-btn-normal" value="立即登录"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  // 验证输入不为空的脚本代码
  function checkForm(form) {
    if(form.username.value == "") {
      alert("用户名不能为空!");
      form.username.focus();
      return false;
    }
    if(form.password.value == "") {
      alert("密码不能为空!");
      form.password.focus();
      return false;
    }
    return true;
  }
</script>
</body>
</html>
