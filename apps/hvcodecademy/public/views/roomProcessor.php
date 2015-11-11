<?php
    function roomString($roomNumberIn)
    {
        //this function takes a number (1234), and returns a string (A234)
        $letters = array('A','B','C','D','E','F');
        if (strlen($roomNumberIn)==4) { //must be 4 long
            $roomGroupNum = substr($roomNumberIn,0,1);
            $roomGroupStr = "";
            if ($roomGroupNum>0 && $roomGroupNum<7) {
                // within range
                $roomGroupStr = $letters[$roomGroupNum-1];
            }
            $number = substr($roomNumberIn,1,3);
            return $roomGroupStr.$number;
        }

    }

    function roomNumber($roomString)
    {
        //this function takes a string (A234), and returns  number (1234).
        $letters = array('A','B','C','D','E','F');
        if (strlen($roomString)==4) { //must be 4 long
            $letterNum = array_search(substr($roomString,0,1),$letters);
            $number = substr($roomString,1,3);
            return intval($letterNum.$number);
        }
    }

    function roomInput($inputString) {
        // Process a room input from the website
        
    }
