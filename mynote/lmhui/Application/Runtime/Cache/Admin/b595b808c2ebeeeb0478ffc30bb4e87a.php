<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>标题</title>
    
    <link href="/lmhui/Application/Admin/View/Public/css/left.css" rel="stylesheet" type="text/css"/>

</head>
<body>
    
        <div style="height: 80px;background: #fff;width: 100%;">
            <!--<span style="font-weight: bold;display: block;height: 80px;width: 200px;float: left;line-height: 80px;">后台管理</span>-->
            <div style="font-weight: bold;height: 80px;width: 200px;float: left;line-height: 80px;float: left;">后台管理</div>
            <div style="width: 200px;float: left;margin: auto;"><img src="/lmhui/Application/Admin/View/Public/image/logo.png"/></div>
            <div style="font-weight: bold;height: 80px;width: 400px;float: right;line-height: 80px;">
                欢迎 <?php echo ($user); ?>　　<a href="/lmhui/index.php/Admin/Index/logout">退出</a>
            </div>
        </div>
    

    <div style="width: 100%;height: 600px;">
        
            <link href="/lmhui/Application/Admin/View/Public/css/left.css" rel="stylesheet" type="text/css"/>
            <div style="width: 8%;background: lightskyblue;float: left;height: 100%;">
                <ul>
                    <li><a href="<?php echo U('User/lists');?>">用户管理</a></li>
                    <li><a href="<?php echo U('DataSource/importData');?>">导入数据</a></li>
                    <li><a href="<?php echo U('Good/show');?>">商城管理</a></li>
                    <li><a href="#">库存管理</a></li>
                    <li><a href="#">订单管理</a></li>
                    <li><a href="#">广告管理</a></li>
                </ul>
            </div>
        

        
            <div style="width: 92%;height: 600px;border-top: 35px solid gainsboro;float: right;">
                这是内容
            </div>
        
    </div>

    
        <div style="background: silver;height: 60px;margin-bottom: 0px;">
            这是底部
        </div>
    
</body>
</html>