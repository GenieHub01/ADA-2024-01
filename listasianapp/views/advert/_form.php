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
                    echo $form->select2Group($model, 'country_name', [
                        'widgetOptions' => [
                            'data' => CHtml::listData(Geo::getCountryData(), 'country_name', 'country_name'),
                            'htmlOptions' => [
                                'id' => 'Advert_country_name',
                                'prompt' => 'Select Country',
                                'onchange' => 'setCountryId()',
                            ],
                        ],
                    ]);

                    echo $form->select2Group($model, 'region_id', [
                        'widgetOptions' => [
                            'data' => !empty($model->regionList) ? $model->regionList : [],
                            'htmlOptions' => [
                                'id' => 'Advert_region',
                                'prompt' => 'Select Region',
                                'onchange' => 'setRegionId()',
                                'disabled' => true,
                            ],
                        ],
                    ]);                                                            

                    echo $form->select2Group($model, 'city_id', [
                        'widgetOptions' => [
                            'data' => !empty($model->cityList) ? $model->cityList : [],
                            'htmlOptions' => [
                                'id' => 'Advert_city_id',
                                'prompt' => 'Select City',
                                'onchange' => 'setCityId()',
                                'disabled' => true,
                            ],
                        ],
                    ]);                    

                    echo $form->hiddenField($model, 'country_id', ['id' => 'Advert_country_id']);

                    echo $form->hiddenField($model, 'country', ['id' => 'Advert_country']);

                    echo $form->hiddenField($model, 'region_id', ['id' => 'Advert_region_id']);
                
                    echo $form->hiddenField($model, 'city_name', ['id' => 'Advert_city_name_hidden']);
                ?>
                
                <div id="suggestions" style="display: none; border: 1px solid #ccc; max-height: 150px; overflow-y: auto;"></div>

                <!-- <button class="btn btn-default geo-btn" id="bGeo" name="yt1" type="button">GEO</button> -->

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
        const priorityCountries = ["United Kingdom", "United States", "Canada", "India"];
        const countryDropdown = document.getElementById("Advert_country_name");

        if (countryDropdown) {
            prioritizeDropdownOptions(countryDropdown, priorityCountries);
        }

        document.getElementById("Advert_country_name").addEventListener("change", setCountryId);
        document.getElementById("Advert_region").addEventListener("change", setRegionId);
        document.getElementById("Advert_city_id").addEventListener("change", setCityId);
        
        console.log("Checking initial dropdown states...");
        console.log("Country Dropdown:", document.getElementById("Advert_country_name").value);
        console.log("Region Dropdown:", document.getElementById("Advert_region").value);
        console.log("City Dropdown:", document.getElementById("Advert_city_id").value);
    });

    function setCountryId() {
        const countryDropdown = document.getElementById("Advert_country_name");
        const selectedCountryName = countryDropdown?.value;

        const countryIdField = document.getElementById("Advert_country_id");
        const countryCodeField = document.getElementById("Advert_country"); // Hidden field for FIPS

        if (!countryIdField || !countryCodeField) {
            console.error("Hidden input Advert_country_id or Advert_country is missing in the DOM.");
            return;
        }

        if (!selectedCountryName) {
            console.warn("No country selected.");
            countryIdField.value = "";
            countryCodeField.value = "";
            resetDropdown("Advert_region", "Select Region");
            resetDropdown("Advert_city_id", "Select City");
            return;
        }

        console.log("Selected Country:", selectedCountryName);

        fetch(`/geo/getCountryId?name=${encodeURIComponent(selectedCountryName)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Failed to fetch country ID: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.id && data.code) {
                    countryIdField.value = data.id; // ISO code
                    countryCodeField.value = data.code; // FIPS code
                    console.log("Country ID set to:", data.id, "Country code set to:", data.code);
                    fetchRegions(data.id);
                } else {
                    console.error("Country not found:", selectedCountryName);
                    countryIdField.value = "";
                    countryCodeField.value = "";
                    resetDropdown("Advert_region", "Select Region");
                    resetDropdown("Advert_city_id", "Select City");
                }
            })
            .catch(error => console.error("Error fetching country ID:", error));
    }

    function setRegionId() {
        const regionDropdown = document.getElementById("Advert_region");
        const selectedregionId = regionDropdown.value;
        const countryIso = document.getElementById("Advert_country_id").value;

        if (!regionDropdown) {
            console.error("Region dropdown (Advert_region) is missing in the DOM.");
            return;
        }
        
        if (!selectedregionId || !countryIso) {
            console.warn("Region ID or Country ISO is missing.");
            document.getElementById("Advert_region_id").value = "";
            resetDropdown("Advert_city_id", "Select City");
            return;
        }

        console.log("Selected Region ID:", selectedregionId, "for Country ISO:", countryIso);

        fetch(`/geo/getRegionId?regionId=${encodeURIComponent(selectedregionId)}&countryIso=${encodeURIComponent(countryIso)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Failed to fetch region ID: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (data && data.id) {
                    document.getElementById("Advert_region_id").value = data.id;
                    console.log("Region ID set to:", data.id);
                    fetchCities(data.id);
                } else {
                    console.warn("Region not found:", selectedregionId);
                    document.getElementById("Advert_region_id").value = "";
                    resetDropdown("Advert_city_id", "Select City");
                }
            })
            .catch(error => console.error("Error fetching region ID:", error));
    }

    function setCityId() {
        const cityDropdown = document.getElementById("Advert_city_id");
        if (!cityDropdown) {
            console.error("City dropdown (Advert_city_id) is missing in the DOM.");
            return;
        }

        const selectedCityId = cityDropdown?.value;
        const selectedCityName = cityDropdown?.options[cityDropdown.selectedIndex]?.text;

        const cityNameField = document.getElementById("Advert_city_name_hidden");

        if (!cityNameField) {
            console.error("Hidden input Advert_city_name_hidden is missing in the DOM.");
            return;
        }

        if (!selectedCityId || !selectedCityName) {
            console.warn("No city selected.");
            cityNameField.value = ""; // Reset city_name
            return;
        }

        console.log("Selected City Name:", selectedCityName);
        console.log("Selected City ID:", selectedCityId);

        // Set the hidden input
        cityNameField.value = selectedCityName;
    }

    function fetchRegions(countryIso) {
        const regionDropdown = document.getElementById("Advert_region");
        const cityDropdown = document.getElementById("Advert_city_id");

        if (!countryIso) {
            console.warn("Country ISO is required to fetch regions.");
            resetDropdown("Advert_region", "Select Region");
            resetDropdown("Advert_city_id", "Select City");
            return;
        }

        console.log("Fetching regions for Country ISO:", countryIso);

        regionDropdown.disabled = true;
        cityDropdown.disabled = true;

        fetch(`/geo/regions?countryIso=${encodeURIComponent(countryIso)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Failed to fetch regions: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                resetDropdown("Advert_region", "Select Region");

                if (data?.length > 0) {
                    data.forEach(region => {
                        if (region.region_id && region.region_name) {
                            const option = document.createElement("option");
                            option.value = region.region_id;
                            option.textContent = region.region_name;
                            regionDropdown.appendChild(option);
                        }
                    });
                    console.log("Regions loaded successfully.");
                    regionDropdown.disabled = false;
                } else {
                    console.warn("No regions found for Country ISO:", countryIso);
                }

                resetDropdown("Advert_city_id", "Select City");
            })
            .catch(error => {
                console.error("Error fetching regions:", error);
                regionDropdown.disabled = false;
            });
    }

    function fetchCities(regionId) {
        const cityDropdown = document.getElementById("Advert_city_id");

        if (!regionId || cityDropdown.options.length > 1) {
            console.log("Cities already populated or invalid Region ID.");
            console.warn("Region ID is required to fetch cities.");
            resetDropdown("Advert_city_id", "Select City");
            return;
        }

        console.log("Fetching cities for Region ID:", regionId);

        cityDropdown.disabled = true;

        fetch(`/geo/cities?regionId=${encodeURIComponent(regionId)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Failed to fetch cities: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                resetDropdown("Advert_city_id", "Select City");

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(city => {
                        if (city.city_id && city.city_name) {
                            const option = document.createElement("option");
                            option.value = city.city_id; // Set city_id as value
                            option.textContent = city.city_name; // Set city_name as displayed text
                            cityDropdown.appendChild(option);
                        }
                    });
                    console.log("Cities loaded successfully.");
                    cityDropdown.disabled = false;
                } else {
                    console.warn("No cities found for Region ID:", regionId);
                }
            })
            .catch(error => {
                console.error("Error fetching cities:", error);
                cityDropdown.disabled = false; // Enable city dropdown on error
            });
    }

    /**
     * Prioritize specific options in a dropdown.
     * @param {HTMLSelectElement} dropdown - The dropdown element.
     * @param {Array} priorities - Array of country names to prioritize.
     */
    function prioritizeDropdownOptions(dropdown, priorities) {
        const options = Array.from(dropdown.options); // Convert to array
        const prioritized = [];
        const others = [];

        // Separate options into prioritized and others
        options.forEach((option) => {
            if (priorities.includes(option.text)) {
                prioritized.push(option);
            } else {
                others.push(option);
            }
        });

        // Clear dropdown and re-append options
        dropdown.innerHTML = ""; // Remove all options
        prioritized.forEach((opt) => dropdown.appendChild(opt)); // Append prioritized options
        others.forEach((opt) => dropdown.appendChild(opt)); // Append other options

        console.log("Dropdown reordered with priorities:", priorities);
    }

    function fetchCoordinates() {
        const addressInput = document.getElementById("Advert_address");
        const cityInput = document.getElementById("Advert_city_id");
        const regionInput = document.getElementById("Advert_region");
        const countryInput = document.getElementById("Advert_country_name");

        if (!addressInput || !cityInput || !regionInput || !countryInput) {
            console.error("One or more required elements (address, city, region, country) are missing.");
            return;
        }

        const address = addressInput.value || "";
        const city = cityInput.options[cityInput.selectedIndex]?.text || "";
        const region = regionInput.options[regionInput.selectedIndex]?.text || "";
        const country = countryInput.options[countryInput.selectedIndex]?.text || "";

        if (!address || !country) {
            console.error("Address and country are required for geocoding.");
            return;
        }

        const fullAddress = `${address}, ${city}, ${region}, ${country}`;
        console.log("Full address:", fullAddress);

        const apiKey = "<?= Yii::app()->params['mapbox.api_key']; ?>";

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

    function resetDropdown(elementId, placeholder) {
        const dropdown = document.getElementById(elementId);
        if (!dropdown) {
            console.error(`Dropdown with ID ${elementId} not found.`);
            return;
        }

        dropdown.innerHTML = "";
        const placeholderOption = document.createElement("option");
        placeholderOption.value = "";
        placeholderOption.textContent = placeholder;
        dropdown.appendChild(placeholderOption);
        dropdown.disabled = true;
        console.log(`Dropdown ${elementId} reset with placeholder: ${placeholder}`);
    }

    $(function () {
        $('#bGeo').click(function () {
            getLocation();
        });
    });
</script>
