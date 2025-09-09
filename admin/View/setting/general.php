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
                        <a class="nav-link active" href="/admin/settings/general/">
                            General
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="#"
                           id="appearanceDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Appearance
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="appearanceDropdown">
                            <li><a class="dropdown-item" href="/admin/settings/appearance/themes">Themes</a></li>
                            <li><a class="dropdown-item" href="/admin/settings/appearance/menus">Menus</a></li>
                        </ul>
                    </li>
                </ul>


                <!-- Tabs content -->
                <div class="tab-content mt-3" id="settingsTabsContent">

                    <!-- General -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <form method="post" action="/admin/settings/general">
                            <?php foreach ($settings as $setting): ?>
                                <div class="row mb-3">
                                    <?php if ($setting->key_field === 'language'): ?>
                                        <label for="formLangSite" class="col-sm-2 col-form-label">Language</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="formLangSite" name="<?= $setting->key_field ?>">
                                                <option value="en" <?= $setting->value === 'en' ? 'selected' : '' ?>>English</option>
                                                <option value="ru" <?= $setting->value === 'ru' ? 'selected' : '' ?>>Русский</option>
                                            </select>
                                        </div>
                                    <?php else: ?>
                                        <label for="form_<?= $setting->key_field ?>" class="col-sm-2 col-form-label"><?= $setting->name; ?></label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text"
                                                   name="<?= $setting->key_field ?>"
                                                   value="<?= $setting->value ?>"
                                                   id="form_<?= $setting->key_field ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>

                    <!-- Menu -->
                    <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                        <p>Здесь будет настройка меню.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?php $view->render('footer'); ?>