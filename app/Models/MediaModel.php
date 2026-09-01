<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'file_name', 'file_path', 'file_type', 'file_size', 'alt_text',
        'width', 'height', 'folder', 'uploaded_by',
    ];

    /**
     * Get paginated media
     */
    public function getPaginated(int $perPage = 24, string $search = ''): array
    {
        $builder = $this->orderBy('created_at', 'DESC');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('file_name', $search)
                ->orLike('alt_text', $search)
                ->groupEnd();
        }

        $total = $builder->countAllResults(false);
        $data = $builder->paginate($perPage, 'default', $perPage);

        return ['data' => $data, 'total' => $total, 'pager' => $this->pager];
    }
}
