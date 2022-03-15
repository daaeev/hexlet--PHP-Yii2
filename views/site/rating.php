<?php

use app\components\helpers\UrlGen;

$position = 1;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <h1><?= Yii::t('main', 'Рейтинг пользователей') ?></h1>

            <table class="my-5 table table-striped">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th><?= Yii::t('main', 'Количество лайков') ?></th>
                        <th><?= Yii::t('main', 'Пользователь') ?></th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $position ?></td>
                            <td><?= $user->likes_count ?></td>
                            <td><a href="<?= UrlGen::profile($user->id) ?>"><?= htmlspecialchars($user->name) ?></a></td>
                        </tr>
                    <?php $position++; endforeach ?>
                </tbody>
            </table>
        </div>

        <?= $this->renderFile('@app/views/partials/sidebar.php', ['answers' => $this->params['sidebar_elements']]) ?>

    </div>
</div>
<!-- CONTENT -->