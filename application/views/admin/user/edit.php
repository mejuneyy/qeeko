<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="/admin/dashboard/index"><i class="icon-home"></i> 控制台</a></li>
                <li><a href="/admin/user/list">用户管理</a></li>
                <li class="active">用户<?php echo $opt; ?></li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    用户<?php echo $opt; ?>
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" id="userForm">
                            <div class="form-group ">
                                <label for="username" class="control-label col-lg-2">用户名 (必填)</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" value="<?php echo isset($user['username']) ? $user['username'] : '';?>" id="username" name="username" minlength="2" type="text" required />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="password" class="control-label col-lg-2">密码</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="password" name="password" type="password" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="confirm_password" class="control-label col-lg-2">重新输入</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="confirm_password" name="password_confirm" type="password">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">E-Mail</label>
                                <div class="col-lg-10">
                                    <input class="form-control" value="<?php echo  isset($user['email']) ? $user['email'] : '';?>" id="cemail" type="email" name="email"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">手机号</label>
                                <div class="col-lg-10">
                                    <input class="form-control" value="<?php echo  isset($user['mobile']) ? $user['mobile'] : '';?>" id="curl" type="text" name="mobile" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <input type="hidden" name="id" value="<?php echo  isset($user['id']) ? $user['id'] : '';?>" />
                                    <button class="btn btn-danger" type="button" id="doUser">确定</button>
                                    <button class="btn btn-default" type="button" onclick="history.go(-1)">返回</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#doUser").on('click', function(){
            if($("#confirm_password").val() != $("#password").val())
            {
                showAlert('两次密码输入不一致');
                return ;
            }

            var formData = $("#userForm").serialize();
            $.ajax({
                'type':"POST",
                'url':"/admin/user/ajax_do_user",
                'data':formData,
                'success':function(msg)
                {
                    if(msg.ret == 1)
                    {
                        window.location.href = '/admin/user/list';
                    }
                    else
                    {
                        showAlert(msg.msg);
                    }
                }
            });
        });
    });
</script>