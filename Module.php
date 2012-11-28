<?php

namespace AkrabatFormatUkTelephone;

class Module extends \Zend\View\Helper\AbstractHelper
{
    public function getViewHelperConfig()
    {
        return array('services' => array('formatUkTelephone' => $this));
    }

    public function __invoke($string = null)
    {
        return $this->format($string);
    }

    public function format($number)
    {
        // Normalise to a string of numbers
        $number = str_replace("+44", "0", $number); // change +44 into leading 0
        $number = preg_replace( '/[^0-9]+/','', $number);

        // This uses full codes from http://www.area-codes.org.uk/formatting.php
        $telephoneFormat = array(
            '08001111' => '/(\d{4})(\d{4})/',           // special case
            '08454647' => '/(\d{4})(\d{4})/',           // special case
            '013873'   => '/(\d{6})(\d{5})/',           // 013873 #####
            '015242'   => '/(\d{6})(\d{5})/',           // 015242 #####
            '015394'   => '/(\d{6})(\d{5})/',           // 015394 #####
            '015395'   => '/(\d{6})(\d{5})/',           // 015395 #####
            '015396'   => '/(\d{6})(\d{5})/',           // 015396 #####
            '016973'   => '/(\d{6})(\d{5})/',           // 016973 #####
            '016974'   => '/(\d{6})(\d{5})/',           // 016974 #####
            '016977'   => '/(\d{6})(\d{5,6})/',         // 016977 ####[#]
            '017683'   => '/(\d{6})(\d{5})/',           // 017683 #####
            '017684'   => '/(\d{6})(\d{5})/',           // 017684 #####
            '017687'   => '/(\d{6})(\d{5})/',           // 017687 #####
            '019467'   => '/(\d{6})(\d{5})/',           // 019467 #####
            '011'      => '/(\d{4})(\d{3})(\d{4})/',    // 011# ### ####
            '0121'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '0131'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '0141'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '0151'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '0161'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '0171'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '0181'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '0191'     => '/(\d{4})(\d{3})(\d{4})/',     // 01#1 ### ####
            '01'       => '/(\d{5})(\d{5,6})/',         // 01### #####[#]
            '02'       => '/(\d{3})(\d{4})(\d{4})/',    // 02# #### ####
            '03'       => '/(\d{5})(\d{6})/',           // 03## ### ####
            '0500'     => '/(\d{4})(\d{6})/',           // 0500 ######
            '05'       => '/(\d{5})(\d{6})/',           // 05### ######
            '07'       => '/(\d{5})(\d{6})/',           // 07### ######
            '08'       => '/(\d{4})(\d{3})(\d{3,4})/',  // 08## ### ###[#]
            '09'       => '/(\d{4})(\d{3})(\d{4})/',    // 09## ### ####
        );

        foreach ($telephoneFormat AS $key=>$format) {
            if (substr($number,0,strlen($key)) == $key)
                break;
        };
        $formattedNumber = trim(preg_replace($format, "$1 $2 $3", $number));

        return $formattedNumber;
    }
}
