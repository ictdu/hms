<?php
    // Page redirect
    function redirect($page) 
    {
        if($page == 'home') {
            header('location: ' . URLROOT);
        } else {
            header('location: ' . URLROOT . '/' . $page);
        }
    }