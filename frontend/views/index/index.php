<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>批量签到</title>
    <script type="text/javascript" src="/js/jquery-1.9.1.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/encode.js" charset="utf-8"></script>
    <script>
        function stop(){
            return false;
        }
        document.oncontextmenu=stop;
    </script>
</head>
<body>
<div>
    <center style="margin-top:5%">
        <a>
            <input id="file" type="file" name="上传账号文件" onchange="checkAccountList(this.files);"/>
        </a>

        <div style="margin-top: 20px;margin-bottom:20px;">
            分析完成,共计:<a id="totalAccount">0</a>个账号! 其中<a id="repeatSum">0</a>个已被过滤!
        </div>
        选择区域:
        <select name="zone" id="zone">
            <option value="1500200">南区</option>
            <option value="1500100">北区</option>
        </select>
        <button name="开始" value="开始" id="start">开始</button>
        <button name="再次签到" value="再次签到" id="restart">再次签到</button>
        <div style="margin-">
            共计:<a id="a1">0</a>个账号，正在签到第<a id="a2">0</a>个，剩余<a id="a3">0</a>个。
        </div>
        <table style="margin-top:10px;" id="accountTable" border="1px; solid; red;">
            <tr>
                <td>账号</td>
                <td>签到状态</td>
            </tr>
        </table>
    </center>

</div>
</body>
<script type="text/javascript" charset="utf-8">
    var sleepTime = 0;
    var accountArr = new Array();
    var failArr = new Array();
    //检查账号
    function checkAccountList(files){
        $("#accountTable").html("");
        var $tr = $("<tr>").append($("<td>").text("账号"))
            .append($("<td>").text("签到状态"));
        $("#accountTable").append($tr);
        if (files.length) {
            var file = files[0];
            var reader = new FileReader();
            if (/text\/\w+/.test(file.type)) {
                reader.onload = function() {

                    var strArr = this.result.split("#");
                    var repeatCount = 0;
                    for(var i=1; i<strArr.length; i++){
                        var lineStr = strArr[i].substr(0, strArr[i].indexOf("----"));
                        var isRepeat = false;
                        for(var j=0; j<accountArr.length; j++){
                            if(lineStr == accountArr[j]){
                                isRepeat = true;
                                repeatCount++;
                                break;
                            }
                        }
                        if(!isRepeat){
                            //加入数据
                            accountArr.push(lineStr);
                            //加入DOM
                            var $tr = $("<tr>").attr("id", lineStr)
                                .append($("<td>").text(lineStr))
                                .append($("<td>").text("准备签到"));
                            $("#accountTable").append($tr);
                        }
                    }

                    $("#totalAccount").text(accountArr.length);
                    $("#a1").text(accountArr.length);

                    if(0 != repeatCount){
                        alert("有重复账号" + repeatCount + "个已被过滤!");
                    }
                    $("#repeatSum").text(repeatCount);
                }
                reader.readAsText(file);
            }
        }
    }

    $("#start").bind("click", function(){
        if ("" == $("#file").val() || accountArr.length <= 0) {
            alert("请选择文件!");
            return;
        }

        submitt(0);
    });

    $("#restart").bind("click", function(){
        if (0 == failArr.length) {
            alert("没有失败账号!");
            return;
        }

        resubmit(0);
    });

    function sleep(numberMillis) {

        if (0 == numberMillis) {
            return;
        }
        var now = new Date();
        var exitTime = now.getTime() + numberMillis;
        while (true) {
            now = new Date();
            if (now.getTime() > exitTime)
                return;
        }
    }

    function submitt(i){
        var nowi = i;
        if (undefined == accountArr[i]) {
            accountArr = new Array();
            $("#file").val("");
            $("#a1").text("0");
            $("#a2").text("0");
            $("#a3").text("0");
            checkfail();
            alert("签到完成! 签到失败:" + failArr.length + "个!正在对失败账号重新签到!");
            resubmit(0);
            return;
        }else{
            $("#a2").text(i);
            $("#a3").text(accountArr.length - i);
        }
        var paramData = {
            "useraccount" : "1801012411",
            "marks" : "inside",
            "login" : base64encode(utf16to8(accountArr[i])),
            "zoneid" : $("#zone").val(),
            "_" : new Date().getTime()
        };
        $.ajax({
            async:false,
            url: "http://inside.wot.kongzhong.com/inside/wotinside/signact/sign",
            type: "GET",
            dataType: 'jsonp',
            jsonp: 'jsonpcallback',
            data: paramData,
            timeout: 5000,
            beforeSend: function(){
                //jsonp 
            },
            success: function (result) {
                var resultText = "未知";
                if ("1" == result.state) {
                    resultText = "签到成功";
                }else if ("0" == result.state) {
                    resultText = "已签到"
                }

                $($("#" + accountArr[nowi]).children()[1]).text(resultText);

                sleep(sleepTime);
                submitt(++i)
            }
        });
    }

    function checkfail(){
        failArr = new Array();
        $.each($("td"), function(){
            if("准备签到" == $(this).text() || "未知" == $(this).text()){
                failArr.push($(this).prev().text());
            }
        });
    }

    function resubmit(i){
        var nowi = i;
        if (undefined == failArr[i]) {
            failArr = new Array();
            $("#file").val("");
            $("#a1").text("0");
            $("#a2").text("0");
            $("#a3").text("0");
            checkfail();
            alert("签到完成! 签到失败:" + failArr.length + "个!");

            return;
        }else{
            $("#a2").text(i);
            $("#a3").text(failArr.length - i);
        }
        var paramData = {
            "useraccount" : "1801012411",
            "marks" : "inside",
            "login" : base64encode(utf16to8(failArr[i])),
            "zoneid" : $("#zone").val(),
            "_" : new Date().getTime()
        };
        $.ajax({
            async:false,
            url: "http://inside.wot.kongzhong.com/inside/wotinside/signact/sign",
            type: "GET",
            dataType: 'jsonp',
            jsonp: 'jsonpcallback',
            data: paramData,
            timeout: 5000,
            beforeSend: function(){
                //jsonp 
            },
            success: function (result) {
                var resultText = "未知";
                if ("1" == result.state) {
                    resultText = "签到成功";
                }else if ("0" == result.state) {
                    resultText = "已签到"
                }

                $($("#" + failArr[nowi]).children()[1]).text(resultText);

                sleep(sleepTime);
                resubmit(++i)
            }
        });
    }

</script>
</html>