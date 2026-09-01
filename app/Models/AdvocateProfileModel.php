<?php

namespace App\Models;

use CodeIgniter\Model;

class AdvocateProfileModel extends Model
{
    protected $table = 'advocate_profile';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'name', 'designation', 'biography', 'profile_image', 'education',
        'experience', 'court_info', 'practice_area_ids', 'memberships', 'credentials',
    ];

    /**
     * Get the advocate profile (single row)
     */
    public function getProfile()
    {
        return $this->first();
    }
}
