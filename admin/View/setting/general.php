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
                    <form method="post" action="/admin/settings/general">
                        <?php foreach ($settings as $setting): ?>
                            <div class="form-group row">

                                <?php if ($setting->key_field === 'language'): ?>
                                    <label for="formLangSite" class="col-2 col-form-label">
                                        Language
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control" id="formLangSite" name="<?= $setting->key_field ?>">
                                            <option value="en" <?= $setting->value === 'en' ? 'selected' : '' ?>>English</option>
                                            <option value="ru" <?= $setting->value === 'ru' ? 'selected' : '' ?>>Русский</option>
                                        </select>
                                    </div>
                                <?php else: ?>
                                    <label for="formNameSite" class="col-2 col-form-label">
                                        <?= $setting->name; ?>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="<?= $setting->key_field ?>" value="<?= $setting->value ?>" id="formNameSite">
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php $this->theme->footer(); ?>