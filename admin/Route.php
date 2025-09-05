<?php
/**
 * List of routes in the Admin environment
 */
$this->router->add('login-admin', '/admin/login', 'LoginController:form');
$this->router->add('logout', '/admin/logout', 'LogoutController:logout');
$this->router->add('auth-admin', '/admin/auth', 'LoginController:authAdmin', 'POST');
$this->router->add('dashboard', '/admin/', 'DashboardController:index');

// Pages Routes (GET)
$this->router->add('pages', '/admin/pages', 'PageController:listing');
$this->router->add('pages-create', '/admin/pages/create', 'PageController:create');
$this->router->add('pages-edit', '/admin/pages/(id:int)', 'PageController:edit');

// Pages Routes (POST)
$this->router->add('page-add', '/admin/pages/add', 'PageController:add', 'POST');
$this->router->add('page-update', '/admin/pages/update', 'PageController:update', 'POST');

// Posts Routes (GET)
$this->router->add('posts', '/admin/posts', 'PostController:listing');
$this->router->add('post-create', '/admin/posts/create', 'PostController:create');
$this->router->add('post-edit', '/admin/posts/(id:int)', 'PostController:edit');

// Posts Routes (POST)
$this->router->add('post-add', '/admin/posts/add', 'PostController:add', 'POST');
$this->router->add('post-update', '/admin/posts/update', 'PostController:update', 'POST');

// Settings Routes (GET)
$this->router->add('settings-general', '/admin/settings/general', 'SettingController:general');
$this->router->add('settings-appearance-themes', '/admin/settings/appearance/themes', 'SettingController:appearanceThemes');
$this->router->add('settings-appearance-menus', '/admin/settings/appearance/menus', 'SettingController:appearanceMenus');

// Settings Routes (POST)
$this->router->add('setting-update', '/admin/settings/update', 'SettingController:updateSetting', 'POST');
$this->router->add('setting-add-menu', '/admin/setting/ajaxMenuAdd', 'SettingController:ajaxMenuAdd', 'POST');
$this->router->add('setting-add-menu-item', '/admin/setting/ajaxMenuAddItem', 'SettingController:ajaxMenuAddItem', 'POST');
$this->router->add('setting-sort-menu-item', '/admin/setting/ajaxMenuSortItems', 'SettingController:ajaxMenuSortItems', 'POST');
$this->router->add('setting-remove-menu-item', '/admin/setting/ajaxMenuRemoveItem', 'SettingController:ajaxMenuRemoveItem', 'POST');
$this->router->add('setting-update-menu-item', '/admin/setting/ajaxMenuUpdateItem', 'SettingController:ajaxMenuUpdateItem', 'POST');
