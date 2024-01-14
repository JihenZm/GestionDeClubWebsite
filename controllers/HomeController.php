<?php
// HomeController.php

class HomeController {
    private $authService;

    public function __construct($authService) {
        $this->authService = $authService;
    }

    public function index() {
        include('views/home.php');
    }
}



?>