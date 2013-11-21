<?php

App::uses('FormHelper', 'View/Helper');
App::uses('CloudinaryField', 'CloudinaryCake.Lib');

class CloudinaryHelper extends FormHelper {
    public $helpers = array('Html');
    public $cloudinaryFunctions = array(
        "cl_image_tag",
        "fetch_image_tag",
        "facebook_profile_image_tag",
        "gravatar_profile_image_tag",
        "twitter_profile_image_tag",
        "twitter_name_profile_image_tag",
        "cloudinary_js_config",
        "cloudinary_url",
        "cl_sprite_url",
        "cl_sprite_tag",
        "cl_upload_url",
        "cl_upload_tag_params",
        "cl_image_upload_tag",
        "cl_form_tag"
    );

    public function __call($name, $args) {
        if (in_array($name, $this->cloudinaryFunctions)) {
            return call_user_func_array($name, $args);
        }
        return parent::__call($name, $args);
    }

    /// Automatically detect cloudinary fields on models that have declared them.
	public function input($fieldName, $options = array()) {
		$this->setEntity($fieldName);
        $model = $this->_getModel($this->model());
        $fieldKey = $this->field();
        if ($model->hasMethod('cloudinaryFields') && in_array($fieldKey, $model->cloudinaryFields())) {
            $options['type'] = 'file';
        }
        return parent::input($fieldName, $options);
    }

    public function cloudinary_includes() {
        echo $this->Html->script('jquery.ui.widget');
        echo $this->Html->script('jquery.iframe-transport');
        echo $this->Html->script('jquery.fileupload');
        echo $this->Html->script('jquery.cloudinary');
    }

    /// Called for input() when type => direct_upload
    public function direct_upload() {
        $modelKey = $this->model();
        $fieldKey = $this->field();
        return \cl_image_upload_tag("data[" . $modelKey . "][" . $fieldKey . "]");
    }
}
