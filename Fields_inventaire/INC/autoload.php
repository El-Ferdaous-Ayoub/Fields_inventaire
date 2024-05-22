<?php

class PluginFieldsAutoloader {
    private $directories;

    public function __construct(array $directories) {
        $this->directories = $directories;
    }

    public function register() {
        spl_autoload_register([$this, 'autoload']);
    }

    private function autoload($class) {
        foreach ($this->directories as $directory) {
            $file = $directory . '/' . $class . '.class.php';
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
        }
        return false;
    }
}
?>
