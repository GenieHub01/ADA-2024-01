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