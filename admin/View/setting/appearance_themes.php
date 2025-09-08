<?php $view->render('header'); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col page-title">
                <h3 class="py-3">Settings</h3>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/settings/general">
                            General
                        </a>
                    </li>

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle active" href="#" id="appearanceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Appearance — Themes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="appearanceDropdown">
                            <li><a class="dropdown-item active" href="/admin/settings/appearance/themes">Themes</a></li>
                            <li><a class="dropdown-item" href="/admin/settings/appearance/menus">Menus</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="settingsTabsContent">
                    <div class="row">
                        <?php foreach ($themes as $theme): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="<?= htmlspecialchars($theme['preview']) ?>"
                                         class="card-img-top"
                                         alt="<?= htmlspecialchars($theme['meta']['title']) ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($theme['meta']['title']) ?></h5>
                                        <p class="card-text text-muted">
                                            <?= htmlspecialchars($theme['meta']['description']) ?>
                                        </p>
                                        <ul class="list-unstyled small">
                                            <li><strong>Версия:</strong> <?= htmlspecialchars($theme['meta']['version']) ?></li>
                                            <li><strong>Slug:</strong> <?= htmlspecialchars($theme['slug']) ?></li>
                                        </ul>
                                    </div>


                                    <div class="card-footer text-end">
                                        <?php if ($theme_active === $theme['slug']): ?>
                                            <button class="btn btn-primary btn-sm disabled">Активировать</button>
                                        <?php else: ?>
                                            <form action="/admin/settings/appearance/themes/activate" method="post" class="d-inline">
                                                <input type="hidden" name="theme" value="<?= htmlspecialchars($theme['slug']) ?>">
                                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                                    Активировать
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php $view->render('footer'); ?>
