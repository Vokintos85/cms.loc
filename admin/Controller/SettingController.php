<?php

namespace Admin\Controller;

class SettingController extends AdminController
{
    public function general()
    {
        $settingsModel = $this->load->model('Setting');

        $this->data['settings'] = $settingsModel->repository->getSettings();

        $this->view->render('setting/general', $this->data);
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

    public function appearanceThemes()
    {
//        $this->load->model('Menu', false, 'Cms');
//        $this->load->model('MenuItem', false, 'Cms');
//
//        $this->data['menuId']   = $this->request->get['menu_id'];
//        $this->data['menus']    = $this->model->menu->getList();
//        $this->data['editMenu'] = $this->model->menuItem->getItems($this->data['menuId']);

        $this->view->render('setting/appearance_themes');
    }

    public function appearanceMenus()
    {
        $menuModel = $this->load->model('Menu', false, 'Cms');
        $menuItemModel = $this->load->model('MenuItem', false, 'Cms');

        $this->data['menuId']   = $this->request->get['menu_id'];
        $this->data['menus']    = $menuModel->repository->getList();
        $this->data['editMenu'] = $menuItemModel->repository->getItems($this->data['menuId'] ?? 0);

        $this->view->render('setting/appearance_menus', $this->data);
    }

    public function ajaxMenuAdd()
    {
        $params = $this->request->post;

        $model = $this->load->model('Menu', false, 'Cms');

        if (isset($params['name']) && strlen($params['name']) > 0) {
            $addMenu = $model->repository->add($params);

            $this->view->render('setting/_menu_Item', ['item' => $addMenu]);
        }
    }

    public function ajaxMenuAddItem()
    {
        $params = $this->request->post;

        $menuItemModel = $this->load->model('MenuItem', false, 'Cms');

        if (isset($params['menu_id']) && strlen($params['menu_id']) > 0) {
            $id = $menuItemModel->repository->add($params);

            $item = new \stdClass;
            $item->id   = $id;
            $item->name = \Cms\Model\MenuItem\MenuItemRepository::NEW_MENU_ITEM_NAME;
            $item->link = '#';

            $this->view->render('setting/_menu_Item', ['item' => $item]);
        }
    }

    public function ajaxMenuSortItems()
    {
        $params = $this->request->post;

        $menuItemModel = $this->load->model('MenuItem', false, 'Cms');

        if (isset($params['data']) && !empty($params['data'])) {
            $sortItem = $menuItemModel->repository->sort($params);
        }
    }

    public function ajaxMenuRemoveItem()
    {
        $params = $this->request->post;

        $menuItemModel = $this->load->model('MenuItem', false, 'Cms');

        if (isset($params['item_id']) && strlen($params['item_id']) > 0) {
            $removeItem = $menuItemModel->repository->remove($params['item_id']);

            echo $removeItem;
        }
    }

    public function updateSetting()
    {
        $this->load->model('Setting');

        $params = $this->request->post;

        $this->model->setting->update($params);
    }
}