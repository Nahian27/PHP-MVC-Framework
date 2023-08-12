<?php

class Core
{
    protected string $currentMethod = 'index';
    protected array $params = [];
    protected mixed $currentController;

    public function __construct()
    {
        $url = $this->getUrl();

        if (file_exists(sprintf("../resources/controllers/%s.php", ucwords($url[0])))) {
            $controllerClassName = ucwords($url[0]);
            unset($url[0]);
        } else {
            $controllerClassName = 'Pages';
        }
        require_once sprintf("../resources/controllers/%s.php", $controllerClassName);
        $this->currentController = new $controllerClassName;

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(): array
    {
        $url = $_GET['url'] ?? '';
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
}
