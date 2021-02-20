<?php
    // Page redirect
    function redirect($page, $id = null) 
    {
        if($id != null) {
            header('location: ' . URLROOT . '/' . $page . '/' . $id);
        } else {
            header('location: ' . URLROOT . '/' . $page);
        }
    }