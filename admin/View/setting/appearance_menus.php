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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="/admin/settings/general">
                            General
                        </a>
                    </li>

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle active" href="#" id="appearanceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <h4 class="heading-setting-section">
                                List menu
                                <a href="#" class="btn btn-primary"
                                   data-bs-toggle="modal" data-bs-target="#addMenu">
                                    Add Menu
                                </a>
                            </h4>
                            <?php if(!empty($menus)): ?>
                                <div class="menu-list">
                                    <ul class="nav flex-column">
                                        <?php foreach($menus as $menu): ?>
                                            <li class="nav-item">
                                                <a class="nav-link<?php if ($menuId == $menu->id) echo ' active'; ?>" href="?menu_id=<?php echo $menu->id ?>">
                                                    <?php echo $menu->name ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <div class="empty-items">
                                    <p>You do not have any menu created</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-8">
                            <?php if ($menuId !== null): ?>
                                <h4 class="heading-setting-section">
                                    Edit menu
                                </h4>
                                <br>
                                <input type="hidden" id="sortMenuId" value="<?php echo $menuId ?>" />
                                <ol id="listItems" class="edit-menu">
                                    <?php foreach($editMenu as $item) {
                                        $theme->block('setting/menu_item', [
                                            'item' => $item
                                        ]);
                                    } ?>
                                </ol>
                                <button class="add-item-button" onclick="menu.addItem(<?php echo $menuId ?>)">
                                    <i class="icon-plus icons"></i> Add menu item
                                </button>
                            <?php endif; ?>
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

<!-- Popup -->


<?php $this->theme->footer(); ?>
