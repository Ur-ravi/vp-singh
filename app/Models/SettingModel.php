<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'site_settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;

    protected $allowedFields = ['setting_key', 'setting_value', 'setting_group'];

    protected $validationRules = [
        'setting_key' => 'required|max_length[100]',
    ];

    protected $validationMessages = [
        'setting_key' => ['required' => 'Setting key is required.'],
    ];

    /**
     * Get a setting value by key
     */
    public function getSetting(string $key, string $default = '')
    {
        $row = $this->where('setting_key', $key)->first();
        return $row ? $row->setting_value : $default;
    }

    /**
     * Set a setting value
     */
    public function setSetting(string $key, $value, string $group = 'general'): bool
    {
        $existing = $this->where('setting_key', $key)->first();
        if ($existing) {
            return $this->update($existing->id, [
                'setting_value' => $value,
                'setting_group' => $group,
            ]);
        }
        return $this->insert([
            'setting_key' => $key,
            'setting_value' => $value,
            'setting_group' => $group,
        ]);
    }

    /**
     * Get all settings as key => value array
     */
    public function getSettingsAsArray(): array
    {
        $settings = $this->findAll();
        $result = [];
        foreach ($settings as $s) {
            $result[$s->setting_key] = $s->setting_value;
        }
        return $result;
    }

    /**
     * Get settings by group
     */
    public function getByGroup(string $group): array
    {
        return $this->where('setting_group', $group)->findAll();
    }
}
