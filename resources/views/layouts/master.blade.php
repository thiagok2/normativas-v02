<!DOCTYPE html>
<html>
    <head>

    
        <title>Normativas v0.1(alpha)</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">

        
        <link href="/css/bootstrap.min.css" rel="stylesheet">

        <link href="/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css"/>
        <link href="/css/theme.min.css" media="all" rel="stylesheet" type="text/css"/>

        <link href="/css/app.css" media="all" rel="stylesheet" type="text/css"/>

        
        <script src="/js/jquery-1.12.0.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>        
        <script src="/js/star-rating.min.js" type="text/javascript"></script>
        <script src="/js/theme.min.js"></script>
        <script src="/js/normativas.js" type="text/javascript"></script>
        
       
       
    </head>

    <body>
        @yield('content')
    </body>

    <script>
    $(document).on('ready', function () {

        $('.kv-fa').rating({
            theme: 'krajee-fa',
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star-o"></i>'
        });
    });
</script>
</html>
