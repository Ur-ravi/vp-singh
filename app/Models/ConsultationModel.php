<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsultationModel extends Model
{
    protected $table = 'consultations';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'booking_id', 'full_name', 'mobile', 'email', 'city', 'legal_matter',
        'consultation_mode', 'preferred_date', 'preferred_time', 'description',
        'amount', 'payment_status', 'booking_status', 'notes', 'ip_address',
    ];

    protected $validationRules = [
        'full_name' => 'required|max_length[255]',
        'mobile' => 'required|max_length[20]',
        'consultation_mode' => 'required|in_list[online,offline]',
    ];

    /**
     * Generate unique booking ID
     */
    public function generateBookingId(): string
    {
        return 'VP-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }

    /**
     * Get paginated consultations
     */
    public function getPaginated(int $perPage = 20, array $filters = []): array
    {
        $builder = $this->orderBy('created_at', 'DESC');

        if (!empty($filters['status'])) {
            $builder->where('booking_status', $filters['status']);
        }
        if (!empty($filters['payment_status'])) {
            $builder->where('payment_status', $filters['payment_status']);
        }
        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('full_name', $filters['search'])
                ->orLike('mobile', $filters['search'])
                ->orLike('booking_id', $filters['search'])
                ->groupEnd();
        }

        $total = $builder->countAllResults(false);
        $data = $builder->paginate($perPage, 'default', $perPage);

        return ['data' => $data, 'total' => $total, 'pager' => $this->pager];
    }
}
