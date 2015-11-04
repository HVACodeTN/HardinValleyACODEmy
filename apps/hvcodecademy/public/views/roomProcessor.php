<?php
    static $letters = array('A','B','C','D','E','F');
    function roomString($roomNumber)
    {
        $leadingNum = round($roomNumber/1000); // find thousanth's digit to change to letter
        $restNum = $roomNumber-$leadingNum*1000;
        if ($leadingNum>0 && $leadingNum<7) {
            // within range
            
            return $letters[$leadingNum].$restNum;
        }
    }
    
    function roomNumber($roomString)
    {
        if (strlen($roomString)==4) { //must be 4 long
            $letterNum = array_search(substr($roomString,0,1),$letters);
            $number = substr($roomString,1,3);
            return intval($letterNum.$number);
        }
    }