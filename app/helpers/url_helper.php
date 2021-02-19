<?php
    // Page redirect
    function redirect($page) 
    {
        if($page == 'dashboard') {
            header('location: ' . URLROOT);
        } else {
            header('location: ' . URLROOT . '/' . $page);
        }
    }