<!doctype html>
<html class="no-js" lang="en">
    <head>
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

        @stack('scripts') <!--Allows adding extra stylesheets in child templates -->
    </head>
    <body>
        {{-- Facebook Pixel Code --}}
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
                <img height="1" width="1" src="https://www.facebook.com/tr?id=644528465741620&ev=PageView&noscript=1"/>
            </noscript>
        {{-- End Facebook Pixel Code --}}
    
        <section id="content">
            <header>
                @include('sections.header')
            </header>

            <div class="mob-menu-toggle"><div></div><div></div><div></div></div>

            <!-- Main Content Section -->
            <section id="container">
                <div class="container">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </section>
        </section>

        <footer>
            @include('sections.footer')
        </footer>

        @include('partials.icon')

        <script type="application/javascript">
            (function(b,o,n,g,s,r,c){if(b[s])return;b[s]={};b[s].scriptToken="XzE4NjYxMDE4NDQ";b[s].callsQueue=[];b[s].api=function(){b[s].callsQueue.push(arguments);};r=o.createElement(n);c=o.getElementsByTagName(n)[0];r.async=1;r.src=g;r.id=s+n;c.parentNode.insertBefore(r,c);})(window,document,"script","https://cdn.oribi.io/XzE4NjYxMDE4NDQ/oribi.js","ORIBI");
        </script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-60280481-1', 'auto');
            ga('send', 'pageview');
        </script>
        <script type="text/javascript">
            adroll_adv_id = "OIJ5NEBLUJH2JCBNQDMU42";
            adroll_pix_id = "W672VBJBHZBHZPS6676VFX";
            /* OPTIONAL: provide email to improve user identification */
            /* adroll_email = "username@example.com"; */
            (function () {
                var _onload = function(){
                    if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
                    if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
                    var scr = document.createElement("script");
                    var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
                    scr.setAttribute('async', 'true');
                    scr.type = "text/javascript";
                    scr.src = host + "/j/roundtrip.js";
                    ((document.getElementsByTagName('head') || [null])[0] ||
                    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
                };
                if (window.addEventListener) {window.addEventListener('load', _onload, false);}
                else {window.attachEvent('onload', _onload)}
            }());
        </script>
        <!-- Start Alexa Certify Javascript -->
        <script type="text/javascript">
            _atrk_opts = { atrk_acct:"LWDuk1acBb00Gx", domain:"asiandirectoryapp.com",dynamic: true};
            (function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
        </script>
        <noscript>
            <img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=LWDuk1acBb00Gx" style="display:none" height="1" width="1" alt="" />
        </noscript>
        <!-- End Alexa Certify Javascript -->
    </body>
</html>
