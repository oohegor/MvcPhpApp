<?php

declare(strict_types=1);

/**
 * Router class
 * URL FORMAT - /controllerName/methodName?get=123&params=456
 */
class Router
{
    public function __construct(
        private string $defaultControllerName = 'PostController',
        private string $defaultMethodName = 'index',
    )
    {
    }

    private function getUrl(): array
    {
        $url = filter_var(parse_url(rtrim($_GET['url'], '/'), PHP_URL_PATH), FILTER_SANITIZE_URL);
        unset($_GET['url']);

        return explode('/', $url);
    }

    public function contentToRender(): void
    {
        $url = $this->getUrl();

        // controller part
        $controllerName = (isset($url[0]) && file_exists('../controllers/' . ucwords($url[0]) . 'Controller.php'))
            ? ucwords($url[0]) . 'Controller'
            : $this->defaultControllerName;

        require_once '../controllers/' . $controllerName . '.php';
        $controllerInstance = new $controllerName;

        // method part
        $methodName = (isset($url[1]) && method_exists($controllerInstance, $url[1]))
            ? $url[1]
            : $this->defaultMethodName;

        // params part
        $params = [];
        foreach ((new ReflectionMethod($controllerInstance, $methodName))->getParameters() as $arg) {
            $params[$arg->name] = $_GET[$arg->name] ?? null;
        }

        call_user_func_array([$controllerInstance, $methodName], $params);
    }
}
