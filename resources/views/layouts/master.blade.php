<!DOCTYPE html>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130860561-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-130860561-1');
        </script>


        <title>Portal Atos Normativas</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">

        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css"/>
        <link href="/css/theme.min.css" media="all" rel="stylesheet" type="text/css"/>
        <link href="/css/app-search.css" media="all" rel="stylesheet" type="text/css"/>

        <link href="/img/favicon.ico" rel="shortcut icon">

    </head>

     <body>
        <div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
            <ul id="menu-barra-temp" style="list-style:none;">
                <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
                    <a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
                </li>
                <li>
                <a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
                </li>
            </ul>
        </div>
        <div id="content">
            @yield('content')
        </div>

        <!-- app  scripts -->
        <script src="/js/jquery.min.js" type="text/javascript"></script>
        <script src="/js/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/star-rating.min.js" type="text/javascript"></script>
        <script src="/js/theme.min.js"></script>
        <script src="/js/normativas-search.js" type="text/javascript"></script>

        <script>
            $(document).on('ready', function () {

                $('.kv-fa').rating({
                    theme: 'krajee-fa',
                    filledStar: '<i class="fa fa-star"></i>',
                    emptyStar: '<i class="fa fa-star-o"></i>'
                });
            });
        </script>
        <script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>
        <!-- fim app  scripts -->

        <footer>
            <div class="container">
                <div class="col-lg-12">
                <img src="/img/logo-nees-branca.png" srcset="/img/logo-nees-branca@2x.png 2x" alt="NEES" />
                    <img src="/img/logo-gov.png" srcset="/img/logo-gov@2x.png 2x" alt="Governo Federal" />
                </div>
            </div>
        </footer>


    </body>
</html>
