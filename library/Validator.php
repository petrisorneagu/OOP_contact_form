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
     * checks if the items which are inside of the required array have been passed through POST at submit
     */
    private function _isRequiredValid(){
        foreach($this->required as $key){
            if(! array_key_exists($key, $this->array)){
                $this->addError($key);
            }
        }
    }

    public function _isValid($array = null){
        if(!$this->_isArrayEmpty($array)){

            $this->_filterExpected($array);

            $this->_isRequiredValid();

        }
        return false;
    }
}