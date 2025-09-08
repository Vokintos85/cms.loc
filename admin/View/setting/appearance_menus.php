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
                        <a class="nav-link " href="/admin/settings/general">
                            General
                        </a>
                    </li>

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle active" href="#" id="appearanceDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Appearance — Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="appearanceDropdown">
                            <li><a class="dropdown-item" href="/admin/settings/appearance/themes">Themes</a></li>
                            <li><a class="dropdown-item active" href="/admin/settings/appearance/menus">Menus</a></li>
                        </ul>
                    </li>
                </ul>


                <!-- Tabs content -->
                <div class="tab-content mt-3" id="settingsTabsContent">

                    <div class="row">
                        <div class="col-4">
                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">List menu</h4>
                                    <a href="#"
                                       class="btn btn-primary btn-sm"
                                       data-bs-toggle="modal" data-bs-target="#addMenu">
                                        Add Menu
                                    </a>
                                </div>

                                <?php if (!empty($menus)): ?>
                                    <!-- Прокрутка при длинном списке -->
                                    <div class="list-group list-group-flush overflow-auto" style="max-height: 420px;">
                                        <?php foreach ($menus as $menu):
                                            $isActive = ($menuId == $menu->id);
                                            ?>
                                            <a
                                                    href="?menu_id=<?php echo (int)$menu->id; ?>"
                                                    class="list-group-item list-group-item-action d-flex align-items-center <?php echo $isActive ? 'active' : ''; ?>"
                                                <?php echo $isActive ? 'aria-current="true"' : ''; ?>
                                                    title="<?php echo htmlspecialchars($menu->name, ENT_QUOTES, 'UTF-8'); ?>"
                                            >
            <span class="text-truncate w-100 d-inline-block">
              <?php echo htmlspecialchars($menu->name, ENT_QUOTES, 'UTF-8'); ?>
            </span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="card-body text-center text-body-secondary">
                                        <p class="mb-3">You do not have any menu created</p>
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenu">
                                            Create Menu
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="col-8">
                            <div class="card shadow-sm">

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Edit menu</h4>
                                </div>

                                <div class="p-3">
                                    <?php if ($menuId !== null): ?>

                                        <input type="hidden" id="sortMenuId" value="<?php echo $menuId ?>"/>

                                        <!-- список редактирования -->
                                        <ol id="listItems" class="edit-menu list-group list-group-flush">

                                            <?php foreach ($editMenu as $item): ?>
                                                <?php $view->render('setting/_menu_Item', ['item' => $item]); ?>
                                            <?php endforeach; ?>

                                        </ol>

                                        <!-- Кнопка добавления: ЧИСТЫЙ Bootstrap -->
                                        <button type="button"
                                                class="btn btn-primary mt-3 add-item-button"
                                                onclick="menu.addItem(<?php echo $menuId ?>)">
                                            <i class="icon-plus icons me-1"></i>
                                            Add menu item
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</main>


<!-- Popup -->
<div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuLabel">New menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="menuName" class="form-label">Name menu</label>
                        <input type="text" class="form-control" id="menuName">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="menu.add();">Save menu</button>
            </div>
        </div>
    </div>
</div>

<?php $view->render('footer'); ?>