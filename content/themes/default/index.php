<?php

/**
 * @var \Engine\Core\Template\Theme $theme
 */
?>

<?php $theme->header(); ?>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">Start Bootstrap</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="post.html">Sample Post</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('/content/themes/default/assets/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>
                            <?= \Engine\Core\Template\Theme::title() ?>
                        </h1>
                        <hr class="small">
                        <span class="subheading">
                            <?= \Engine\Core\Template\Theme::description() ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="/post.html">
                        <h2 class="post-title">
                            От трактора к коду: моя посадка в IT
                        </h2>
                        <h3 class="post-subtitle">
                            История успеха от агронома до IT-специалиста
                        </h3>
                    </a>
                    <p class="post-meta">
                        Posted by <a href="#">Сотников С. Н. (Gizya)</a> on September 5, 2025
                    </p>
                    <p>
                        Поле научило терпению, логи — наблюдательности. Посевы превратились в коммиты, урожай — в релизы.
                        Этот пост — о том, как «вспахать» путь в IT без потери здравого смысла и чувства юмора.
                    </p>
                </div>
                <hr>

                <div class="post-preview">
                    <a href="/post-caribbean-refactor.html">
                        <h2 class="post-title">
                            Карибский рефакторинг
                        </h2>
                        <h3 class="post-subtitle">
                            Как править код на палубе личной яхты (и не уронить ноутбук за борт)
                        </h3>
                    </a>
                    <p class="post-meta">
                        Posted by <a href="#">Gizya</a> on August 28, 2025
                    </p>
                    <p>
                        На остров — по воздуху, на прод — по CI/CD. Паранойю лечим тестами, выгорание — видом на лазурь.
                        Делюсь привычками, которые спасают проект и нервы.
                    </p>
                </div>
                <hr>

                <div class="post-preview">
                    <a href="/post-field-to-server.html">
                        <h2 class="post-title">
                            Поле и сервер больше похожи, чем кажется
                        </h2>
                        <h3 class="post-subtitle">
                            Что из агрономии реально работает в разработке
                        </h3>
                    </a>
                    <p class="post-meta">
                        Posted by <a href="#">Сотников С. Н.</a> on August 15, 2025
                    </p>
                    <p>
                        Севооборот → итерации, агротехника → инженерные практики, сезонность → релизные циклы.
                        Конкретные параллели и инструменты, которые масштабируются лучше, чем теплица.
                    </p>
                </div>
                <hr>

                <div class="post-preview">
                    <a href="/post-discipline.html">
                        <h2 class="post-title">
                            Будущее за теми, кто не боится пахать
                        </h2>
                        <h3 class="post-subtitle">
                            Дисциплина, которая довела от междурядий до микросервисов
                        </h3>
                    </a>
                    <p class="post-meta">
                        Posted by <a href="#">Gizya</a> on August 1, 2025
                    </p>
                    <p>
                        Ранний подъём, чистые грядки, проверенные инструменты — те же принципы держат прод в тонусе.
                        Чек-лист привычек, которые двигают карьеру быстрее попутного ветра.
                    </p>
                </div>

                <!-- Pager -->
                <hr>
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
                Хлебные крошки, заголовок страницы, header-фон — трогать не нужно: всё уже завязано на твои текущие классы и Theme::title()/description().

                Пример страницы поста (post.html) в тех же стилях
                Этот шаблон совместим с твоей темой: та же навигация, intro-header, разметка Bootstrap 3, классы из примера.

                <!-- Page Header -->
                <header class="intro-header" style="background-image: url('/content/themes/default/assets/img/post-bg.jpg')">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-10 ">
                                <div class="post-heading">
                                    <h3>От трактора к коду: моя посадка в IT</h3>
                                    <h4 class="subheading">История успеха от агронома до IT-специалиста</h4>
                                    <span class="meta">Posted by <a href="#">Сотников С. Н. (Gizya)</a> on September 5, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Post Content -->
                <article>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8  col-md-10 ">

                                <p>
                                    Поле — это система. Если не учитывать почву, погоду и сроки, урожай мимо.
                                    В разработке то же самое: домен, инфраструктура и процессы.
                                    Я просто перенёс привычную логику на новый «грунт».
                                </p>

                                <h2 class="section-heading">Посевы → коммиты</h2>
                                <p>
                                    Каждый посев — эксперимент. Коммит — тоже. Разница в скорости обратной связи:
                                    в IT можно узнать результат через минуты, а не сезоны.
                                    Это увлекает и дисциплинирует одновременно.
                                </p>

                                <blockquote>
                                    «Хочешь стабильный урожай — инвестируй в почву.
                                    Хочешь стабильный прод — инвестируй в инфраструктуру и тесты».
                                </blockquote>

                                <h2 class="section-heading">Междурядья → микросервисы</h2>
                                <p>
                                    Чёткая схема грядок спасает от хаоса. В коде — модули, границы контекстов,
                                    договорённости интерфейсов. Чем аккуратнее «междурядья», тем легче масштаб.
                                </p>

                                <h2 class="section-heading">Отпуск на своём острове</h2>
                                <p>
                                    Прилетев на собственный остров и отдыхая на личной яхте в Карибском море,
                                    ловлю себя на мысли: свобода — это когда твои системы работают без тебя.
                                    CI/CD крутит релизы, мониторинг поёт колыбельную, а ты просто смотришь на горизонт
                                    и записываешь идеи в блокнот.
                                </p>

                                <h2 class="section-heading">Практика</h2>
                                <ul>
                                    <li><strong>Севооборот задач:</strong> планируй короткие спринты, избегай «моно-культуры» фич.</li>
                                    <li><strong>Здоровая почва:</strong> вкладывайся в тесты, логи, алерты и документацию.</li>
                                    <li><strong>Метеосводка:</strong> следи за метриками, готовься к шторма́м заранее.</li>
                                    <li><strong>Инвентарь:</strong> простые инструменты, понятные пайплайны, единые стандарты.</li>
                                </ul>

                                <p>
                                    И да, иногда лучшее решение приходит, когда волна равняется с бортом.
                                    Главное — чтобы ноутбук был на страховке, а прод — на бэкапах.
                                </p>

                                <hr>
                                <p>
                                    <a href="/index.html">&larr; Вернуться на главную</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>


<?php $theme->footer(); ?>