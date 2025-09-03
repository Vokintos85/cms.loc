<?php $this->theme->header(); ?>

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
                <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                                type="button" role="tab" aria-controls="general" aria-selected="true">
                            General
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu"
                                type="button" role="tab" aria-controls="menu" aria-selected="false">
                            Menu
                        </button>
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

<?php $this->theme->footer(); ?>
