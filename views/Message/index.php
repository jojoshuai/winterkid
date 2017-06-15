<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X_UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="HTML, CSS, XML, XHTML, JavaScript">
    <meta name="description" content="winterkid">
    <meta name="author" content="winterkid">
    <title>index</title>

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body style="padding-top: 50px; background-color: #333">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">winterkid</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">主页</a></li>
                <li><a href="/article">文章</a></li>
                <li><a href="/picture">图片墙</a></li>
                <li class="active"><a href="/message">留言墙</a></li>
                <li><a href="/me">关于我</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="color: #fff; text-align: center; box-shadow: inset 0 0 100px rgba(0,0,0,.5) text-align: center">
    messages: <br>
    <?php
    foreach ($this->messages as $message) {
        echo $message->getUserName() . ' | ' . $message->getContent() . ' | ' . $message->getPublishDate() . '<br>';
    }
    ?>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>