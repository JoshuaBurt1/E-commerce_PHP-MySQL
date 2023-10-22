<?php
    function index () {
        render("pages/index", [
            "title" => "Biotec-For-U" /*"title" is the browser tab label*/ 
        ]);
    }
    function about () {
        render("pages/about", [
            "title" => "About"
        ]);
    }
    function contact () {
        render("pages/contact", [
            "title" => "Contact"
        ]);
    }
    function protocols () {
        render("pages/protocols", [
            "title" => "Protocols"
        ]);
    }
    function forum () {
        render("pages/forum", [
            "title" => "Forum"
        ]);
    }
?>