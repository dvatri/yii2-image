<?php

namespace tunect\yii2image\models;

use Yii;
use tunect\yii2image\Module;
use yii\base\Model;

class ImageUpload extends Model
{
    private $attributeName;  // Dynamic attribute name
    private $imageAttribute; // Image field value

    public function __construct($config = array())
    {
        parent::__construct($config);

        $attributeName = Yii::$app->getModule(Module::$moduleName)->attribute;
        $this->attributeName = $attributeName;
    }

    public function rules()
    {
        return [
            [[$this->attributeName], 'file', 'skipOnEmpty'=>false, 'extensions'=>'png, jpg', 'maxFiles'=>0],
        ];
    }

    /**
     * Allow use dynamic image field attribute name
     * @param string $name
     * @return string
     */
    public function __get($name)
    {
        if ($name === $this->attributeName) {
            return $this->imageAttribute;
        }

        parent::__get($name);
    }

    /**
     * Allow use dynamic image field attribute name
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name === $this->attributeName) {
            $this->imageAttribute = $value;
            return;
        }

        parent::__set($name, $value);
    }

    public function getAttributeName()
    {
        return $this->attributeName;
    }

}
