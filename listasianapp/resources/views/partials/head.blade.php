<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>{{ $pageTitle ?? 'Default Title' }}</title>
<meta name="keywords" content="{{ $seo_keywords ?? 'default keywords' }}">
<meta name="description" content="{{ $seo_description ?? 'default description' }}">
<meta name="author" content="Asian Directory App">
<meta name="viewport" content="width=device-width, initial-scale=1">
        
<!-- Stylesheets -->
<link rel="stylesheet" href="{{ asset('assets/236110bf/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/236110bf/css/bootstrap-yii.css') }}">
<link rel="stylesheet" href="{{ asset('assets/236110bf/css/jquery-ui-bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/236110bf/select2/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/236110bf/select2/select2-bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.treeview.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/media.css') }}">

<!-- Favicon and Touch Icons -->
@foreach ([57, 60, 72, 76, 114, 120, 144, 152, 180] as $size)
    <link rel="apple-touch-icon" sizes="{{ $size }}x{{ $size }}" href="{{ asset('favicon/apple-icon-' . $size . 'x' . $size . '.png') }}">
@endforeach
@foreach (['192', '32', '96', '16'] as $size)
    <link rel="icon" type="image/png" sizes="{{ $size }}x{{ $size }}" href="{{ asset('favicon/favicon-' . $size . 'x' . $size . '.png') }}">
@endforeach
<link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#ffffff">
        
<!-- SEO Scripts -->
<script>
            (function(html){ html.className = html.className.replace(/\bno-js\b/, 'js') })(document.documentElement);
</script>
<meta name="robots" content="noodp"/>
<link rel="canonical" href="https://list.asiandirectoryapp.com/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Download the Best Asian Directory in a Mobile App" />
<meta property="og:description" content="Find great restaurants, nightclubs, wedding suppliers, textile shops, food markets, anything with an Asian flavour, and locate them quickly, all from your smartphone, tablet or PC. This is Britain&#039;s premier app for accessing Asian businesses. There are 2.5 million British Asians – a thriving market for goods and services. It is fantastic for planning your Asian Events, such as weddings, parties, or other social functions. The app has many categories to browse through, including Hair &amp; Beauty, MUA, DJs, Venues, Solicitors, Estate Agents, Driving Schools and a whole host of other useful services." />
<meta property="og:url" content="https://list.asiandirectoryapp.com/" />
<meta property="og:site_name" content="Asian Directory App" />
<meta property="og:image" content="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/ADA-FB-Share_Pic-1.jpg" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="Find great restaurants, nightclubs, wedding suppliers, textile shops, food markets, anything with an Asian flavour, and locate them quickly, all from your smartphone, tablet or PC. This is Britain&#039;s premier app for accessing Asian businesses. There are 2.5 million British Asians – a thriving market for goods and services. It is fantastic for planning your Asian Events, such as weddings, parties, or other social functions. The app has many categories to browse through, including Hair &amp; Beauty, MUA, DJs, Venues, Solicitors, Estate Agents, Driving Schools and a whole host of other useful services." />
<meta name="twitter:title" content="Download the Best Asian Directory in a Mobile App" />
<meta name="twitter:image" content="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/ADA-Tw-Share_Pic-1.jpg" />
<script type='application/ld+json'>
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "@id": "#website",
        "url": "https://list.asiandirectoryapp.com/",
        "name": "Asian Directory App",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://list.asiandirectoryapp.com/?s={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
</script>