<?php

namespace App\Controllers\Admin;

use App\Libraries\Settings;
use App\Models\SettingModel;

class Homepage extends BaseController
{
    public function index()
    {
        $model = new SettingModel();
        $groups = [
            'hero' => $model->getByGroup('hero'),
            'trust' => $model->getByGroup('trust'),
            'intro' => $model->getByGroup('intro'),
            'why_choose' => $model->getByGroup('why_choose'),
            'how_it_works' => $model->getByGroup('how_it_works'),
        ];

        $extraData = [
            'page_title' => 'Homepage Settings',
            'groups' => $groups,
        ];
        return $this->adminView('settings/homepage', $extraData);
    }

    public function save()
    {
        $model = new SettingModel();
        $post = $this->request->getPost();

        foreach ($post as $key => $value) {
            if ($key === 'csrf_token' || $key === '_method') continue;

            // Handle JSON fields
            if (in_array($key, ['trust_items', 'why_items', 'how_it_works'])) {
                $value = is_array($value) ? json_encode($value) : $value;
            }

            $model->setSetting($key, $value);
        }

        Settings::clear();

        return redirect()->back()->with('success', 'Homepage settings updated successfully.');
    }
}
