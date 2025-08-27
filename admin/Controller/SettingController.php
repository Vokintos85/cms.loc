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
}