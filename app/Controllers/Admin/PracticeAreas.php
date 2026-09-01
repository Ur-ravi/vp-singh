<?php

namespace App\Controllers\Admin;

use App\Models\PracticeAreaModel;

class PracticeAreas extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new PracticeAreaModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Practice Areas',
            'areas' => $this->model->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return $this->adminView('practice_areas/index', $extraData);
    }

    public function create()
    {
        $extraData = [
            'page_title' => 'Create Practice Area',
            'area' => null,
        ];
        return $this->adminView('practice_areas/form', $extraData);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'slug' => 'required|max_length[255]|is_unique[practice_areas.slug]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all required fields.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'short_description' => $this->request->getPost('short_description'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'image' => $this->uploadImage('image'),
            'cta_label' => $this->request->getPost('cta_label') ?: 'Explore This Practice',
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'seo_title' => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
        ];

        if ($this->model->insert($data)) {
            return redirect()->to('/admin/practice-areas')->with('success', 'Practice area created successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create practice area.');
    }

    public function edit(int $id)
    {
        $area = $this->model->find($id);
        if (!$area) {
            return redirect()->to('/admin/practice-areas')->with('error', 'Practice area not found.');
        }

        $extraData = [
            'page_title' => 'Edit Practice Area',
            'area' => $area,
        ];
        return $this->adminView('practice_areas/form', $extraData);
    }

    public function update(int $id)
    {
        $area = $this->model->find($id);
        if (!$area) {
            return redirect()->to('/admin/practice-areas')->with('error', 'Practice area not found.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'short_description' => $this->request->getPost('short_description'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'cta_label' => $this->request->getPost('cta_label'),
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'seo_title' => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
        ];

        $newImage = $this->uploadImage('image');
        if ($newImage) {
            $data['image'] = $newImage;
        }

        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/practice-areas')->with('success', 'Practice area updated successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update practice area.');
    }

    public function delete(int $id)
    {
        if ($this->model->delete($id)) {
            return redirect()->to('/admin/practice-areas')->with('success', 'Practice area deleted.');
        }
        return redirect()->to('/admin/practice-areas')->with('error', 'Failed to delete practice area.');
    }

    protected function uploadImage(string $fieldName): ?string
    {
        $file = $this->request->getFile($fieldName);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadDir = ROOTPATH . 'public/uploads/practice_areas';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = 'pa_' . time() . '_' . bin2hex(random_bytes(8)) . '.' . $file->getExtension();
            $file->move($uploadDir, $newName, true);
            return 'uploads/practice_areas/' . $newName;
        }
        return null;
    }
}
