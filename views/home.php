<?php

use app\core\form\Form;
use app\models\Message;

/** @var $model Message */
?>
<h1>Hello type you message bellow</h1>
<?php $form = Form::begin('', 'post'); ?>
    <?php echo $form->field($model, 'message') ?>
    <button type="submit" class="btn btn-primary">submit</button>
<?php echo Form::end(); ?>
