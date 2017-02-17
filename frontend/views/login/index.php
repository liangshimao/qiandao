<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>批量签到登陆</title>
    <script src="/js/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/webmain.css">
    <style>
        .lmaisft{
            width:450px;border-radius:5px;
            text-align:left;
            background-color:#C4E0F4;
            background: rgba(255,255,255,0.3);
        }
    </style>

</head>
<body style="background:#66A8E5 url(/images/loginbg.jpg) top center no-repeat">
<div id="topheih" class="blank40" style="height: 141.5px;"></div>
<div align="center">
    <div class="ltoplog">
        <img src="/images/logo.png" align="absmiddle" style="margin-right:15px;" height="60" width="60">
        <b style="font-size:22px">批量签到系统登陆</b></div>
    <div class="blank30"></div>
    <div class="lmaisft">

        <form style="padding:20px;padding-left:80px" name="myform" action="<?=Url::toRoute('/login/login')?>" method="post" id="myform">

            <div class="blank10"></div>
            <div>
                <div><input type="text" style="height:40px;width:300px" class="input" value=""  placeholder="请输入用户名" name="username" ></div>
            </div>

            <div class="blank30"></div>
            <div>
                <div><input  style="height:40px;width:300px" class="input"  name="password" id="adminpasss" type="password" placeholder="请输入密码"></div>
            </div>
            <div class="blank10"></div>
            <div align="left">
                <div class="checkbox"><label><input type="checkbox" checked name="rempass">记住密码</label>&nbsp; &nbsp;</div>
            </div>

            <div class="blank10"></div>
            <div align="left">
                <button type="button" class="btn btn-success" name="button" onclick="login()"><i class="glyphicon glyphicon-hand-up"></i> 登录</button>&nbsp;<span id="msgview"></span>
                <span id="tip" style="color:red;display:none;">密码错误</span>
            </div>
        </form>

    </div>

    <div class="blank20"></div>
    <div align="center" style="height:30px;line-height:30px;color:#555555">
        Copyright &copy;2016 批量签到系统 &nbsp;&nbsp;
    </div>

</div>

<script>
    function login()
    {
        $.ajax({
            url:"<?php echo Url::toRoute('/login/login_ajax')?>",
            dataType:"json",
            type:"post",
            data:$("#myform").serialize(),
            success:function (res) {
                if(res.code == 200){
                    if(res.data.status == 1){
                        location.href="<?php echo Url::toRoute('/index/index');?>";
                    }else{
                        $("#tip").html(res.msg);
                        $("#tip").show();
                        setTimeout(function(){
                            $("#tip").hide();
                        },3000);
                    }
                }
            }
        });
    }
</script>

</body>
</html>