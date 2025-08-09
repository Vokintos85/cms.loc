<?php

namespace Cms\Controller;

class HomeController extends CmsController
{
    public function index(): void
    {
        echo 'Index Page';
    }

    public function news($id = null): void
    {
        if ($id) {
            echo "Новость #" . $id;
        } else {
            echo "Список всех новостей";
        }
    }
}