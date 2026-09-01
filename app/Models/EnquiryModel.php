<?php

namespace App\Models;

use CodeIgniter\Model;

class EnquiryModel extends Model
{
    protected $table = 'enquiries';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'name', 'phone', 'email', 'city', 'subject', 'legal_matter',
        'message', 'source_page', 'status', 'admin_notes', 'ip_address',
    ];

    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'message' => 'required',
    ];

    /**
     * Get paginated enquiries
     */
    public function getPaginated(int $perPage = 20, array $filters = []): array
    {
        $builder = $this->orderBy('created_at', 'DESC');

        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }
        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('name', $filters['search'])
                ->orLike('phone', $filters['search'])
                ->orLike('email', $filters['search'])
                ->groupEnd();
        }

        $total = $builder->countAllResults(false);
        $data = $builder->paginate($perPage, 'default', $perPage);

        return ['data' => $data, 'total' => $total, 'pager' => $this->pager];
    }
}
