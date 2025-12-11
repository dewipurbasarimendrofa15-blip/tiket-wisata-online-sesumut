<?php

class App {

    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        // Ambil URL dari .htaccess
        $url = $this->parseURL();

        // Cek controller
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerFile = 'app/controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        // Load controller
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Cek method
        if (!empty($url[1])) {
    if (method_exists($this->controller, $url[1])) {
        // jika method ditemukan
        $this->method = $url[1];
        unset($url[1]);
    } else {
        // jika method TIDAK ditemukan → anggap itu parameter (ID)
        $this->params[] = $url[1];
        $this->method = "index";
        unset($url[1]);
    }
}


        // Ambil parameter
        $this->params = $url ? array_values($url) : [];

        // Jalankan
        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
    }

    // FIX: parse URL agar tidak error
    private function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
