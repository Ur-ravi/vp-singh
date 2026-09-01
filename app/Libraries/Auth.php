<?php

namespace App\Libraries;

use App\Models\UserModel;

class Auth
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new UserModel();
    }

    /**
     * Attempt login
     */
    public function attempt(string $email, string $password): bool
    {
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (!$user->is_active) {
            return false;
        }

        if (!password_verify($password, $user->password_hash)) {
            return false;
        }

        // Set session
        $this->session->set([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_role' => $user->role,
            'user_username' => $user->username,
            'is_logged_in' => true,
        ]);

        // Update last login
        $this->userModel->update($user->id, [
            'last_login' => date('Y-m-d H:i:s'),
        ]);

        return true;
    }

    /**
     * Check if user is logged in
     */
    public function check(): bool
    {
        return $this->session->get('is_logged_in') === true;
    }

    /**
     * Get current user
     */
    public function user()
    {
        if (!$this->check()) {
            return null;
        }
        return $this->userModel->find($this->session->get('user_id'));
    }

    /**
     * Get user ID
     */
    public function id(): ?int
    {
        return $this->session->get('user_id');
    }

    /**
     * Get user role
     */
    public function role(): ?string
    {
        return $this->session->get('user_role');
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role() === 'super_admin';
    }

    /**
     * Logout
     */
    public function logout(): void
    {
        $this->session->destroy();
    }

    /**
     * Attempt login with throttling
     */
    public function attemptWithThrottle(string $email, string $password): array
    {
        $throttleKey = 'login_attempts_' . md5($email);
        $attempts = $this->session->get($throttleKey) ?? 0;

        // Check lockout (5 minutes after 5 failed attempts)
        if ($attempts >= 5) {
            $lockoutTime = $this->session->get($throttleKey . '_time') ?? 0;
            if (time() - $lockoutTime < 300) {
                return [
                    'success' => false,
                    'message' => 'Too many failed attempts. Please try again in ' . ceil((300 - (time() - $lockoutTime)) / 60) . ' minutes.',
                ];
            }
            // Reset after lockout period
            $this->session->remove($throttleKey);
            $this->session->remove($throttleKey . '_time');
            $attempts = 0;
        }

        $result = $this->attempt($email, $password);

        if (!$result) {
            $attempts++;
            $this->session->set($throttleKey, $attempts);
            if ($attempts === 1) {
                $this->session->set($throttleKey . '_time', time());
            }
            return [
                'success' => false,
                'message' => 'Invalid email or password.',
            ];
        }

        // Reset on success
        $this->session->remove($throttleKey);
        $this->session->remove($throttleKey . '_time');

        return [
            'success' => true,
            'message' => 'Login successful.',
        ];
    }
}
