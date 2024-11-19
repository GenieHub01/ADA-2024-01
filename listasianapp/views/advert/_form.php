<div class="row">
    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'advert-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
        'clientOptions' => [
            'validateOnSubmit' => true
        ]
    ));

    echo $form->hiddenField($model, 'previewFile');
    ?>

    <div class="col-md-12">
        <?php
        if ($model->image) {
            echo '<div class="form-group">';
            echo CHtml::image($model->image);
            echo '</div>';
        }
        ?>
        <div class="row">
            <div class="col-md-5">
                <?php
                echo $form->textFieldGroup($model, 'country', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'id' => 'Advert_country',
                            'placeholder' => 'Enter country',
                            'onchange' => 'fetchCountryData(this.value)'
                        ]
                    ]
                ]);

                echo $form->textFieldGroup($model, 'region', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'id' => 'Advert_region',
                            'placeholder' => 'Enter region',
                            'onchange' => 'fetchRegionData(this.value, document.getElementById("Advert_country_id").value)'
                        ]
                    ]
                ]);

                echo $form->textFieldGroup($model, 'city_name', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'id' => 'Advert_city_name',
                            'placeholder' => 'Enter city',
                            'onchange' => 'fetchCityData(this.value, document.getElementById("Advert_region_id").value)'
                        ]
                    ]
                ]);

                echo $form->hiddenField($model, 'country_id', ['id' => 'Advert_country_id']);
                echo $form->hiddenField($model, 'region_id', ['id' => 'Advert_region_id']);
                echo $form->hiddenField($model, 'city_id', ['id' => 'Advert_city_id']);

                ?>
                <div id="suggestions" style="display: none; border: 1px solid #ccc; max-height: 150px; overflow-y: auto;"></div>

                <button class="btn btn-default geo-btn" id="bGeo" name="yt1" type="button">GEO</button>

                <?php
                echo $form->select2Group($model, 'category_id', [
                    'wrapperHtmlOptions' => [
            
                    ],
                    'widgetOptions' => [
                        'data' => CHtml::listData(Category::model()->getCategorys(), 'id', 'name'),
                        'htmlOptions' => [
                            'empty' => '',
                            'ajax' => [
                                'type'=>'POST',
                                'url'=>['category/list'],
                                'success'=>'function(data) {
                                    $("#Advert_categoryList").html(data).select2();
                                }'
                            ],
                        ]
                    ]
                ]);
            
                echo $form->select2Group($model, 'categoryList', [
                    'wrapperHtmlOptions' => [
            
                    ],
                    'widgetOptions' => [
                        'data' => CHtml::listData(Category::model()->getCategorys($model->category_id), 'id', 'name'),
                        'htmlOptions' => [
                            'multiple'=>'multiple'
                        ]
                    ]
                ]);

                echo $form->textFieldGroup($model, 'name');
                echo $form->textFieldGroup($model, 'address', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'id' => 'Advert_address',
                            'placeholder' => 'Enter address',
                            'onchange' => 'fetchCoordinates()'
                        ]
                    ]
                ]);                
                echo $form->textFieldGroup($model, 'postcode', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'id' => 'Advert_postcode',
                            'placeholder' => 'Enter postcode'
                        ]
                    ]
                ]);
                echo $form->textFieldGroup($model, 'telephone');
                echo $form->textFieldGroup($model, 'fax');
                ?>

            <div class="adv-toggle">&#x25BC; Advanced &#x25BC;</div>
            
            </div>

            <div class="col-md-5">
                <?php
                echo $form->fileFieldGroup($model, 'file');
                echo $form->textFieldGroup($model, 'web');
                echo $form->emailFieldGroup($model, 'email');
                echo $form->hiddenField($model, 'lat');
                echo $form->hiddenField($model, 'lng');

                echo $form->textAreaGroup($model, 'description', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'rows' => 6
                        ]
                    ]
                ]);
                echo $form->textFieldGroup($model, 'manager_name');
                echo $form->textFieldGroup($model, 'mobile');

                if ($model->isNewRecord || Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
                    echo $form->dropDownListGroup($model, 'package', [
                        'widgetOptions' => array(
                            'data' => Price::model()->getList(),
                            'htmlOptions' => [
                            ],
                        )
                    ]);
                }
                ?>
            </div>
        </div>
    </div>
    <div class="adv-advanced">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                <?php
                    echo $form->textFieldGroup($model, 'facebook_url');
                    echo $form->textFieldGroup($model, 'twitter_url');
                    echo $form->textFieldGroup($model, 'instagram_url');
                    echo $form->textFieldGroup($model, 'gplus_url');
                    echo $form->textFieldGroup($model, 'youtube_url');
                    echo $form->textFieldGroup($model, 'pinterest_url');
                ?>
            </div>
            <div class="col-md-5">
                <?php
                    echo $form->textFieldGroup($model, 'seo_keywords');
                    echo $form->textAreaGroup($model, 'seo_description');
                    if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {

                        echo $form->select2Group($model, 'user_id', [
                            'widgetOptions' => array(
                                'data' => User::model()->getList(),
                                'htmlOptions' => [
                                ],
                            )
                        ]);

                        echo $form->datePickerGroup($model, 'expiry_date', [
                            'widgetOptions' => array(
                                'options' => [
                                    'language' => Yii::app()->language,
                                    'format'=>'yyyy-mm-dd',
                                    'autoclose' => true
                                ],
                                'htmlOptions' => [
                                    'readonly' =>true,
                                ],
                            )
                        ]);

                        echo $form->textFieldGroup($model, 'rating');
                        echo $form->checkboxGroup($model, 'active');
                        echo $form->checkboxGroup($model, 'paid');
                    }
				?>
            </div>
        </div>
	</div>
</div>

<div class="col-md-12 create-save">
    <label for="advert-form_save" class="create-advert-save">
        <?= CHtml::submitButton('Save', ['id' => 'advert-form_save']); ?>
    </label>
</div>

<?php $this->endWidget(); ?>

<script>
    function fetchSuggestions(type) {
        const input = document.getElementById(type).value;
        const suggestionsDiv = document.getElementById('suggestions');
        if (input.length < 3) return;

        fetch(`/api/getSuggestions?type=${type}&query=${input}`)
            .then(response => response.json())
            .then(data => {
                suggestionsDiv.innerHTML = '';
                data.forEach(item => {
                    const option = document.createElement('div');
                    option.textContent = item.display_name;
                    option.onclick = () => {
                        document.getElementById(type).value = item.display_name;
                        suggestionsDiv.style.display = 'none';
                    };
                    suggestionsDiv.appendChild(option);
                });
                suggestionsDiv.style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
    }

    function fetchCoordinates() {
    const address = document.getElementById("Advert_address").value;
        const city = document.getElementById("Advert_city_name").value;
        const region = document.getElementById("Advert_region").value;
        const postcode = document.getElementById("Advert_postcode").value;
        const country = document.getElementById("Advert_country").value;

        if (!address || !city || !country) {
            console.error("Address, city, and country fields are required for accurate geocoding.");
            return;
        }

        const fullAddress = `${address}, ${city}, ${region}, ${postcode}, ${country}`;
        const apiKey = <?= CJavaScript::encode(Yii::app()->params['locationiq.api_key']); ?>;
        const apiUrl = `https://us1.locationiq.com/v1/search.php?key=${apiKey}&q=${encodeURIComponent(fullAddress)}&format=json&limit=1`;

        console.log("Fetching coordinates for full address:", fullAddress);

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                console.log("LocationIQ response data:", data);

                if (data && data.length > 0) {
                    const lat = data[0].lat;
                    const lng = data[0].lon;
                    document.getElementById("Advert_lat").value = lat;
                    document.getElementById("Advert_lng").value = lng;
                    console.log("Coordinates set to:", lat, lng);
                } else {
                    console.error("Address not found or no data returned");
                }
            })
            .catch(error => console.error("Error fetching coordinates:", error));
    }

    function fetchCountryData(countryName) {
        fetch(`/api/getCountryData?name=${countryName}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById("Advert_country").value = data.code;
                    console.log("Country set to:", data.code);
                } else {
                    console.log("Country data not found for:", countryName);
                }
            })
            .catch(error => console.error('Error fetching country data:', error));
    }

    function fetchRegionData(regionName, countryId) {
        fetch(`/api/getRegionData?name=${regionName}&countryId=${countryId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById("Advert_region_id").value = data.region_id;
                    document.getElementById("Advert_region").value = data.region_code;
                }
            });
    }

    function fetchCityData(cityName, regionId) {
        fetch(`/api/getCityData?name=${cityName}&regionId=${regionId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById("Advert_city_id").value = data.city_id;
                    document.getElementById("Advert_city_name").value = data.city_name;
                }
            });
    }

    $(function () {
        $('#bGeo').click(function () {
            getLocation();
        });
    });
</script>
