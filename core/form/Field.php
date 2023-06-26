<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';

    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
            <div>
                <label class="form-label" for="%s">%s</label>
                <input id="%s" type="%s" name="%s" value="%s" class="form-control %s">
                <div class="invalid-feedback">%s</div>
            </div>
            ',
            $this->attribute,
            $this->model->getLabel($this->attribute),
            $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }
}