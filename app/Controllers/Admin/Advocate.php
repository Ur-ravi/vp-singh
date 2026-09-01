<?php

namespace App\Controllers\Admin;

use App\Models\AdvocateProfileModel;

class Advocate extends BaseController
{
    public function index()
    {
        $model = new AdvocateProfileModel();
        $extraData = [
            'page_title' => 'Advocate Profile',
            'profile' => $model->getProfile(),
            'practice_areas' => (new \App\Models\PracticeAreaModel())->findAll(),
        ];
        return $this->adminView('advocate/profile', $extraData);
    }

    public function save()
    {
        $model = new AdvocateProfileModel();
        $profile = $model->getProfile();

        $data = [
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'biography' => $this->request->getPost('biography'),
            'education' => $this->request->getPost('education'),
            'experience' => $this->request->getPost('experience'),
            'court_info' => $this->request->getPost('court_info'),
            'practice_area_ids' => json_encode($this->request->getPost('practice_area_ids') ?: []),
            'memberships' => $this->request->getPost('memberships'),
            'credentials' => $this->request->getPost('credentials'),
        ];

        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadDir = ROOTPATH . 'public/uploads/avatars';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = 'avatar_' . time() . '.' . $file->getExtension();
            $file->move($uploadDir, $newName, true);
            $data['profile_image'] = 'uploads/avatars/' . $newName;
        }

        if ($profile) {
            $model->update($profile->id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
