<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><? echo $title ?></title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/styles/styles.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">NEWSITE</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Главная страница <span class="sr-only">(current)</span></a></li>
                    <li><a href="/about">О нас</a></li>
                    <li><a href="/contacts">Контакты</a></li>
                    <li><a href="/<?= ADMIN_URL ?>/page">Панель администратора</a></li>

                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Поиск">
                    </div>
                    <button type="submit" class="btn btn-warning">Искать</button>
                </form>
                <aside class="nav navbar-nav userInfo ">
                    <p><a href="#">Пользователь <?=$active_user['name'];?></a></p>
                    <p><a href="#">Права <?=$active_user['role'];?> </a></p>
                </aside>
                <ul class="nav navbar-nav navbar-right ">
                    <li><a href="/auth/logout">Выход</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php echo $left ?>
    <?php echo $content ?>
    <footer>
        <div class="row">
            <div class="col-lg-12">

                <ul class="list-unstyled">
                    <li class="pull-right"><a href="#top">Back to top</a></li>
                    <li><a href="http://news.bootswatch.com"
                           onclick="pageTracker._link(this.href); return false;">Blog</a></li>
                    <li><a href="http://feeds.feedburner.com/bootswatch">RSS</a></li>
                    <li><a href="https://twitter.com/bootswatch">Twitter</a></li>
                    <li><a href="https://github.com/thomaspark/bootswatch/">GitHub</a></li>
                    <li><a href="../help/#api">API</a></li>
                    <li><a href="../help/#support">Support</a></li>
                </ul>

                <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT
                        License</a>.</p>

                <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a
                        href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts
                    from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

            </div>
        </div>

    </footer>

</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<? if (isset ($scripts)) {
    foreach($scripts as $script): ?>
        <script src="/js/<?=$script?>.js"></script>
    <? endforeach;
} ?>
</body>
</html>