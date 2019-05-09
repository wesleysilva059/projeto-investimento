<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Investindo</title>
        @yield('css-view')
		<link rel="stylesheet" href="{{ asset('css/stylesheet.css')}}">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    </head>
    <body>
        @include('templates.menu-lateral')
		
        <section id="view-conteudo">
            @yield('conteudo-view')
		</section>
		
        @yield('js-view')
	</body>
</html>