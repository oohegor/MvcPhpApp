<?php

declare(strict_types=1);

abstract class Controller
{
    public  function processInputData(string $data): string
    {
        return htmlspecialchars($data,ENT_QUOTES, 'UTF-8');
    }

    public function model(string $modelName): Model
    {
        require_once '../models/' . $modelName . '.php';

        return new $modelName();
    }

    public function view(string $viewName, array $data = []): void
    {
        if (file_exists('../views/' . $viewName . '.php')) {
            require_once '../views/' . $viewName . '.php';
        } else {
            die("View does not exists.");
        }
    }
}
