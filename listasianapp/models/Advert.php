<?php

/**
 * This is the model class for table "Advert".
 *
 * The followings are the available columns in table 'Advert':
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $name
 * @property string $address
 * @property string $postcode
 * @property string $telephone
 * @property string $fax
 * @property string $web
 * @property string $email
 * @property integer $rating
 * @property integer $seo1
 * @property integer $seo2
 * @property string $start_date
 * @property string $expiry_date
 * @property string $description
 * @property string $image
 * @property string $create_date
 * @property string $update_date
 * @property integer $active
 * @property integer $paid
 * @property integer $package
 * @property float $lat
 * @property float $lng
 * @property string $category
 * @property string $country_id
 * @property string $region_id
 * @property integer $sub_region_id
 * @property integer $city_id
 * @property string $country_name
 * @property string $city_name
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $facebook_url
 * @property string $twitter_url
 * @property string $instagram_url
 * @property string $gplus_url
 * @property string $youtube_url
 * @property string $pinterest_url
 * @property string $country
 * @property string $region
 * @property Category[] $categorys
 * @property [] $categoryList
 */
class Advert extends CActiveRecord
{

    public $file;
    public $previewFile;

    //filter yes/no for paid/active
    public $filter;

    const CURRENCY = 'GBP';

    private $_categoryList;

    private $_countryList;

    private $_regionList;
    
    private $_cityList;

    public $advertTypes = [
        'silver' => 'seo1',
        'platinum' => 'seo2',
    ];

    public function init()
    {
        parent::init();

        $this->filter = [
            0 => Yii::app()->format->formatBoolean(0),
            1 => Yii::app()->format->formatBoolean(1)
        ];

        if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            $this->active  = 1;
            $this->paid    = 1;
            $this->user_id = 1;
        }
    }

    public function getPackage()
    {
		$price = Price::model()->findByPk($this->package);
        return $price->name;
    }

    public function getCategoryList()
    {
        if (!$this->_categoryList) {
            $this->_categoryList = CHtml::listData($this->categorys, 'name', 'id');
        }
        return $this->_categoryList;
    }

    public function setCategoryList($value)
    {
        $this->_categoryList = $value;
    }

    public function getCountryList()
    {
        if (!$this->_countryList) {
            $this->_countryList = CHtml::listData(Geo::getCountryData(), 'country_id', 'country_name');
        }
        return $this->_countryList;
    }

    public function setCountryList($value)
    {
        $this->_countryList = $value;
    }

    public function getRegionList()
    {
        if (!$this->_regionList && !empty($this->country_id)) {
            try {
                $regionData = Geo::getRegionData(null, $this->country_id);
                if ($regionData) {
                    $this->_regionList = CHtml::listData($regionData, 'region_id', 'region_name');
                } else {
                    Yii::log("No regions found for country_id: {$this->country_id}", CLogger::LEVEL_WARNING);
                    $this->_regionList = [];
                }
            } catch (Exception $e) {
                Yii::log("Error fetching regions for country_id: {$this->country_id} - " . $e->getMessage(), CLogger::LEVEL_ERROR);
                $this->_regionList = [];
            }
        }

        return !empty($this->_regionList) ? $this->_regionList : [];
    }

    public function setRegionList($value)
    {
        $this->_regionList = $value;
    }

    public function getCityList()
    {
        if (!$this->_cityList && !empty($this->region_id)) {
            // Yii::log("Fetching city list for region_id: {$this->region_id}", CLogger::LEVEL_INFO);

            try {
                $cityData = Geo::getCityData(null, $this->region_id);
                if (!empty($cityData)) {
                    $this->_cityList = CHtml::listData($cityData, 'city_id', 'city_name');
                    // Yii::log("City list fetched successfully for region_id: {$this->region_id}.", CLogger::LEVEL_INFO);
                } else {
                    Yii::log("No cities found for region_id: {$this->region_id}", CLogger::LEVEL_WARNING);
                    $this->_cityList = [];
                }
            } catch (Exception $e) {
                Yii::log("Error fetching cities for region_id: {$this->region_id} - " . $e->getMessage(), CLogger::LEVEL_ERROR);
                $this->_cityList = [];
            }
        } else {
            // Yii::log("City list already populated for region_id: {$this->region_id}.", CLogger::LEVEL_INFO);
        }

        return !empty($this->_cityList) ? $this->_cityList : [];
    }

    public function setCityList($value)
    {
        $this->_cityList = $value;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Advert';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            // Required fields
            ['name, address, postcode, telephone, description, country_name, region, category_id, city_name', 'required'],
            ['categoryList', 'required', 'message' => 'Please select at least one subcategory.'],
        
            // Numerical validation
            ['category_id, city_id, sub_region_id, package, active, paid, rating', 'numerical', 'integerOnly' => true],
            ['lat, lng', 'numerical'],

            // Ensure geo IDs are safe for both update and create
            ['country_id, region_id, city_id', 'safe', 'on' => ['update', 'create']],
        
            // Length validation
            ['name, manager_name, email', 'length', 'max' => 100],
            ['address, web, previewFile, seo_keywords, seo_description', 'length', 'max' => 200],
            ['postcode, telephone, fax, mobile, country, region', 'length', 'max' => 20],
            ['country_id, region_id', 'length', 'max' => 10],
        
            // File validation
            ['file', 'file', 'types' => 'jpg, jpeg, png, gif', 'allowEmpty' => true, 'maxSize' => 2 * 1024 * 1024],
        
            // URL and Email validation
            ['email', 'email'],
            ['web, facebook_url, twitter_url, instagram_url, gplus_url, youtube_url, pinterest_url', 'url', 'defaultScheme' => 'http'],
        
            // Safe attributes for admin scenario
            ['package, active, paid, expiry_date, user_id', 'safe', 'on' => 'admin'],
            ['rating', 'numerical', 'integerOnly' => true, 'on' => 'admin', 'min' => 0, 'max' => 5],

            // Search scenario safe attributes
            ['id, user_id, name, manager_name, mobile, telephone, web, email, rating, seo1, seo2, start_date, expiry_date, active, paid', 'safe', 'on' => 'search'],
            
            // Additional attributes
            ['city_name, region', 'safe'],
            ['active', 'default', 'value' => 0],
            ['active', 'in', 'range' => [0, 1], 'message' => 'Active must be 0 or 1.'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'categorys'   => [self::MANY_MANY, 'Category', 'Category_Advert(advert_id, category_id)'],
            'category'    => [self::BELONGS_TO, 'Category', 'category_id'],
            'user'        => [self::BELONGS_TO, 'User', 'user_id'],
            'price'       => [self::BELONGS_TO, 'Price', 'package'],
            'country' 	  => [self::BELONGS_TO, 'Country', 'country_id'],
            'region' 	  => [self::BELONGS_TO, 'Region', 'region_id'],
            'city' 		  => [self::BELONGS_TO, 'City', 'city_id'],
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id'=>'User',
            'category_id'=>'Category',
            'name' => 'Company Name',
            'address' => 'Address',
            'postcode' => 'Postcode',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'web' => 'Web',
            'email' => 'Email',
            'rating' => 'Rating',
            'seo1' => 'Seo1',
            'seo2' => 'Seo2',
            'start_date' => 'Start Date',
            'expiry_date' => 'Expiry Date',
            'description' => 'Description',
            'image' => 'Image',
            'file' => 'Image',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'active' => 'Active',
            'categoryList'=> 'Sub category',
            'lat' => 'Latitude',
            'lng' => 'Longitude',
            'mobile' => 'Mobile',
            'country_id' => 'Country',
            'region_id' => 'Region',
            'city_id' => 'City',
            'sub_region_id' => 'Sub region',
            'country' => 'Country',
            'region' => 'Region',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('t.id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('manager_name',$this->manager_name,true);
        $criteria->compare('mobile',$this->mobile,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('web',$this->web,true);
        $criteria->compare('t.email',$this->email,true);
        $criteria->compare('rating',$this->rating);
        $criteria->compare('seo1',$this->seo1);
        $criteria->compare('seo2',$this->seo2);
        $criteria->compare('start_date',$this->start_date,true);
        $criteria->compare('expiry_date',$this->expiry_date,true);
        $criteria->compare('active',$this->active);
        $criteria->compare('paid',$this->paid);
        $criteria->with = 'user';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>[
                'pageSize'=>Yii::app()->params->pageSize
            ],
            'sort' => [
                'defaultOrder' => 't.id DESC'
            ]
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Advert the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Update beforeSave method to fetch country, region, and city data dynamically.
     */
    public function beforeSave()
    {
        // Yii::log('Country value in beforeSave: ' . $this->country, CLogger::LEVEL_INFO);
        if (parent::beforeSave()) {
            // Yii::log('beforeSave called', CLogger::LEVEL_INFO);
        
            if ($this->isNewRecord) {
                if (empty($this->expiry_date)) {
                    $this->expiry_date = new CDbExpression('DATE_ADD(NOW(), INTERVAL 1 YEAR)');
                }
                if (User::ROLE_USER == Yii::app()->user->role) {
                    $this->user_id = Yii::app()->user->id;
                }
                $this->setPackage();
            } else {
                if (Yii::app()->user->role == User::ROLE_USER) {
                    $this->active = 0;
                }
                if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
                    $this->setPackage();
                }
            }
        
            $this->fetchGeoData();

            // Yii::log("Final Geo Data - Country ID: {$this->country_id}, Region ID: {$this->region_id}, City ID: {$this->city_id}", CLogger::LEVEL_INFO);

            if (empty($this->country_id) || empty($this->region_id) || empty($this->city_id)) {
                Yii::log("Required geo fields are missing - Country ID: {$this->country_id}, Region ID: {$this->region_id}, City ID: {$this->city_id}", CLogger::LEVEL_ERROR);
                return false;
            }                      

            // Get coordinates if not set
            if (empty($this->lat) || empty($this->lng)) {
                $coordinates = $this->getCoordinatesFromAddress($this->address);
                if ($coordinates) {
                    $this->lat = $coordinates['lat'];
                    $this->lng = $coordinates['lng'];
                } else {
                    Yii::log('Coordinates not found for address: ' . $this->address, CLogger::LEVEL_WARNING);
                }
            }

            // Log image save status
            // Yii::log('Saving image', CLogger::LEVEL_INFO);
            $this->saveImage();

            return true;
        } else {
            Yii::log('parent::beforeSave returned false', CLogger::LEVEL_ERROR);
            return false;
        }
    }

    private function fetchGeoData()
    {
        // Fetch country data
        if (!empty($this->country_name)) {
            $countryData = Geo::getCountryData($this->country_name);
            if ($countryData) {
                $this->country_id = $countryData['country_id']; // Assign ISO as country_id
                // Yii::log("Fetched country_id: {$this->country_id} for country_name: {$this->country_name}", CLogger::LEVEL_INFO);
            } else {
                $this->country_id = null;
                Yii::log("Invalid country_name: {$this->country_name}", CLogger::LEVEL_WARNING);
                return; // Stop further execution if country data is invalid
            }
        }

        // Fetch region data
        if (!empty($this->region_id) && !empty($this->country_id)) {
            $regionData = Geo::getRegionData($this->region_id, $this->country_id);
            if ($regionData && isset($regionData['region_name'])) {
                $this->region = $regionData['region_name'];
                // Yii::log("Fetched region_name: {$this->region} for region_id: {$this->region_id}", CLogger::LEVEL_INFO);
            } else {
                $this->region_id = null;
                Yii::log("Invalid region_id: {$this->region_id} for country_iso: {$this->country_id}", CLogger::LEVEL_WARNING);
                return; // Stop execution if region data is invalid
            }
        } else {
            Yii::log("Region ID or Country ID is missing.", CLogger::LEVEL_ERROR);
            $this->region_id = null;
            return; // Stop further execution if region is missing
        }

        // Fetch city data
        if (!empty($this->city_id) && !empty($this->region_id)) {
            $cityData = Geo::getCityData($this->city_id, $this->region_id);
            if ($cityData) {
                $this->city_name = $cityData['city_name'];
                // Yii::log("Fetched city_name: {$this->city_name} for city_id: {$this->city_id}", CLogger::LEVEL_INFO);
            } else {
                $this->city_id = null;
                Yii::log("Invalid city_id: {$this->city_id} for region_id: {$this->region_id}", CLogger::LEVEL_WARNING);
            }
        } elseif (!empty($this->city_name) && !empty($this->region_id)) {
            $cityData = Geo::getCityData($this->city_name, $this->region_id);
            if ($cityData) {
                $this->city_id = $cityData['city_id'];
                // Yii::log("Fetched city_id: {$this->city_id} for city_name: {$this->city_name}", CLogger::LEVEL_INFO);
            } else {
                $this->city_id = null;
                Yii::log("Invalid city_name: {$this->city_name} for region_id: {$this->region_id}", CLogger::LEVEL_WARNING);
            }
        }
    }

    private function setPackage()
    {
        $this->seo1 = 0;
        $this->seo2 = 0;

        if (PackagePrice::PACKAGE_GOLD == $this->package) {
            $this->seo1 = 1;
        } elseif (PackagePrice::PACKAGE_PLATINUM == $this->package) {
            $this->seo2 = 1;
        }
    }

    public function behaviors()
    {
        return [
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'start_date',
                'setUpdateOnCreate' => true
            ),
            'EActiveRecordRelationBehavior'=>array(
                'class'=>'EActiveRecordRelationBehavior',
            ),
        ];
    }

    public function getPicturePath()
    {
        $name = md5(uniqid("")) . '.' . $this->file->extensionName;
        return Yii::app()->params['upload'] . substr($name, 0, 2) . '/' . $name;
    }

    public function saveImage()
    {
        if ($this->file instanceof CUploadedFile) {

            $this->deleteImage();

            $name = md5(uniqid("")) . '.' . $this->file->extensionName;
            $this->image = Yii::app()->params['upload'] . substr($name, 0, 2) . '/' . $name;

            $fullPath = Yii::getPathOfAlias('webroot') . $this->image;
            $dir = dirname($fullPath);

            if (!is_dir($dir)) {
                mkdir($dir);
            }
            chmod($dir, 0775);

            $this->file->saveAs($fullPath);

            $image = Yii::app()->image->load($fullPath);
            $image->resize(640, 250);
            $image->save();

            /*
             * only for preview when create advert
             */
            if ($this->isNewRecord) {
                $temp = new TempImage();
                $temp->image = $this->image;
                $temp->save();
            }

        } elseif ($this->previewFile) {
            $this->image = $this->previewFile;
        }
    }

    private function deleteImage()
    {
        if (!$this->image) return;

        $picturePath = Yii::getPathOfAlias('webroot') . $this->image;

        if (file_exists($picturePath)) {
            unlink($picturePath);
        }
    }

    public function getCached($id)
    {
        $model = Yii::app()->cache[__CLASS__ . $id];

        if (false === $model) {

            $model = Advert::model()->active()->findByPk($id);

            if (null === $model) {

                if (720 == $id) {
                    return $this->getCached(918);
                }
                return false;
            }

            Yii::app()->cache->set(__CLASS__ . $id, $model, Yii::app()->params->cacheTime);

        }

        return $model;
    }

    public function scopes()
    {
        return [
            'active'=>[
                'condition' => 'active = 1 AND paid = 1'
            ]
        ];
    }

    public function afterSave()
    {
        parent::afterSave();

        if ($this->isNewRecord) {
            TempImage::model()->deleteAllByAttributes(['image' => $this->image]);
        } else {
            Yii::app()->cache->delete(__CLASS__ . $this->id);
        }

    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->deleteImage();
        // Yii::log("Advert deleted: {$this->id}", CLogger::LEVEL_INFO);
        Yii::app()->cache->delete(__CLASS__ . $this->id);
    }

    public function getList($code = null, $searchName = null, $pagination = true, $type = null)
    {

        if ($code === null && empty($searchName)) {
            return new CActiveDataProvider($this, ['data' => []]);
        }

        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->with = ['categorys', 'category'];
        $criteria->scopes = 'active';
        $criteria->order = 'seo2 DESC, seo1 DESC, t.name ASC';
        $criteria->group = 't.id';

        if (!empty($searchName)) {
            $criteria->compare('t.name', $searchName, true);
        } else {

            $category = Category::model()->getCached($code);

            if (isset($category->parent)) {
                $criteria->compare('categorys.id', $category->id);
            } else {
                $criteria->compare('t.category_id', $category->id);
            }

        }

        if (isset($this->advertTypes[$type])) {
            $criteria->compare($this->advertTypes[$type], 1);
        }

        if (isset(Yii::app()->session['geoForm'])) {

            $geoForm = Yii::app()->session['geoForm'];
            $criteria->compare('country_id', $geoForm->country_id);
            $criteria->compare('region_id', $geoForm->region_id);
            $criteria->compare('sub_region_id', $geoForm->sub_region_id);

        }

        $scopes = $this->scopes();
        $dependency = new CDbCacheDependency('SELECT MAX(update_time) FROM Advert WHERE ' . $scopes['active']['condition']);

        if ($pagination) {
            $pagination = [
                'pageSize' => 5,
                'pageVar' => 'page'
            ];
        }
        $dataProvider = new CActiveDataProvider($this->cache(Yii::app()->params->cacheTime, $dependency, 3), [
            'criteria' => $criteria,
            'pagination' => $pagination,
        ]);

        return $dataProvider;
    }

    public function getOwnList($paid = null, $active = null)
    {
        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->compare('user_id', Yii::app()->user->id);
        $criteria->compare('paid', $paid);
        $criteria->compare('active', $active);

        $dependency = new CDbCacheDependency('SELECT MAX(update_time) FROM Advert WHERE user_id=:user_id');
        $dependency->params = [':user_id'=>Yii::app()->user->id];

        $dataProvider=new CActiveDataProvider($this->cache(Yii::app()->params->cacheTime, $dependency, 2), [
            'criteria'=>$criteria,
            'sort'=>[
                'defaultOrder'=>'id DESC'
            ],
            'pagination'=>[
                'pageSize'=>Yii::app()->params->pageSize,
            ]
        ]);

        return $dataProvider;
    }

    public function getPayDescription()
    {
        return 'Buy package ' . $this->price->name;
    }

    public function filterPreviewAttr($name)
    {
        $attr = [
            'name',
            'address',
            'postcode',
            'telephone',
            'fax',
            'web',
            'email',
            'manager_name',
            'mobile',
            'description'
        ];

        return in_array($name, $attr);
    }

    public function getAmount()
    {
        $price = Price::model()->findByPk($this->package);
        if (!$price) {
            throw new CHttpException(500, 'wrong package');
        }
        return $price->value;
    }

    public function getNext()
    {

        $list = $this->getList(Yii::app()->session['code'], null, false);

        for ($i=0; $i<count($list->data); $i++) {

            if ($list->data[$i]->id == $this->id && isset($list->data[$i+1])) {
                return $list->data[$i+1];
            }

        }

        return null;

    }

    public function getPrev()
    {

        $list = $this->getList(Yii::app()->session['code'], null, false);

        for ($i=0; $i<count($list->data); $i++) {

            if ($list->data[$i]->id == $this->id && isset($list->data[$i-1])) {
                return $list->data[$i-1];
            }

        }

        return null;

    }

    public function getSeoLink($name = null)
    {
        return CHtml::link(CHtml::encode($name ? $name : $this->name), $this->getSeoUrl());
    }

    public function getSeoCategory()
    {
        return isset($this->categorys[0]) ? $this->categorys[0]->getUrl() : '';
    }

    public function getSeoName()
    {
        $name = '';

        if ($this->category instanceof Category) {
            $name = $this->category->name;
        }

        if (is_array($this->categorys) && isset($this->categorys[0]) && $this->categorys[0] instanceof Category) {
            $name .= '/' . $this->categorys[0]->name;
        }

        return trim("$name {$this->name}");
    }

    public function getSeoUrl()
    {
        $name = str_replace(' ', '-', $this->name);
        $name = str_replace("'", "", $name);
        $name = str_replace("&", "and", $name);

        return Yii::app()->createUrl('/advert/display', [
                'id' => $this->id,
                'country' => $this->country,
                'region' => $this->region,
                'subcategory' => isset($this->categorys[0]) ? str_replace([' ', ',', '/'], '-', $this->categorys[0]->url) : null,
                'name' => $name
            ]
        );
    }

    public function getPageTitle()
    {
        $title = trim($this->name) . ' - ';

        foreach ($this->categorys as $category) {
            $title .= $category->name . ' ';
        }

        return trim($title);
    }

    public function getSeoKeywords()
    {
        if (!empty($this->seo_keywords)) {
            return $this->seo_keywords;
        }

        $value = trim($this->name);

        if (isset($this->categorys[0])) {
            $value .=  ', ' . $this->categorys[0]->url;
        }

        return trim($value);
    }

    public function getSeoDescription()
    {
        $value = trim($this->name);

        if (isset($this->categorys[0])) {
            $value .=  ', ' . $this->categorys[0]->url;
        }

        if (!empty($this->seo_description)) {
            $description = $this->seo_description;
        } else {
            $description =  ', ' . $this->description;
        }

        return trim($value . substr($description, 0, 160));
    }

    public function purchase($planId)
    {
        $opay = new Opay();
        try {
            $opay->purchase($this->id);
            $this->setPaid('year');

        } catch (Exception $e) {
            throw new CHttpException(500, 'Payment failed: ' . $e->getMessage());
        }
    }

    public function setPaid($interval)
    {
        if ($this->paid) {
            return;
        }

        $tran = Yii::app()->db->beginTransaction();

        try {
            $paylog = new Paylog();
            $paylog->user_id = $this->user_id;
            $paylog->advert_id = $this->id;
            $paylog->amount = $this->getAmount();
            $paylog->description = $this->payDescription;
            $paylog->active = 1;
            $paylog->save(false);

            $this->expiry_date = new CDbExpression("DATE_ADD(NOW(), INTERVAL 1 {$interval})");
            $this->paid = 1;
            $this->save(false);

            $tran->commit();

            if (!YII_DEBUG) {
                Mail::prepare('payments', $this->id, $this->user_id);
            }
        } catch (CException $ex) {
            $tran->rollback();
            throw $ex;
        }
    }

    private function getCoordinatesFromAddress($address)
    {
        $apiKey = Yii::app()->params['mapbox.api_key'];
        $apiUrl = sprintf(
            "https://api.mapbox.com/geocoding/v5/mapbox.places/%s.json?access_token=%s&limit=1",
            urlencode($address),
            $apiKey
        );

        try {
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);

            if (!empty($data['features']) && isset($data['features'][0]['geometry']['coordinates'])) {
                return [
                    'lng' => $data['features'][0]['geometry']['coordinates'][0],
                    'lat' => $data['features'][0]['geometry']['coordinates'][1],
                ];
            }
        } catch (Exception $e) {
            Yii::log("Failed to fetch coordinates from Mapbox: " . $e->getMessage(), CLogger::LEVEL_ERROR);
        }

        return null;
    }
}
