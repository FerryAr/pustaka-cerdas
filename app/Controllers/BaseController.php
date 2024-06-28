<?php

namespace App\Controllers;

class BaseController
{
    protected $title = 'PustakaCerdas';
    protected $config;

    public function __construct()
    {
        $this->config = new \Config();
    }

    protected function loadView($views, $data = [])
    {
        if (!is_array($views)) {
            $views = [$views];
        }
        extract($data);
        foreach ($views as $view) {
            $viewFile =  dirname(__DIR__)  . '/views/' . $view . '.php';

            if (file_exists($viewFile)) {
                ob_start();
                require_once $viewFile;
                $content = ob_get_clean();
                echo $content;
            } else {
                die('View not found: ' . $viewFile);
            }
        }
    }

    protected function isLogin()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            $this->redirect('/auth/login');
        }
    }

    protected function isRole($role)
    {
        return $_SESSION['user']['role'] === $role;
    }

    protected function redirect($url)
    {
        $currentUrl = $this->getCurrentUrl();

        if (strpos($url, 'http') !== 0) {
            $basePath = $this->getBasePath();
            $url = rtrim($this->getBaseUrl(), '/') . '/' . trim($basePath, '/') . '/' . ltrim($url, '/');
        }

        if ($url !== $currentUrl) {
            header('Location: ' . $url);
            exit();
        }
    }

    protected function getCurrentUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $currentUrl;
    }

    protected function getBaseUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        return $protocol . "://" . $host;
    }

    protected function getBasePath()
    {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptDir = dirname($scriptName);
        return trim($scriptDir, '/');
    }
}
