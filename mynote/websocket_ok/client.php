<!DOCTYPE html>
<html>
<head>
    <title>群聊</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        <!--
        html, body {
            min-height: 100%; }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-family: "Microsoft Yahei",sans-serif, Arial; }

        .container {
            text-align: center; }

        .title {
            font-size: 16px;
            color: rgba(0, 0, 0, 0.3);
            position: fixed;
            line-height: 30px;
            height: 30px;
            left: 0px;
            right: 0px;
            background-color: white; }

        .content {
            background-color: #f1f1f1;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            margin-top: 30px; }
        .content .show-area {
            text-align: left;
            padding-top: 8px;
            padding-bottom: 168px; }
        .content .show-area .message {
            width: 70%;
            padding: 5px;
            word-wrap: break-word;
            word-break: normal; }
        .content .write-area {
            position: fixed;
            bottom: 0px;
            right: 0px;
            left: 0px;
            background-color: #f1f1f1;
            z-index: 10;
            width: 100%;
            height: 160px;
            border-top: 1px solid #d8d8d8; }
        .content .write-area .send {
            position: relative;
            top: -28px;
            height: 28px;
            border-top-left-radius: 55px;
            border-top-right-radius: 55px; }
        .content .write-area #name{
            position: relative;
            top: -20px;
            line-height: 28px;
            font-size: 13px; }
        -->
    </style>
</head>
<body>
<div class="container">
    <div class="title">实现群聊</div>
    <div class="content">
        <div class="show-area"></div>
        <div class="write-area">
            <div><button class="btn btn-default send" >发送</button></div>
            <!--            <div><input name="name" id="name" type="text" placeholder="input your name"></div>-->
            <div style="width: 20%;margin: auto;">
                <div style="float: left;">
                    <textarea name="message" id="message" cols="38" rows="4" placeholder="input your message..."></textarea>
                </div>
                <div style="float: left;" class="online"><p>在线用户</p></div>
            </div>
        </div>
    </div>
</div>

<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script>
    var me = '';
    function addUsers(){
        if(me = $('.name').val()){
            $('.online').append("<p onclick='hujiao(this)'>"+$('.name').val()+"</p>");
        }
    }
    function hujiao(e){
        $('#message').val($('#message').val()+'@'+e.innerHTML) ;
    }
    $(function(){


        var wsurl = 'ws://localhost:2611/websocket_ok/server.php';
//            var wsurl = 'ws://120.76.79.169:2611/web/websocket/server.php';
        var websocket;
        var i = 0;
        if(window.WebSocket){
            websocket = new WebSocket(wsurl);

            websocket.onopen = function(evevt){
                console.log("Connected to WebSocket server.");
                $('.show-area').append('<p class="bg-info message"><i class="glyphicon glyphicon-info-sign"></i>Connected to WebSocket server!</p>');
                //if(!$('#name').val()){
                $('.show-area').append('<p class="bg-info message">您还没登录!请输入您的用户名<input type="text" name="name" class="name"/><button onclick="addUsers()">登录</button></p>');
                //}
            }
            websocket.onmessage = function(event) {
                var msg = JSON.parse(event.data); //解析收到的json消息数据

                var type = msg.type; // 消息类型
                var umsg = msg.message; //消息文本
                var uname = msg.name; //发送人
                i++;
                if(type == 'usermsg'){
                    $('.show-area').append('<p class="bg-success message"><i class="glyphicon glyphicon-user"></i><a name="'+i+'"></a><span class="label label-primary">'+uname+' say: </span>'+umsg+'</p>');
                }
                if(type == 'system'){
                    $('.show-area').append('<p class="bg-warning message"><a name="'+i+'"></a><i class="glyphicon glyphicon-info-sign"></i>'+umsg+'</p>');
                }

                $('#message').val('');
                window.location.hash = '#'+i;
            }

            websocket.onerror = function(event){
                i++;
                console.log("Connected to WebSocket server error");
                $('.show-area').append('<p class="bg-danger message"><a name="'+i+'"></a><i class="glyphicon glyphicon-info-sign"></i>Connect to WebSocket server error.</p>');
                window.location.hash = '#'+i;
            }

            websocket.onclose = function(event){
                i++;
                console.log('websocket Connection Closed. ');
                $('.show-area').append('<p class="bg-warning message"><a name="'+i+'"></a><i class="glyphicon glyphicon-info-sign"></i>websocket Connection Closed.</p>');
                window.location.hash = '#'+i;
            }


            function send(){
                var name = $('#name').val();
                var message = $('#message').val();
                if(!name){
                    alert('请输入用户名!');
                    return false;
                }
                if(!message){
                    alert('发送消息不能为空!');
                    return false;
                }
                var msg = {
                    message: message,
                    name: name
                };
                try{
                    websocket.send(JSON.stringify(msg));
                } catch(ex) {
                    console.log(ex);
                }
            }

            $(window).keydown(function(event){
                if(event.keyCode == 13){
                    console.log('user enter');
                    send();
                }
            });

            $('.send').bind('click',function(){
                if(me)
                    send();
            });

        }
        else{
            alert('该浏览器不支持web socket');
        }

    });
</script>
</body>
</html>
