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
                    // Country Dropdown (Static)
                    echo $form->dropDownListGroup($model, 'country', [
                        'widgetOptions' => [
                            'data' => ['United Kingdom' => 'United Kingdom'],
                            'htmlOptions' => [
                                'id' => 'Advert_country',
                                'disabled' => false,
                            ],
                        ],
                    ]);
                
                    // Region Dropdown
                    echo $form->dropDownListGroup($model, 'region', [
                        'widgetOptions' => [
                            'data' => [],
                            'htmlOptions' => [
                                'id' => 'Advert_region',
                                'prompt' => 'Select Region',
                                'onchange' => 'setRegionId()', // Dynamically update region
                            ],
                        ],
                    ]);
                
                    // City Dropdown
                    echo $form->dropDownListGroup($model, 'city_name', [
                        'widgetOptions' => [
                            'data' => [],
                            'htmlOptions' => [
                                'id' => 'Advert_city_name',
                                'prompt' => 'Select City',
                            ],
                        ],
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
</div>

<div class="col-md-12 create-save">
    <label for="advert-form_save" class="create-advert-save">
        <?= CHtml::submitButton('Save', ['id' => 'advert-form_save']); ?>
    </label>
</div>

<?php $this->endWidget(); ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setCountryId();
        fetchRegionsForUK();

        document.getElementById("Advert_region").addEventListener("change", setRegionId);
        document.getElementById("Advert_city_name").addEventListener("change", setCityId);
    });

    function setCountryId() {
        const countryName = "United Kingdom";
        const countryId = 2635167;
        document.getElementById("Advert_country_id").value = countryId;
        console.log("Country ID set to:", countryId);
    }

    function setRegionId() {
        const regionDropdown = document.getElementById("Advert_region");
        const selectedRegionName = regionDropdown.options[regionDropdown.selectedIndex]?.text || "";
        const countryId = document.getElementById("Advert_country_id").value;

        console.log("Selected Region:", selectedRegionName, "Country ID:", countryId);
        
        if (!selectedRegionName || !countryId) {
            console.warn("Region or Country ID missing.");
            document.getElementById("Advert_region_id").value = "";
            return;
        }

        fetch(`/geo/regions?countryId=${countryId}`)
            .then(response => response.json())
            .then(data => {
                if (data.length) {
                    const selectedRegion = data.find(region => region.name === selectedRegionName);
                    if (selectedRegion) {
                        document.getElementById("Advert_region_id").value = selectedRegion.id;
                        console.log("Region ID set to:", selectedRegion.id);
                        fetchCities(selectedRegion.id);
                    } else {
                        console.error("Selected region not found:", selectedRegionName);
                    }
                }
            })
            .catch(error => console.error("Error fetching regions:", error));
    }

    function setCityId() {
        const cityDropdown = document.getElementById("Advert_city_name");
        const selectedCityId = cityDropdown.value;
        document.getElementById("Advert_city_id").value = selectedCityId;
        console.log("City ID set to:", selectedCityId);
    }

    function fetchCoordinates() {
        const addressInput = document.getElementById("Advert_address");
        const cityInput = document.getElementById("Advert_city_name");
        const regionInput = document.getElementById("Advert_region");
        const countryInput = document.getElementById("Advert_country");

        if (!addressInput || !cityInput || !regionInput || !countryInput) {
            console.error("One or more required elements (address, city, region, country) are missing.");
            return;
        }

        const address = addressInput.value || "";
        const city = cityInput.options[cityInput.selectedIndex]?.text || "";
        const region = regionInput.options[regionInput.selectedIndex]?.text || "";
        const country = countryInput.options[countryInput.selectedIndex]?.text || "United Kingdom";

        if (!address || !country) {
            console.error("Address and country are required for geocoding.");
            return;
        }

        const fullAddress = `${address}, ${city}, ${region}, ${country}`;
        console.log("Full address:", fullAddress);

        const apiKey = "pk.eyJ1IjoiZGV0YWhlcm1hbmEiLCJhIjoiY20zd3dkMXlzMTltZjJxcTJwajU3bnp2dSJ9.-7A9JGwRklO5A8HZPsSULA";

        const apiUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(fullAddress)}.json?access_token=${apiKey}&limit=1`;

        console.log("Fetching coordinates for:", fullAddress);

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log("Mapbox response data:", data);

                if (data.features && data.features.length > 0) {
                    const coordinates = data.features[0].geometry.coordinates;
                    const lng = coordinates[0]; // Longitude
                    const lat = coordinates[1]; // Latitude

                    document.getElementById("Advert_lat").value = lat;
                    document.getElementById("Advert_lng").value = lng;
                    console.log("Coordinates set to:", lat, lng);
                } else {
                    console.error("Address not found or no data returned from Mapbox.");
                }
            })
            .catch(error => console.error("Error fetching coordinates:", error));
    }

    function fetchRegionsForUK() {
        const countryId = document.getElementById("Advert_country_id").value;
        console.log("Fetching regions for countryId:", countryId); // Debug log

        fetch(`/geo/regions?countryId=${countryId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log("Regions fetched:", data); // Debug log
                const regionDropdown = document.getElementById("Advert_region");
                regionDropdown.innerHTML = '<option value="">Select Region</option>';
                data.forEach(region => {
                    const option = document.createElement("option");
                    option.value = region.id;
                    option.textContent = region.name;
                    regionDropdown.appendChild(option);
                });
            })
            .catch(error => console.error("Error fetching regions:", error));
    }

    function fetchCities(regionId) {
        if (!regionId) {
            console.error("Region ID is required to fetch cities.");
            return;
        }

        const username = "detahermana";
        const url = `http://api.geonames.org/childrenJSON?geonameId=${regionId}&username=${username}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const cityDropdown = document.getElementById("Advert_city_name");
                cityDropdown.innerHTML = '<option value="">Select City</option>';

                if (data && data.geonames && data.geonames.length > 0) {
                    data.geonames.forEach(city => {
                        const option = document.createElement("option");
                        option.value = city.geonameId;
                        option.textContent = city.name;
                        cityDropdown.appendChild(option);
                    });
                } else {
                    console.warn("No cities found for the selected region.");
                    cityDropdown.innerHTML = '<option value="">No cities available</option>';
                }
            })
            .catch(error => {
                console.error("Error fetching cities:", error);
                const cityDropdown = document.getElementById("Advert_city_name");
                cityDropdown.innerHTML = '<option value="">Error fetching cities</option>';
            });
    }

    $(function () {
        $('#bGeo').click(function () {
            getLocation();
        });
    });
</script>
