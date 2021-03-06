<?php

$this->title = Yii::t('main', 'Ошибка');
?>

<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <h1><?= Yii::t('main', 'Упс, а тут пусто') ?></h1>
            <p class="lead"><?= Yii::t('main', 'Такое бывает, когда страницу удалили или в адрес случайно закралась ошибка. Но ничего страшного, можно просто тыкнуть на любой пункт меню сверху и попасть-таки в нужное место.') ?></p>
        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->