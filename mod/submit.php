<?php

require_once '../library/Helper.php';
require_once '../library/Contact.php';
require_once '../library/Validator.php';

$objValidator = New Validator();

$objValidator->expected = array(
    'first_name',
    'last_name',
    'email',
    'type',
    'enquiry'
);

$objValidator->required = array(
    'first_name',
    'last_name',
    'email',
    'type',
    'enquiry'
);

$objValidator->special = array('email');

$objValidator->validation = array(
    'first_name' => 'Please provide your first name',
    'last_name' => 'Please provide your last name',
    'email' => 'Please provide your valid email address',
    'type' => 'Please select enquiry type',
    'enquiry' => 'Please provide your message'
);

try{

    if($objValidator->_isValid($_POST)) {

        if(Contact::send($objValidator->array)) {

            $message = 'The message has been sent succesfully';

            echo Helper::jsonEncode(array(

                'error' => false,
                'message' => Helper::alert($message, 'success')
            ));

        } else {

            throw New Exception('Message could not be sent');
        }

    } else {

        throw New Exception('Please fill in the missing items');

    }



}catch(Exception $e){

    $message = $e->getMessage();

    echo Helper::jsonEncode(array(

        'error' => true,
        'message' => Helper::alert($message),
        'validation' => $objValidator->errors


    ));

}
