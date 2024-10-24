<!doctype html>
<html class="no-js" lang="">
<>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $pageTitle ?? 'Default Title' }}</title>
    <meta name="keywords" content="{{ $seo_keywords ?? '' }}">
    <meta name="description" content="{{ $seo_description ?? ''}}">
    <meta name="author" content="Asian Directory App">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    @foreach (range(57, 180, 3) as $size)
        <link rel="apple-touch-icon" sizes="{{ $size }}x{{ $size }}" href="{{ asset('favicon/apple-icon-' . $size . 'x' . $size . '.png') }}">
    @endforeach
    @foreach (['192', '32', '96', '16'] as $size)
        <link rel="icon" type="image/png" sizes="{{ $size }}x{{ $size }}" href="{{ asset("favicon/favicon-{$size}x{$size}.png") }}">
    @endforeach
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    {{-- SEO Metadata --}}
    <script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
    <meta name="robots" content="noodp"/>
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Download the Best Asian Directory in a Mobile App" />
    <meta property="og:description" content="Find great restaurants, nightclubs, wedding suppliers, textile shops, food markets, anything with an Asian flavour, and locate them quickly, all from your smartphone, tablet or PC. This is Britain's premier app for accessing Asian businesses. There are 2.5 million British Asians – a thriving market for goods and services. It is fantastic for planning your Asian Events, such as weddings, parties, or other social functions. The app has many categories to browse through, including Hair &amp; Beauty, MUA, DJs, Venues, Solicitors, Estate Agents, Driving Schools and a whole host of other useful services." />
    <meta property="og:url" content="https://list.asiandirectoryapp.com/" />
    <meta property="og:site_name" content="Asian Directory App" />
    <meta property="og:image" content="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/ADA-FB-Share_Pic-1.jpg" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Find great restaurants, nightclubs, wedding suppliers, textile shops, food markets, anything with an Asian flavour, and locate them quickly, all from your smartphone, tablet or PC. This is Britain's premier app for accessing Asian businesses. There are 2.5 million British Asians – a thriving market for goods and services. It is fantastic for planning your Asian Events, such as weddings, parties, or other social functions. The app has many categories to browse through, including Hair &amp; Beauty, MUA, DJs, Venues, Solicitors, Estate Agents, Driving Schools and a whole host of other useful services." />
    <meta name="twitter:title" content="Download the Best Asian Directory in a Mobile App" />
    <meta name="twitter:image" content="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/ADA-Tw-Share_Pic-1.jpg" />
    <script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"https:\/\/list.asiandirectoryapp.com\/","name":"Asian Directory App","potentialAction":{"@type":"SearchAction","target":"https:\/\/list.asiandirectoryapp.com\/?s={search_term_string}","query-input":"required name=search_term_string"}}</script>
    {{-- END SEO HERE --}}

</head>
<body>

<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '644528465741620');
    fbq('track', 'PageView');
</script>
<noscript>
    <img height="1" width="1"
        src="https://www.facebook.com/tr?id=644528465741620&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<section id="content">

    <header>
        <div class="mob-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-row">
                            {{-- Search Partial --}}
                            @include('/site/_search')

                            <div class="download-group">
                                <div class="download-but">
                                    <a href="https://itunes.apple.com/gb/app/asian-directory-app/id970097110?mt=8" target="_blank" rel="nofollow">
                                        <img src="https://www.asiandirectoryapp.com/wp-content/themes/twentyseventeen-child/assets/images/adatheme1/ios_download.png" width="132" height="49" alt="Download from iTunes">
                                    </a>
                                </div>
                                <div class="download-but">
                                    <a href="https://play.google.com/store/apps/details?id=com.appmarket.asiandirectoryapp" target="_blank" rel="nofollow">
                                        <img src="https://www.asiandirectoryapp.com/wp-content/themes/twentyseventeen-child/assets/images/adatheme1/andr_download.png" width="132" height="49" alt="Download from Google Play">
                                    </a>
                                </div>
                                <div class="download-but">
                                    <a href="https://www.microsoft.com/en-gb/store/p/asian-directory-app/9nblggh4q8gz" target="_blank" rel="nofollow">
                                        <img src="https://www.asiandirectoryapp.com/wp-content/themes/twentyseventeen-child/assets/images/adatheme1/ms_download.png" width="132" height="49" alt="Download from Microsoft">
                                    </a>
                                </div>
                            </div>
                            <div class="menu-log">
                                <nav class="menu-top">
                                    {{-- Menu --}}
                                    {!! Menu::render() !!}
                                </nav>
                                <div class="pull-right-block">
                                    <div class="log-block">
                                        @if (!Auth::guest())
                                            <a href="{{ url('/site/logout') }}"><button id="login-btn"></button></a>
                                        @endif
                                    </div>                        
                                </div>
                            </div>
                            <div class="header-bottom-menu-row-mobile">
                                <ul>
                                    <li><a href="#">Top Categories</a></li>
                                    <li><a href="https://list.asiandirectoryapp.com/c/AAAA001003">What's On</a></li>
                                    <li><a href="https://list.asiandirectoryapp.com/c/ABAA000907">All-Round Builders</a></li>
                                    <li><a href="https://list.asiandirectoryapp.com/c/ABAA001003">Wedding Venues</a></li>
                                    <li><a href="https://list.asiandirectoryapp.com/c/ABAA001022">Asian Jewellery</a></li>
                                    <li><a href="https://list.asiandirectoryapp.com/c/ABAA000305">Asian DJ</a></li>
                                    <li><a href="https://list.asiandirectoryapp.com/c/ABAA000406">Asian Restaurants</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-logo">
                            <img src="https://www.asiandirectoryapp.com/wp-content/themes/twentyseventeen-child/assets/images/adatheme1/logo.png" alt="asiandirectoryapp">
                        </div>
                        <div class="header-bottom-menu-row">
                            <ul>
                                <li><a href="#">Top Categories</a></li>
                                <li><a href="https://list.asiandirectoryapp.com/c/AAAA001003">What's On</a></li>
                                <li><a href="https://list.asiandirectoryapp.com/c/ABAA000907">All-Round Builders</a></li>
                                <li><a href="https://list.asiandirectoryapp.com/c/ABAA001003">Wedding Venues</a></li>
                                <li><a href="https://list.asiandirectoryapp.com/c/ABAA001022">Asian Jewellery</a></li>
                                <li><a href="https://list.asiandirectoryapp.com/c/ABAA000305">Asian DJ</a></li>
                                <li><a href="https://list.asiandirectoryapp.com/c/ABAA000406">Asian Restaurants</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</section>
</body>
</html>

<div class="mob-menu-toggle"><div></div><div></div><div></div></div>

<!-- <section id="top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <article>
                    <div class="top-logo">
                        <img src="{{ asset('images/DKB_contact_ADAlogo.png') }}" alt="Asian Directory App Logo">
                    </div>
                    <h3>Asian Directory App Portal</h3>
                    <h4>Browse more adverts using the FREE Mobile App. Download it by clicking the relevant icon below.</h4>
                </article>
                <div class="app-links">
                    <a rel="nofollow" target="_blank" href="https://play.google.com/store/apps/details?id=com.appmarket.asiandirectoryapp"><img src="{{ asset('images/ADA_back_googleplay.jpg') }}" alt="Google Play link"></a>
                    <a rel="nofollow" target="_blank" href="https://itunes.apple.com/gb/app/asian-directory-app/id970097110?mt=8"><img src="{{ asset('images/ADA_back_appstore.jpg') }}" alt="App Store link"></a>
                    <a rel="nofollow" target="_blank" href="https://www.microsoft.com/en-gb/store/p/asian-directory-app/9nblggh4q8gz"><img src="{{ asset('images/ADA_back_windows.jpg') }}" alt="Windows Phone link"></a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section id="container">
    <div class="container">
        <div class="row">
            {!! $content !!}
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <h2>CONTACT US</h2>
        <div class="row">
            <figure class="col-xs-12 col-sm-3">
                <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/03/bottomicon_01.png" alt="">
                <h4>ADDRESS</h4>
                <figcaption>
                    <span>
                        Office 380,<br>
                        51 Pinfold Street<br>
                        Birmingham<br>
                        B2 4AY<br>
                        United Kingdom
                    </span>
                </figcaption>
            </figure>
            <figure class="col-xs-12 col-sm-3">
                <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/03/bottomicon_02.png" alt="">
                <h4>PHONE</h4>
                <figcaption>
                    <span>Call our friendly team</span>

                    <!-- /* <span>Sales: <a href="tel:01212702704471">0121 270 4471</a></span><br>
                    <span>Support: <a href="tel:01212702704471">0121 270 4472</a></span> */ -->
                </figcaption>
            </figure>
            <figure class="col-xs-12 col-sm-3">
                <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/03/bottomicon_03.png" alt="">
                <h4>E-mail</h4>
                <figcaption>
                    <span>
                        <a href="mailto:info@asiandirectoryapp.com">info@asiandirectoryapp.com</a>
                    </span>
                </figcaption>
            </figure>
            <figure class="col-xs-12 col-sm-3">
                <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/03/bottomicon_04.png" alt="">
                <h4>WORKING HOURS</h4>
                <figcaption>
                    <span>Monday-Friday: 9:00-18:00</span><br>
                    <span>Saturday: 09:00-13:00</span><br>
                    <span>Sunday: closed</span>
                </figcaption>
            </figure>
        </div>
        <form action="/" class="footer-form" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3"><input name="name" type="text" placeholder="Name *" required></div>
                <div class="col-md-3"><input name="email" type="email" placeholder="Email *" required></div>
                <div class="col-md-3"><input name="phone" type="tel" placeholder="Phone *" required></div>
                <div class="col-md-3"><input name="website" type="text" placeholder="Website"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="message" placeholder="Message *"></textarea>
                    <input type="submit" value="send">
                </div>
            </div>
        </form>
        <div class="footer-bottom">
            <div class="footer-socials">
                <ul>
                    <li id="menu-item-60" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-60"><a target="_blank" rel="nofollow" href="https://twitter.com/asiandirectory1"><span class="screen-reader-text">twitter</span><svg class="icon icon-twitter" aria-hidden="true" role="img"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use> </svg></a></li>
                    <li id="menu-item-41" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-41"><a target="_blank" rel="nofollow" href="https://www.facebook.com/AsianDirectoryApp"><span class="screen-reader-text">face</span><svg class="icon icon-facebook" aria-hidden="true" role="img"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use> </svg></a></li>
                    <li id="menu-item-59" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-59"><a target="_blank" rel="nofollow" href="https://plus.google.com/102755162900601638322"><span class="screen-reader-text">google+</span><svg class="icon icon-google-plus" aria-hidden="true" role="img"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-google-plus"></use> </svg></a></li>
                    <li id="menu-item-61" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-61"><a target="_blank" rel="nofollow" href="https://uk.pinterest.com/AsianDirectory/"><span class="screen-reader-text">pinterest</span><svg class="icon icon-pinterest-p" aria-hidden="true" role="img"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-pinterest-p"></use> </svg></a></li>
                    <li id="menu-item-66" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-66"><a target="_blank" rel="nofollow" href="https://www.linkedin.com/in/tony-singh-81552ab6/"><span class="screen-reader-text">in</span><svg class="icon icon-linkedin" aria-hidden="true" role="img"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-linkedin"></use> </svg></a></li>
                </ul>
            </div>
            <div class="footer-menu">
                <a href="https://www.asiandirectoryapp.com/about/">About Us</a>
                <a href="https://www.asiandirectoryapp.com/download/">Download</a>
                <a href="https://www.asiandirectoryapp.com/contact/">Contact Us</a>
                <a href="https://www.asiandirectoryapp.com/privacy-policy/">Privacy Policy</a>
            </div>          
            <div class="copyright">
                <span style="color:#949292">2016 - </span>{{ date('Y') }} &copy; <span style="color:#555">AsianDirectoryApp | Website by <a href="https://www.cloudzion.com/" target="_blank">www.cloudzion.com</a> | Hosted On <a href="https://www.speedzion.net/" target="_blank">www.speedzion.net</a></span>
            </div>
            <a href="#" id="back-to-top" title="Back to top"><b><i class="fa fa-arrow-up" aria-hidden="true"></i><span>Back to top</span></b></a>
        </div>
    </div>
</footer>

<svg style="position: absolute; width: 0; height: 0; overflow: hidden; display:none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <symbol id="icon-twitter" viewBox="0 0 30 32">
            <title>twitter</title>
            <path d="M29.5 6.6c-1.1.5-2.2.8-3.4.9 1.2-.7 2.1-1.9 2.6-3.3-1.1.7-2.3 1.2-3.6 1.5-.9-1-2.1-1.6-3.5-1.6-2.6 0-4.7 2.1-4.7 4.7 0 .4 0 .7.1 1-3.9-.2-7.4-2.1-9.7-5.1-.4.7-.6 1.5-.6 2.3 0 1.6.8 3 2 3.8-1.3 0-2.5-.4-3.5-1.1v.1c0 2.3 1.6 4.2 3.7 4.6-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 2 2.4 3.5 4.5 3.5-1.7 1.3-3.8 2.1-6.1 2.1-.4 0-.8 0-1.2-.1 2.2 1.4 4.9 2.2 7.7 2.2 9.2 0 14.2-7.6 14.2-14.2 0-.2 0-.3 0-.5 1-1.3 1.9-2.9 2.6-4.5z"></path>
        </symbol>
        <symbol id="icon-facebook" viewBox="0 0 30 32">
            <title>facebook</title>
            <path d="M18.5 32V17h6.7l1-7h-7.7V7c0-1.9.5-3.2 3.2-3.2H30V0h-5.8C16.7 0 13 3.5 13 10.1v6.9H6v7h7v15h5.5z"></path>
        </symbol>
        <symbol id="icon-google-plus" viewBox="0 0 30 32">
            <title>google-plus</title>
            <path d="M15 0C6.7 0 0 6.7 0 15s6.7 15 15 15c8.3 0 15-6.7 15-15S23.3 0 15 0zm6.1 17.1h-6.1v5.7h-4.9v-5.7H10v-4.7h6.1v-4.1c0-6 2.6-9.3 9.2-9.3h3.3v4.8h-2c-1.8 0-2.1 1.4-2.1 2.1v2.4h6.1l-1 4.7z"></path>
        </symbol>
        <symbol id="icon-pinterest-p" viewBox="0 0 30 32">
            <title>pinterest-p</title>
            <path d="M15 0C6.7 0 0 6.7 0 15c0 7.1 4.7 13.1 11 15.2-.2-.6-.4-1.5-.4-2.2 0-2.1 1.1-4.4 2.4-5.2 0 0 .1-.1.2-.1-.1-.2-.2-.4-.2-.6 0-.3 0-.5.1-.7 1-1.7 2.4-2.5 3.5-2.5 2.2 0 3.5 1.8 3.5 4 0 1.6-.6 3.1-2 3.8-.3.2-.5.4-.7.4-.1 0-.2-.1-.3-.1-1.2-.2-1.9-.7-1.9-1.8 0-.8.6-1.7 1.6-1.7.5 0 .9.3.9.8 0 .5-.4 1.3-1.2 1.3-.6 0-1.3-.5-1.3-1.1 0-.5.4-1.2 1-1.2.4 0 .8.3.8.7 0 .3-.2.9-.9.9-1 0-1.8-.5-1.8-1.7 0-1 1.1-2.4 2.8-2.4 1.3 0 2.4.6 2.4 2 0 1.2-.8 1.9-1.8 2.3-.1.1-.1.2-.2.2-.2-.4-.2-.7-.2-1.1 0-2.5 2.6-3.9 5.4-3.9 3 0 5.6 2.5 5.6 5.7 0 2.9-1.5 5.6-4.2 7.1C20.1 29.5 12.6 32 15 32c8.3 0 15-6.7 15-15C30 6.7 23.3 0 15 0z"></path>
        </symbol>
        <symbol id="icon-linkedin" viewBox="0 0 30 32">
            <title>linkedin</title>
            <path d="M29 0H1C.4 0 0 .4 0 1v28c0 .6.4 1 1 1h28c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1zm-20 27h-4v-14h4v14zm-2-16.2c-1.3 0-2.2-.9-2.2-2 0-1.2.9-2.1 2.2-2.1 1.3 0 2.1.9 2.2 2.1 0 1.1-.9 2-2.2 2zm20 16.2h-4v-7.1c0-1.7-.6-2.9-2.1-2.9-1.1 0-1.8.7-2.1 1.3-.1.3-.1.7-.1 1.1v7.6h-4v-14h4v2.1c1-.2 2.3-.9 3.6-2.1 2.6-2.4 5.1-3.4 7.6-3.4 2.4 0 4.4.9 4.4 4.5v13.8z"></path>
        </symbol>
    </defs>
</svg>
