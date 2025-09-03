<?php $theme->header(); ?>

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

                    Themes

                </div>
            </div>
        </div>
    </div>
</main>

<?php $theme->footer(); ?>
