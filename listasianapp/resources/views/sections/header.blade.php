<div class="mob-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="top-row">
                    {{-- Search Partial --}}
                    @include('sites._search')
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
                            <ul>
                                @foreach (Menu::get('MyNavBar')->items as $item)
                                    <li><a href="{{ $item->url }}">{{ $item->title }}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                        <div class="pull-right-block">
                            <div class="log-block">
                                @if (!Auth::guest())
                                    <a href="{{ url('/sites/logout') }}"><button id="login-btn"></button></a>
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
