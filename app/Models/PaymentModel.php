<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'consultation_id', 'client_name', 'mobile', 'amount', 'payment_method',
        'utr_number', 'screenshot', 'status', 'admin_notes', 'verified_at',
    ];

    public function getByConsultation(int $consultationId)
    {
        return $this->where('consultation_id', $consultationId)->first();
    }

    public function getPaginated(int $perPage = 20, array $filters = []): array
    {
        $builder = $this->orderBy('created_at', 'DESC');

        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }
        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('client_name', $filters['search'])
                ->orLike('mobile', $filters['search'])
                ->orLike('utr_number', $filters['search'])
                ->groupEnd();
        }

        $total = $builder->countAllResults(false);
        $data = $builder->paginate($perPage, 'default', $perPage);

        return ['data' => $data, 'total' => $total, 'pager' => $this->pager];
    }
}
