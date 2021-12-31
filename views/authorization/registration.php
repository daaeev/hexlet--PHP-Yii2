<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/content.css" >
    <link rel="stylesheet" href="css/header.css" >
    <!------->

    <title>Hexlet</title>
</head>
<body>
    <header class="container-md navbar">
        <div class="left-block d-flex align-items-center">        
            <a class="navbar-brand link-dark" href="#">Hexlet CV</a>
            <div class="nav-menu">
                <a class="link link-dark" href="#">Резюме</a>
                <a class="link link-dark" href="#">Вакансии</a>
                <a class="link link-dark" href="#">Рейтинг</a>
            </div>
        </div>

        <div class="right-block d-flex align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link link-dark active" href="#">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark" href="#">Регистрация </a>
                </li>
            </ul>
        </div>
    </header>

<!-- CONTENT -->
<div class="row my-4">
    <div class="col-lg-5 col-md-8 mx-auto">
        <h2>Регистрация</h2>
        <form action="" method="post">
            <div class="form-inputs">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="user_email">Email <span title="обязательно">*</span></label>
                        <input class="form-control" autocomplete="email" autofocus="autofocus" type="email">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="user_password">Пароль <span title="обязательно">*</span></label>
                        <input class="form-control" autocomplete="current-password" type="password">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="user_password">Подтверждение пароля <span title="обязательно">*</span></label>
                        <input class="form-control" autocomplete="current-password" type="password">
                    </div>
                </div>
                <div class="mb-3">
                    <fieldset class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label">Запомнить меня</label>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="form-actions mb-3">
                <input type="submit" name="commit" value="Войти" class="btn btn-primary" data-disable-with="Войти">
            </div>
        </form>

        <a href="#">Регистрация</a><br>
        <a href="#">Забыли пароль?</a><br>
        <a rel="nofollow" data-method="post" href="#">Войти с помощью: GitHub</a><br>
    </div>
</div>
<!-- CONTENT -->

<footer class="bg-light border-top mt-auto py-5">
    <div class="container-md">
        <div class="row justify-content-lg-around">
            <div class="col-sm-6 col-md-4 col-lg-auto">
                <p class="fs-4 mb-2">Title</p>
                <ul class="list-unstyled">
                    <li><a href="#" class="link-dark">Link</a></li>
                    <li><a href="#" class="link-dark">Link</a></li>
                    <li><a href="#" class="link-dark">Link</a></li>
                </ul>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-auto">
                <p class="fs-4 mb-2">Title</p>
                <ul class="list-unstyled">
                    <li><a href="#" class="link-dark">Link</a></li>
                    <li><a href="#" class="link-dark">Link</a></li>
                    <li><a href="#" class="link-dark">Link</a></li>
                </ul>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-auto">
                <p class="fs-4 mb-2">Title</p>
                <ul class="list-unstyled">
                    <li><a href="#" class="link-dark">Link</a></li>
                    <li><a href="#" class="link-dark">Link</a></li>
                    <li><a href="#" class="link-dark">Link</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!------->
</body>
</html>