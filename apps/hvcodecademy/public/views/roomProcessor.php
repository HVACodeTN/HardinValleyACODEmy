<?php
    function roomString($roomGroup, $roomNumber)
    {
        $letters = array('A','B','C','D','E','F');
        if ($roomGroup>0 && $roomGroup<7) {
            // within range
            return $letters[$roomGroup-1].$roomNumber;
        }
    }
    
    function roomNumber($roomString)
    {
        $letters = array('A','B','C','D','E','F');
        if (strlen($roomString)==4) { //must be 4 long
            $letterNum = array_search(substr($roomString,0,1),$letters);
            $number = substr($roomString,1,3);
            return array($letterNum, $number);
        }
    }