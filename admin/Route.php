<?php

$this->router->add('login', '/admin/login', 'LoginController:form');
$this->router->add('logout', '/admin/logout', 'LogoutController:logout');
$this->router->add('auth-admin', '/admin/auth/', 'LoginController:authAdmin', 'POST');
$this->router->add('dashboard', '/admin/', 'DashboardController:index');
$this->router->add('pages', '/admin/pages', 'PageController:listing');
$this->router->add('pages-create', '/admin/pages/create', 'PageController:create');
$this->router->add('pages-edit', '/admin/pages/(id:int)', 'PageController:edit');

