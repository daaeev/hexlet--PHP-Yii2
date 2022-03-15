<?php

use app\components\helpers\UrlGen;

?>
<!-- ASIDE -->
<aside class="col-md-3">
    <div class="bg-light rounded py-2 px-3">
        <p class="fs-4 mb-3"><?= Yii::t('main', 'Последние ответы') ?></p>

        <?php if ($answers): ?>
            <?php foreach ($answers as $answer): ?>
                <!-- CARD -->
                <div class="mb-4">
                    <p class="fw-bolder m-0"><a class="link-dark" href="<?= UrlGen::resume($answer->resume->id) ?>"><?= htmlspecialchars($answer->resume->title) ?></a></p>
                    <p class="small mb-1"><?= strip_tags(substr($answer->content, 0, 85)) ?>...</p>
                    <p class="small"><a href="<?= UrlGen::profile($answer->author_id) ?>" class="link-dark"><?= htmlspecialchars($answer->author->name) ?></a></p>
                </div>
                <!-- CARD -->
            <?php endforeach ?>
        <?php else: ?>
            <p class="text-center bg-light py-4 fw-light"><?= Yii::t('main', 'На данный момент, свежих ответов не найдено') ?></p>
        <?php endif ?>

    </div>
</aside>
<!-- ASIDE -->