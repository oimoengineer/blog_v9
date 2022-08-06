<?php

namespace App\Calendar;

use Carbon\Carbon;

class Calendar {
    
    private $carbon;
    
    function __construct($date){
        $this->carbon = new Carbon($date);
    }
}