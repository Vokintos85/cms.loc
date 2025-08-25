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
}