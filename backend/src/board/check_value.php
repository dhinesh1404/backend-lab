<?php

    function check_value($arg) {
        $value = isset($_REQUEST[$arg]) ? trim($_REQUEST[$arg]) : '';
        
        return $value;
    }

?>