<?php

namespace App\Controllers\Admin;

use App\Models\MediaModel;

class Media extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new MediaModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $result = $this->model->getPaginated(24, $search);

        $extraData = [
            'page_title' => 'Media Library',
            'media' => $result['data'],
            'total' => $result['total'],
            'pager' => $result['pager'],
            'search' => $search,
        ];
        return $this->adminView('media/index', $extraData);
    }

    public function upload()
    {
        $file = $this->request->getFile('file');
        if (!$file || !$file->isValid()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No file uploaded.']);
        }

        // Validate MIME type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
                        'application/pdf', 'video/mp4'];
        $mime = $file->getMimeType();

        if (!in_array($mime, $allowedTypes)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'File type not allowed. Allowed: ' . implode(', ', $allowedTypes),
            ]);
        }

        $uploadDir = ROOTPATH . 'public/uploads/media';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $newName = 'media_' . time() . '_' . bin2hex(random_bytes(8)) . '.' . $file->getExtension();
        $file->move($uploadDir, $newName, true);

        $data = [
            'file_name' => $file->getClientName(),
            'file_path' => 'uploads/media/' . $newName,
            'file_type' => $mime,
            'file_size' => $file->getSize(),
            'alt_text' => $this->request->getPost('alt_text'),
            'uploaded_by' => $this->auth->id(),
        ];

        $id = $this->model->insert($data);
        $media = $this->model->find($id);

        return $this->response->setJSON([
            'success' => true,
            'id' => $media->id,
            'path' => base_url('uploads/media/' . $newName),
            'file_name' => $media->file_name,
        ]);
    }

    public function delete(int $id)
    {
        $media = $this->model->find($id);
        if ($media) {                $filePath = ROOTPATH . 'public/' . $media->file_path;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->model->delete($id);
        }
        return redirect()->to('/admin/media')->with('success', 'Media deleted.');
    }

    public function update(int $id)
    {
        $this->model->update($id, [
            'alt_text' => $this->request->getPost('alt_text'),
        ]);
        return redirect()->back()->with('success', 'Media updated.');
    }
}
