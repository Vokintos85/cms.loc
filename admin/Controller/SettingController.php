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

    public function menus()
    {
        $this->load->model('Menu', false, 'Cms');
        $this->load->model('MenuItem', false, 'Cms');

        $this->data['menuId']   = $this->request->get['menu_id'];
        $this->data['menus']    = $this->model->menu->getList();
        $this->data['editMenu'] = $this->model->menuItem->getItems($this->data['menuId']);

        $this->view->render('setting/menus', $this->data);
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