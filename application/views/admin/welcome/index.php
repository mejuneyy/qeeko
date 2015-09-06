<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="itqee.com">
    <meta name="keyword" content="Qeeko Demo">
    <link rel="shortcut icon" href="/misc/images/favicon.ico">
    <title>QeeKo Demo</title>
    <!-- Bootstrap core CSS -->
    <link href="/misc/flatlab/css/bootstrap.min.css" rel="stylesheet">
    <link href="/misc/flatlab/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/misc/flatlab/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/misc/flatlab/css/style.css" rel="stylesheet">
    <link href="/misc/flatlab/css/style-responsive.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/misc/css/style.css">
</head>
  <body class="login-body">
    <div class="container">
      <form class="form-signin" id="loginForm">
        <h2 class="form-signin-heading">QeeKo Demo</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" name="username" id="username" placeholder="账号" autofocus>
            <input type="password" class="form-control" name="password" id="password" placeholder="密码">
            <label class="checkbox">
                <input type="checkbox" value="remember-me" name="rem" value="1"> 记住账号
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> 忘记密码?</a>
                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" id="doLogin" type="button">登 录</button>
        </div>
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->
      </form>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/misc/flatlab/js/jquery.js"></script>
    <script src="/misc/flatlab/js/bootstrap.min.js"></script>
    <div class="modal fade" id="loginModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">发生了错误</h4>
          </div>
          <div class="modal-body" id="loginModalMsg">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
      $(function () {
        $("#doLogin").on('click', function(){
            do_login();
        });

        $('#password').keydown(function(event){
            if(event.keyCode ==13) do_login();
        });
      });

      function do_login()
      {
        $("#doLogin").html("登录中...").attr("disabled", true);
        var formData = $("#loginForm").serialize();
        console.log(formData);
        $.ajax({
            url:"/admin/welcome/login",
            type:"POST",
            data:formData,
            dataType:"JSON",
            success:function(msg){
                if(msg.ret == 1)
                {
                    window.location.href = '/admin/dashboard/index';
                }
                else
                {
                    $("#loginModalMsg").html(msg.msg);
                    $("#loginModal").modal();
                }
                $("#doLogin").html("登 录").attr("disabled", false);
            }
        });
      }
    </script>
  </body>
</html>