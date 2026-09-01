<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table = 'payment_methods';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'method_type', 'label', 'qr_image', 'upi_id', 'account_holder',
        'bank_name', 'account_number', 'ifsc', 'branch', 'account_type',
        'instructions', 'is_enabled', 'sort_order',
    ];

    /**
     * Get enabled payment methods
     */
    public function getEnabled(): array
    {
        return $this->where('is_enabled', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Get enabled QR methods
     */
    public function getEnabledQR(): array
    {
        return $this->where('method_type', 'qr')
            ->where('is_enabled', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Get enabled bank transfer methods
     */
    public function getEnabledBank(): array
    {
        return $this->where('method_type', 'bank')
            ->where('is_enabled', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }
}
