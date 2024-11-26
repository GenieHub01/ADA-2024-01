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

<!-- Mapbox GL JS CSS -->
<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">

<!-- Mapbox GL JS JavaScript -->
<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>

<script>
    function initMap() {
        console.log("Initializing map...");

        // API Key Mapbox
        const apiKey = "<?= Yii::app()->params['mapbox.api_key']; ?>";

        mapboxgl.accessToken = apiKey;

        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [0, 0],
            zoom: 15,
        });
        console.log("Map initialized with default coordinates (0,0)");

        // Marker
        const marker = new mapboxgl.Marker()
            .setLngLat([0, 0])
            .addTo(map);
        console.log("Marker initialized at default coordinates (0,0)");

        function updateMap(lat, lng, address = null) {
            if (lat && lng) {
                const location = [parseFloat(lng), parseFloat(lat)];
                map.setCenter(location);
                marker.setLngLat(location);
                console.log('Map updated directly to lat/lng:', lat, lng);
            } else if (address) {
                console.log(`Attempting to update map for address: ${address}`);

                const countryElement = document.getElementById("Advert_country");
                const country = countryElement ? countryElement.value : '';
                if (!country) {
                    console.error("Country field is empty.");
                    return;
                }

                const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(address)}.json?access_token=${apiKey}&limit=1&country=${country}`;
                console.log("Fetching location data from Mapbox Geocoding API with URL:", url);

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.features && data.features.length > 0) {
                            const coordinates = data.features[0].center;
                            map.setCenter(coordinates);
                            marker.setLngLat(coordinates);
                            console.log('Map updated to address location:', coordinates[1], coordinates[0]);
                        } else {
                            console.error('Location not found for the given address.');
                        }
                    })
                    .catch(error => console.error('Error fetching location data from Mapbox:', error));
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
