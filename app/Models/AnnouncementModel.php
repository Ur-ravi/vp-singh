<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'text', 'cta_label', 'cta_url', 'start_date', 'end_date', 'is_active',
    ];

    /**
     * Get active announcements
     */
    public function getActive(): ?object
    {
        $now = date('Y-m-d');
        $builder = $this->where('is_active', 1);
        $builder->groupStart()
            ->where('start_date IS NULL')
            ->orWhere('start_date <=', $now)
            ->groupEnd();
        $builder->groupStart()
            ->where('end_date IS NULL')
            ->orWhere('end_date >=', $now)
            ->groupEnd();

        return $builder->first();
    }

    /**
     * Get all announcements for admin
     */
    public function getAll(): array
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
}
