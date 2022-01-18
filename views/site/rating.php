<?php

use app\components\helpers\UrlGen;

$position = 1;

?>
<!-- CONTENT -->
<div class="container-md" id="content">
    <div class="row">
        <div class="col-md-9 content-block">
            <h1>Вакансии для разработчиков</h1>

            <table class="my-5 table table-striped">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Количество лайков</th>
                        <th>Пользователь</th>
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

        <!-- ASIDE -->
        <aside class="col-md-3">
            <div class="bg-light rounded py-2 px-3">
                <p class="fs-4 mb-3">Последние ответы</p>

                <!-- CARD -->
                <div class="mb-4">
                    <p class="fw-bolder m-0"><a class="link-dark" href="#">Lorem, ipsum dolor</a></p>
                    <p class="small mb-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem libero blanditiis, odit corporis unde ut.</p>
                    <p class="small"><a href="#" class="link-dark">Alina Kobeleva</a></p>
                </div>
                <!-- CARD -->

            </div>
        </aside>
        <!-- ASIDE -->

    </div>
</div>
<!-- CONTENT -->