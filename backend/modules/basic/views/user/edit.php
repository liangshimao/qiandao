<?php
use yii\helpers\Url;
?>
<div class="pad_10">
    <div class="common-form">
        <form name="myform" action="<?php echo Url::toRoute(['/basic/user/edit','id' => $model->id]); ?>" method="post" id="myform">
            <table width="100%" class="table_form contentWrap">
                <tr>
                    <th width="100">用户名：</th>
                    <td><input type="text" name="user[name]" value="<?=$model->name?>" class="form-control-table width-160" readonly id="User-username" style="display: inline" ></td>
                </tr>
                <tr>
                    <th width="100">密 码：</th>
                    <td><input type="password" name="user[password]" value="" class="width-160 form-control" id="User-password" style="display: inline"></td>
                </tr>
                <tr>
                    <th width="100">确认密码：</th>
                    <td><input type="password" name="user[repassword]" value="" class="width-160 form-control" id="User-repassword" style="display: inline;"></td>
                </tr>
            </table>
            <div style="display: none;" class="btn"><input type="submit" id="dosubmit" class="dialog" name="dosubmit" value="提交"/></div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){
            window.top.art.dialog({content: msg, lock: true, width: '250', height: '80'}, function () {
                this.close();
                $(obj).focus();
            })
        }});

        $("#User-password").formValidator({onshow:"请输入密码",onfocus:"请输入密码"}).inputValidator({min:6,max:20,onerror:"密码长度为6-20位"});
        $("#User-repassword").formValidator({onshow:"请输入确认密码",onfocus:"请输入确认密码"}).compareValidator({desid:"User-password",operateor:"=",onerror:"两次输入的密码不一致"}).inputValidator({min:6,max:20,onerror:"密码长度为6-20位"});

    });
</script>
