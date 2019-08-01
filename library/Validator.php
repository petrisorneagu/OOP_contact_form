<?php


class Validator
{

    public $expected = array();
    public $required = array();
    public $validation = array();
    public $array = array();
    public $errors = array();
    public $special = array();


    /**
     * @param null $array
     * @return bool
     */
    private function _isArrayEmpty($array = null){
        return ( ! ( ! empty($array) && is_array($array)));

    }

    /**
     * specify what fields are expected, required or needs some special treatment
     * there are key-value pairs colected from the POST
     * @param null $array
     */
    private function _filterExpected($array = null){
        foreach($array as $key => $value){
            if(in_array($key, $this->expected)){
                $this->array[$key] = $value;
            }
        }
    }

    /**
     *
     * @param null $key
     * @return bool
     */
    private function _isErrorKeyValid($key = null){
        return( !empty($key) && !array_key_exists($key, $this->errors));
    }

    public function addError($key = null){
        if($this->_isErrorKeyValid($key)){
            $this->errors[$key] = $this->validation[$key];
        }
    }

    /**
     * checks if the items which are inside of the required array have been passed through POST at submit
     */
    private function _isRequiredValid(){
        foreach($this->required as $key){
            if(! array_key_exists($key, $this->array)){
                $this->addError($key);
            }
        }
    }

    /**
     * cheks agains the '0' value
     * @param null $value
     * @return bool
     */
    public static function _isEmpty($value = null){

        return (empty($value) && !is_numeric($value));

    }

    /**
     * @param null $key
     * @param null $value
     * @return bool
     */
    private function _isEmptyAndRequired($key = null, $value = null){
        return (
            self::_isEmpty($value) &&
            in_array($key, $this->required));
    }

    /**
     * email validation
     * @param null $key
     * @param null $value
     */
    private function _isEmailValid($key = null, $value = null){

            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $this->addError($key);
            }
    }

    private function _validateSpecial($key = null, $value = null){

        switch($key){
            case 'email': $this->_isEmailValid($key, $value);
            break;
        }
    }

    public function _isValueValid(){

        foreach($this->array as $key => $value){
            if($this->_isEmptyAndRequired($key,  $value)){
                $this->addError($key);

            }else if(in_array($key, $this->special)){
                $this->_validateSpecial($key, $value);

            }
        }
    }

    /**
     * @param null $array
     * @return bool
     */
    public function _isValid($array = null){

        if(!$this->_isArrayEmpty($array)){

            $this->_filterExpected($array);

            $this->_isRequiredValid();

            $this->_isValueValid();

            return (empty($this->errors));

        }
        return false;
    }

}