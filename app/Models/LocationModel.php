<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'office_name', 'address', 'city', 'state', 'pin', 'phone', 'whatsapp',
        'email', 'google_maps_url', 'latitude', 'longitude', 'office_hours',
        'image', 'is_active', 'sort_order',
    ];

    public function getActive(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }
}
