<?php

class Config
{
    private $protocol;
    private $host;
    private $base;
    public $root;


    public $db_host;
    public $db_user;
    public $db_pass;
    public $db_name;

    public function __construct()
    {
        $this->protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $this->host = $_SERVER['HTTP_HOST'];
        $this->base = $this->protocol . "://" . $this->host;
        $this->root = $this->base . '/' . basename($this->findRootDirectory(__DIR__)) . '/';

        $this->db_host = 'localhost';
        $this->db_user = 'root';
        $this->db_pass = 'toor';
        $this->db_name = 'perpus';
    }

    private function findRootDirectory($currentDir, $marker = 'autoloader.php')
    {
        $maxIterations = 20;

        $i = 0;
        while ($currentDir !== '/' && $i < $maxIterations) {
            if (file_exists($currentDir . '/' . $marker)) {
                return $currentDir;
            }
            $currentDir = dirname($currentDir);
            $i++;
        }
    }
}