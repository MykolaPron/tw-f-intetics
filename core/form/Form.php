<?php
namespace app\core\form;

use app\core\Application;
use app\core\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        echo sprintf('<input type="hidden" name="token" value="%s">', Application::$app->session->generateToken());

        return new Form();
    }

    public static function end(): void
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }
}