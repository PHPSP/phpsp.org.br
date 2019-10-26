<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="canonical" href="{{ $page->canonicalHref ?? $page->getUrl() }}" />
    <!--Meta tags do Facebook / Open Graph -->
    <meta property="fb:admins" content="id do seu fb insight">
    <meta property="og:url" content="url do seu site">
    <meta property="og:type" content="tipo do link, article, page, etc">
    <meta property="og:title" content="título do site">
    <meta property="og:image" content="imagem do site (LINK ABSOLUTO)">
    <meta property="og:deion" content="breve descrição">
    <meta property="og:site_name" content="Nome do site">
    <meta property="article:author" content="fb de quem escreveu">
    <meta property="article:publisher" content="fb de quem publicou">
    <meta property="article:published_time" content="momento de publicação">
    <meta property="article:tag" content="tag1">
    <meta property="article:tag" content="tag2">

    <!-- Meta tags do Twitter -->
    <meta name="twitter:card" content="summary_large_image"> <!-- aqui fica o tipo de card -->
    <meta name="twitter:site" content="@willian_justen"> <!-- twitter handler do site -->
    <meta name="twitter:title" content="Título do Post">
    <meta name="twitter:description" content="Descrição do post">
    <meta property="twitter:image:src" content="link da imagem">

    <title>PHPSP | {{$page->title}}</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $page->google_analytics->id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', '{{ $page->google_analytics->id }}');
    </script>

    <link rel="shortcut icon" href="{{ $page->asset_prefix }}/assets/images/phpsp/favicon.ico"/>
    <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
    <script defer src="{{ mix('js/main.js', 'assets/build') }}"></script>
</head>