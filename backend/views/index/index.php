<?php

use yii\helpers\Url;
use common\components\Tools;
?>
<div class="topheader">
    <table border="0" width="100%">
        <tbody>
        <tr>
            <td height="50">
                <table>
                    <tbody>
                    <tr>
                        <td style="padding:0px 10px;"><img src="/images/xh829.png" height="34" width="34"></td>
                        <td style="font-size:18px;padding-right:20px"><b>签到系统后台管理系统</b></td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td width="80%">
                <div class="topmenubg">
                    <span menu="0" class="spanactive"><i class="glyphicon glyphicon-th-large"></i> 基础数据</span>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="topcenter" align="right">
    <span id="indexexit">&nbsp;<a href="<?=Url::toRoute('/login/logout')?>"> <i style="color:#fff" class="glyphicon glyphicon-log-in"></i></a></span>
    <span id="indexuserl" status="0">
        <div class="rockmenu" style="display: none">
            <div class="rockmenuli">
                <ul>
                    <li id="editPassword" onclick="edit_pwd()"><i class="glyphicon glyphicon-lock"></i> 修改密码</li>
                    <li style="border:none;"><i class="glyphicon glyphicon-user"></i>帐号(<?=$username; ?>)</li>
                </ul>
            </div>
        </div>
        <img src="/images/1.jpg">你好，<?php echo $realname;?>&nbsp; <i class="caret caret-down"></i></span>
</div>
<div id="content" style="width: auto;">
    <div class="col-left left_menu left_menu_on">
        <!--------------左侧菜单-------------------->
        <div id="indexmenu">
            <div class="menutoptext">
                <ul>
                    <li class="li01">
                        <div id="menulisttop" style="font-size:16px;padding-left:10px">
                            <i class="glyphicon glyphicon-th-large"></i> 基础数据
                        </div>
                    </li>
                    <li class="li02">
                        <div style="text-align:right;padding-right:10px">&nbsp;
                            <i id="reordershla" data-clicknum='0' class="glyphicon glyphicon-list cursor"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <div id="menulist">
                <div id="left_menu_0" style="">
                    <div class="menuone" disab="1" status="true">
                        <i class="glyphicon glyphicon-asterisk"></i>
                        用户管理
                        <span class="caret caret-upc"></span>
                    </div>
                    <div class="menulist" style="">
                        <div class="menutwo" data-url="<?=Url::toRoute('/basic/user/index')?>" name="userlist">
                            <i class="glyphicon glyphicon-user"></i>
                            用户列表
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="openClose" style="display: none;" class="menulistbg cursor">
            <i class="glyphicon glyphicon-list"></i><br>打<br>开<br>导<br>航
        </div>
    </div>
    <div class="col-auto">
        <div class="tabsindex" id="tabs_title">
            <div id="shouye" class="menu-list accive" data-url="<?=Url::toRoute('/index/main')?>"><i class="glyphicon glyphicon-home"></i> 首页</div>
        </div>
        <div class="col-1" style="padding: 5px 5px 0px 5px">
            <iframe name="right" id="rightMain" src="<?php echo Url::toRoute('/index/main'); ?>" frameborder="false" scrolling="auto" style="border:none;margin-bottom: 0px" width="100%" height="auto" allowtransparency="true"></iframe>
        </div>
    </div>
</div>
<script type="text/javascript">
    //左侧开关(展开情况下)
    $("#reordershla").click(function () {
        if ($(this).data('clicknum') === 1) {
//            $("html").removeClass("on");
//            $(".left_menu").addClass("left_menu_on");
//            $(this).data('clicknum', 0);
//            $("#indexmenu").show();
//            $("#openClose").hide();
        } else {
            $("html").addClass("on");
            $(".left_menu").removeClass("left_menu_on");
            $(this).data('clicknum', 1);
            $("#indexmenu").hide();
            $("#openClose").show();

        }
        return false;
    });
    //左侧开关(折叠情况下)
    $("#openClose").click(function () {
        if ($("#reordershla").data('clicknum') === 0) {
//            $("#reordershla").data('clicknum', 1);
//            $(".left_menu").addClass("left_menu_on");
//            $("#indexmenu").hide();
//            $("#openClose").show();
        } else {
            $("html").addClass("on");
            $("#reordershla").data('clicknum', 0);
            $(".left_menu").addClass("left_menu_on");
            $("#indexmenu").show();
            $("#openClose").hide();
        }
        return false;
    });

    var getWindowSize = function () {
        return ["Height", "Width"].map(function (name) {
            return window["inner" + name] ||
                document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
        });
    };
    window.onload = function () {
        if (!+"\v1" && !document.querySelector) { // for IE6 IE7
            document.body.onresize = resize;
        } else {
            window.onresize = resize;
        }
        function resize() {
            wSize();
            return false;
        }
    };
    function wSize() {
        //这是一字符串
        var str = getWindowSize();
        var strs = new Array(); //定义一数组
        strs = str.toString().split(","); //字符分割
        var heights = strs[0] - 150, Body = $('body');
        $('#rightMain').height(heights);
        if (strs[1] < 980) {
            $('#content').css('width', 980 + 'px');
            Body.attr('scroll', '');
//            Body.removeClass('objbody');
        } else {
            $('#content').css('width', 'auto');
            Body.attr('scroll', 'no');
//            Body.addClass('objbody');
        }

        var openClose = $("#rightMain").height() + 39;
        $("#rightMain").css("height", openClose);
    }
    wSize();


    function edit_pwd() {
        window.top.art.dialog({
                title: '信息修改',
                id: 'add',
                iframe: '<?php echo Url::toRoute('/basic/user/editpwd'); ?>',
                width: '480px',
                height: '280px'
            },
            function () {
                var d = window.top.art.dialog({id: 'add'}).data.iframe;
                var form = d.document.getElementById('dosubmit').click();
                return false;
            },
            function () {
                window.top.art.dialog({id: 'add'}).close();
            }
        );
    }
    $(function () {

        //右上方折叠
        $('#indexuserl').click(function () {
            var status = $(this).attr('status');
            if (status == 0) {
                $(this).children('i').removeClass('caret-down').addClass('caret-up');
                $('.rockmenu').show();
                $(this).attr('status', 1);
            } else {
                $(this).children('i').removeClass('caret-up').addClass('caret-down');
                $('.rockmenu').hide();
                $(this).attr('status', 0);
            }
        });

        //左侧纵向折叠
        $('.menuone').click(function () {
            var status = $(this).attr('status');
            if (status == 'false') {
                $(this).children('span').removeClass('caret-downc').addClass('caret-upc');
                $(this).next('.menulist').show();
                $(this).attr('status', 'true');
            } else {
                $(this).children('span').removeClass('caret-upc').addClass('caret-downc');
                $(this).next('.menulist').hide();
                $(this).attr('status', 'false');
            }
        });

        //tab添加
        $('.menuone, .menutwo').click(function () {
            if ($(this).attr('disab') != 1) {
                var targetUrl = $(this).attr('data-url');
                $("#rightMain").attr('src', targetUrl);
                var title = $(this).attr('name');
                //页面模块切换
                $('.' + title).show().siblings().hide();
                //TAB状态切换
                $('#' + title).addClass('accive').siblings().removeClass('accive');
                //TAB如果已存在则不添加
                if (typeof (title) != 'undefined' && $('#' + title).size() > 0)
                    return;
                $('#tabs_title .accive').removeClass('accive');
                var html = '<div id="' + title + '" data-url="' + targetUrl + '" class="accive menu-list">' + $(this).html() + '<span class="glyphicon glyphicon-remove"></span></div>';
                $('#tabs_title').append(html);
            }
        });
        //tab关闭
        $('.tabsindex').on('click', '.glyphicon-remove', function () {
            $(this).parent().remove();
            if ($('.accive').size() == 0) {
                var num = $('.tabsindex .menu-list').size();
                //最后一个添加状态
                $('.tabsindex .menu-list').eq(num - 1).addClass('accive');
                //页面模块切换
                var title = $('.tabsindex .menu-list').eq(num - 1).attr('id');
                var targetUrl = $('.tabsindex .menu-list').eq(num - 1).attr('data-url');
                if (typeof (targetUrl) != 'undefined') {
                    $("#rightMain").attr('src', targetUrl);
                } else {
                    $("#rightMain").attr('src', '/main/basics');
                }

                $('.' + title).show().siblings().hide();
            }
            //阻止冒泡事件
            return false;
        });
        //tab状态切换
        $('#tabs_title').on('click', '.menu-list', function () {

            $(this).addClass('accive').siblings().removeClass('accive');
            var title = $(this).attr('id');
            //页面模块切换
            $('.' + title).show().siblings().hide();
            var targetUrl = $(this).attr('data-url');
            $("#rightMain").attr('src', targetUrl);
        });
        //新增点击头部一级菜单 显示作则
        $('.topmenubg span').click(function () {
            //设置菜单切换时 自动展示并初始化
            $("#reordershla").data('clicknum', 0);
            $(".left_menu").addClass("left_menu_on");
            $("#indexmenu").show();
            $("#openClose").hide();

            var menuId = $(this).attr('menu');
            $('#left_menu_' + menuId).show().siblings().hide();
            $(this).addClass("spanactive").siblings().removeClass("spanactive");
            var menulisttop = $(this).html();
            $('#menulisttop').html(menulisttop);
        });

    });


    function _MP(targetUrl) {
        $("#rightMain").attr('src', targetUrl);
    }
</script>

