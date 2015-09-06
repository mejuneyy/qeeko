<section class="wrapper">
<!-- page start-->
<section class="panel">
    <header class="panel-heading">
        用户列表管理 <button type="button" class="btn btn-primary fright" onclick="window.location.href='/admin/user/add'"><i class="icon-plus"></i> 增加</button>
    </header>
    <div class="clr"></div>
    <div class="panel-body">
        <div class="adv-table editable-table ">
            <table class="table table-striped table-hover table-bordered" id="user_list" data-order='[[1, "desc"]]'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>电话</th>
                    <th>登录次数</th>
                    <th>上次登录时间</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- page end-->
</section>
<link rel="stylesheet" href="/misc/flatlab/assets/data-tables/dataTables.bootstrap.min.css" />
<script type="text/javascript" src="/misc/flatlab/assets/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/misc/flatlab/assets/data-tables/dataTables.bootstrap.min.js"></script>
<!--script for this page only-->

<script>
    var userTable = function(){
      return {
          init:function()
          {
              var jtable = $("#user_list").dataTable({
                  "ordering": false,
                  "language": {
                      "sLengthMenu": "显示 _MENU_ 项结果",
                      "sZeroRecords": "没有匹配结果",
                      "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                      "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                      "sInfoFiltered": "",
                      "sInfoPostFix": "",
                      "sSearch": "搜索:",
                      "sUrl": "",
                      "sEmptyTable": "表中数据为空",
                      "sLoadingRecords": "载入中...",
                      "sInfoThousands": ",",
                      "oPaginate": {
                          "sFirst": "首页",
                          "sPrevious": "上页",
                          "sNext": "下页",
                          "sLast": "末页"
                      },
                      "oAria": {
                          "sSortAscending": ": 以升序排列此列",
                          "sSortDescending": ": 以降序排列此列"
                      },
                      "sProcessing": "<img src='/misc/images/loading.gif' />"
                  },
                  "bProcessing": true,
                  "serverSide": true,
                  "ajax": "/admin/user/ajax_get_list",
                  "columns": [
                      { "data": "id" },
                      { "data": "username" },
                      { "data": "email" },
                      { "data": "mobile" },
                      { "data": "logins" },
                      { "data": "last_login" },
                      { "data": "created" },
                      { "data": "optHref" }
                  ]
              });

              var userId = 0;

              $("#user_list .delOne").live('click', function(){
                  userId = $(this).attr('dataval');
                  $("#userDelModal").modal();
              });

              $("#userDelModal #confirmDel").live('click', function(){
                  if(userId != 0)
                  {
                    $("#userDelModal").modal('hide');
                    $.ajax({
                        "type":'POST',
                        "url":'/admin/user/ajax_del_one',
                        'data':{id:userId},
                        'success':function(msg){
                            if(msg.ret == 1)
                            {
                                $("#user_"+userId).remove();
                                jtable.fnDraw();
                            }
                            else
                            {
                                showAlert(msg.msg);
                            }
                        }
                    });
                  }
              }); 
        
            }
        };
    }();

    userTable.init();
</script>

<div class="modal fade" id="userDelModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">温馨提示</h4>
      </div>
      <div class="modal-body">
        <p>是否删除该用户？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-danger" id="confirmDel">确认删除</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->