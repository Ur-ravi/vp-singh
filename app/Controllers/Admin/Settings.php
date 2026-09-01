<?php

namespace App\Controllers\Admin;

use App\Models\SettingModel;
use App\Libraries\Settings as SettingsLib;

class Settings extends BaseController
{
    public function general()
    {
        $model = new SettingModel();
        $settings = $model->getByGroup('general');
        $extraData = [
            'page_title' => 'General Settings',
            'settings' => $settings,
        ];
        return $this->adminView('settings/general', $extraData);
    }

    public function saveGeneral()
    {
        $model = new SettingModel();
        $post = $this->request->getPost();

        foreach ($post as $key => $value) {
            if ($key === 'csrf_token' || $key === '_method') continue;
            $model->setSetting($key, $value, 'general');
        }

        // Handle file uploads
        foreach (['logo', 'favicon'] as $field) {
            $file = $this->request->getFile($field);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $uploadDir = ROOTPATH . 'public/uploads/images';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $newName = $field . '_' . time() . '.' . $file->getExtension();
                $file->move($uploadDir, $newName, true);
                $model->setSetting($field, 'uploads/images/' . $newName, 'general');
            }
        }

        SettingsLib::clear();
        return redirect()->back()->with('success', 'General settings saved.');
    }

    public function social()
    {
        $model = new SettingModel();
        $settings = $model->getByGroup('social');
        $extraData = [
            'page_title' => 'Social Media Settings',
            'settings' => $settings,
        ];
        return $this->adminView('settings/social', $extraData);
    }

    public function saveSocial()
    {
        $model = new SettingModel();
        $post = $this->request->getPost();

        foreach ($post as $key => $value) {
            if ($key === 'csrf_token' || $key === '_method') continue;
            $model->setSetting($key, $value, 'social');
        }

        SettingsLib::clear();
        return redirect()->back()->with('success', 'Social media settings saved.');
    }

    public function footer()
    {
        $model = new SettingModel();
        $settings = $model->getByGroup('footer');
        $extraData = [
            'page_title' => 'Footer Settings',
            'settings' => $settings,
        ];
        return $this->adminView('settings/footer', $extraData);
    }

    public function saveFooter()
    {
        $model = new SettingModel();
        $post = $this->request->getPost();

        foreach ($post as $key => $value) {
            if ($key === 'csrf_token' || $key === '_method') continue;
            $model->setSetting($key, $value, 'footer');
        }

        SettingsLib::clear();
        return redirect()->back()->with('success', 'Footer settings saved.');
    }
}
