<?php
/* @var $this AdvertController */
/* @var $model Advert */

$this->breadcrumbs=array(
    //'Adverts'=>array('index'),
    $model->name,
);

$this->seo_keywords = $model->getSeoKeywords();
$this->seo_description = $model->getSeoDescription();
?>

</div>
</div>

<?php if ($model->paid): ?>

<div class="advert-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about-nav">
                    <?= ($prev = $model->prev) ? $prev->getSeoLink('< Prev') : '' ?>
                    <?= ($next = $model->next) ? $next->getSeoLink('Next >') : '' ?>
                </div>
                <h1><?= CHtml::encode($model->name) ?></h1>
                <a class="back-to-directory" href="/"><i class="fa fa-chevron-left"></i> Back to Directory</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (Yii::app()->user->hasFlash('success')): ?>
                <h4>
                    <?= Yii::app()->user->getFlash('success');?>
                </h4>
            <?php endif; ?>
            <h2 class="subcategory">
                <?= Chtml::link('<i class="fa fa-chevron-left"></i>' . $model->getSeoCategory(), ['category/index', 'code' => isset($model->categorys[0]) ? $model->categorys[0]->getUrl() : '']); ?>
            </h2>
        </div>
    <div class="col-md-6 about-content">

        <article class="about-description">
            <?= nl2br(CHtml::encode($model->description)); ?>
        </article>
</div>

<div class="col-md-6 about-content">
    <div class="about-img"><?= CHtml::image($model->image, $model->name, ['title' => $model->name]); ?></div>
    <div class="about-address-row">
        <!-- <div class="about-address"><?= CHtml::encode($model->address) ?></div> -->
    </div>

    <div class="about-contacts">
        <p><span class="about-site"><?= CHtml::link($model->web, $model->web, ['rel' => 'nofollow', 'target' => '_blank']) ?></span></p>
        <p><span class="about-phone"><?= CHtml::link($model->telephone, 'tel:'.$model->telephone, ['rel' => 'nofollow']) ?></span></p>
        <p><span class="about-email"><?= CHtml::mailto($model->email, $model->email, ['rel' => 'nofollow']) ?></span></p>
    </div>

    <div class="about-socials">
        <a rel="nofollow" target="_blank" class="about-fb" <?= !empty($model->facebook_url) ? 'href=' . $model->facebook_url : '' ?>></a>
        <a rel="nofollow" target="_blank" class="about-tw" <?= !empty($model->twitter_url) ? 'href=' . $model->twitter_url : '' ?>></a>
        <a rel="nofollow" target="_blank" class="about-pi" <?= !empty($model->pinterest_url) ? 'href=' . $model->pinterest_url : '' ?>></a>
        <a rel="nofollow" target="_blank" class="about-li" <?= !empty($model->instagram_url) ? 'href=' . $model->instagram_url : '' ?>></a>
        <a rel="nofollow" target="_blank" class="about-gp" <?= !empty($model->gplus_url) ? 'href=' . $model->gplus_url : '' ?>></a>
        <a rel="nofollow" target="_blank" class="about-yt" <?= !empty($model->youtube_url) ? 'href=' . $model->youtube_url : '' ?>></a>
    </div>
</div>

<div class="col-md-12">
    <div class="about-map-address"><?= CHtml::encode($model->address) ?>, <?= CHtml::encode($model->postcode) ?></div>
    <div id="map"></div>
</div>

<!-- Leaflet JS dan CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    function initMap() {
        console.log("Initializing map...");

        var map = L.map('map').setView([0, 0], 15);
        console.log("Map initialized with default coordinates (0,0)");

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var marker = L.marker([0, 0]).addTo(map);
        console.log("Marker initialized at default coordinates (0,0)");

        function updateMap(lat, lng, address = null) {
            if (lat && lng) {
                const location = [parseFloat(lat), parseFloat(lng)];
                map.setView(location, 15);
                marker.setLatLng(location);
                console.log('Map updated directly to lat/lng:', lat, lng);
            } else if (address) {
                console.log(`Attempting to update map for address: ${address}`);

                const countryElement = document.getElementById("Advert_country");
                const country = countryElement ? countryElement.value : '';
                if (!country) {
                    console.error("Country field is empty.");
                    return;
                }

                const apiKey = "<?= Yii::app()->params['locationiq.api_key']; ?>";
                const url = `https://us1.locationiq.com/v1/search.php?key=${apiKey}&q=${encodeURIComponent(address)}&countrycodes=${country}&format=json`;
                console.log("Fetching location data from LocationIQ with URL:", url);

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            const location = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                            map.setView(location, 15);
                            marker.setLatLng(location);
                            console.log('Map updated to address location:', location[0], location[1]);
                        } else {
                            console.error('Location not found for the given address.');
                        }
                    })
                    .catch(error => console.error('Error fetching location data from LocationIQ:', error));
            } else {
                console.error("No valid location data available to update map.");
            }
        }

        const lat = "<?= $model->lat ?>";
        const lng = "<?= $model->lng ?>";
        const address = "<?= CHtml::encode($model->address) ?>";
        console.log("Lat, Lng from PHP:", lat, lng);

        updateMap(lat, lng, address);
    }

    window.onload = initMap;
</script>

<?php else: ?>

    <?php $this->redirect(['advert/pay', 'id' => $model->id]); ?>

<?php endif; ?>

<!-- Facebook Pixel Code -->
<script>
    fbq('track', 'ViewContent', {
        content_name: "<?= $model->name; ?>",
        content_category: '<?= $model->getSeoCategory(); ?>',
        content_ids: ['<?= $model->id; ?>'],
        content_type: 'ADA-Advert',
        value: 0.00,
        currency: 'GBP',
    });

    function tracker(id) {
        var o = {
            site: 'Website',
            phone: 'Phone',
            email: 'Email',
            fb: 'Facebook',
            tw: 'Twitter',
            pi: 'Pinterest',
            li: 'Linkedin',
            gp: 'Google+',
            yt: 'Youtube'
        };

        fbq('trackCustom', 'Click-' + o[id], {
            content_name: "<?= $model->name; ?>",
            content_category: '<?= $model->getSeoCategory(); ?>',
            content_ids: ['<?= $model->id; ?>'],
            content_type: 'ADA-Advert',
            value: 0.00,
            currency: 'GBP',
        });

        ga('send', {
            hitType: 'event',
            eventCategory: '<?= $model->getSeoCategory(); ?>',
            eventAction: "<?= $model->name; ?>",
            eventLabel: 'Click-' + o[id]
        });
    }

</script>
<!-- End Facebook Pixel Code -->

<?php

$js = <<<EOD
$('.about-contacts span, .about-socials a').click(function() {
    tracker($(this).attr('class').split('-')[1]);
});
EOD;

Yii::app()->clientScript->registerScript('pixel', $js);
