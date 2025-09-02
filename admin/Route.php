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
$this->router->add('setting-menus', '/admin/settings/appearance/mkenus/', 'SettingController:menus');
$this->router->add('settings-general-save', '/admin/settings/general', 'SettingController:saveGeneral', 'POST');
$this->router->add('settings-add-menu', '/admin/settings/ajaxMenuAdd', 'SettingController:ajaxMenuAdd', 'POST');
$this->router->add('settings-add-menu-item', '/admin/settings/ajaxMenuAddItem', 'SettingController:ajaxMenuAddItem', 'POST');
