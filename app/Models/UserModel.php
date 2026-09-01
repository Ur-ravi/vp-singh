<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;

    protected $allowedFields = ['email', 'username', 'password_hash', 'role', 'is_active', 'last_login'];

    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username' => 'permit_empty|is_unique[users.username,id,{id}]',
        'password_hash' => 'required|min_length[6]',
    ];

    protected $validationMessages = [
        'email' => ['required' => 'Email is required.', 'is_unique' => 'This email is already registered.'],
        'password_hash' => ['required' => 'Password is required.', 'min_length' => 'Password must be at least 6 characters.'],
    ];

    /**
     * Find user by email
     */
    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(int $userId): bool
    {
        $user = $this->find($userId);
        return $user && $user->role === 'super_admin';
    }
}
