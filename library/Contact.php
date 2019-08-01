<?php

class Contact
{
    public static $types = array(
        1 => 'Product enquiry',
        2 => 'Billing enquiry',
        3 => 'Support enquiry'

    );



    /**
     * to whom it may concern
     * @var array
     */
    private static $_receiver = array(

        'email' => 'petrisor.neagu@gmail.com',
        'name' => 'petrisor'
    );

    const CONTACT_SUBJECT = 'Just an issue';


    private static function _formatMessage($array){

        $items = array();

        $items[] = '<strong>First name</strong>' .$array['first_name'];
        $items[] = '<strong>Last name</strong>' .$array['last_name'];
        $items[] = '<strong>Email address</strong><a href="mailto: ' . $array['email']. '">' . $array['email']. '</a>';
        $items[] = '<strong>Type</strong>' . self::$types[$array['type']];
        $items[] = nl2br($array['enquiry']);

        $out = '<div style="font-size: 14px; font-family: Arial, sans-serif; color: #333;">';
        $out .= '<p>';
        $out .= implode('<br />', $items);
        $out .= '</p>';
        $out .= '</div>';

        return $out;


    }


    public static function send($array = null){

        $message = self::_formatMessage($array);
    }
}