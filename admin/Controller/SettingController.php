<?php

namespace Admin\Controller;

use Engine\Core\Template\Theme;

class SettingController extends AdminController
{
    public function general()
    {
        $settingsModel = $this->load->model('Setting');

        $this->data['settings'] = $settingsModel->repository->getSettings();

        $this->view->render('setting/general', $this->data);
    }

    public function menus()
    {
        $this->load->model('Menu', false, 'Cms');
        $this->load->model('MenuItem', false, 'Cms');

        $this->data['menuId']   = $this->request->get['menu_id'];
        $this->data['menus']    = $this->model->menu->getList();
        $this->data['editMenu'] = $this->model->menuItem->getItems($this->data['menuId']);

        $this->view->render('setting/menus', $this->data);
    }

    public function ajaxMenuAdd()
    {
        $params = $this->request->post;

        $this->load->model('Menu', false, 'Cms');

        if (isset($params['name']) && strlen($params['name']) > 0) {
            $addMenu = $this->model->menu->add($params);

            echo $addMenu;
        }

        public function ajaxMenuAddItem()
    {
        $params = $this->request->post;

        $this->load->model('MenuItem', false, 'Cms');

        if (isset($params['menu_id']) && strlen($params['menu_id']) > 0) {
            $id = $this->model->menuItem->add($params);

            $item = new \stdClass;
            $item->id   = $id;
            $item->name = \Cms\Model\MenuItem\MenuItem\MenuItemRepository::NEW_MENU_ITEM_NAME;
            $item->link = '#';

            Theme::block('setting/menu_item', [
                'item' => $item
            ]);
        }
    }

    public function saveGeneral()
    {
        $data = $this->request->post;

        $settingsModel = $this->load->model('Setting');

        foreach ($data as $name => $value) {
            $settingsModel->repository->update($name, $value);
        }

        header('Location: /admin/settings/general');
    }
}