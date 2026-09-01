<?php

namespace App\Libraries;

use App\Models\SettingModel;

class Settings
{
    protected static $settings = [];
    protected static $loaded = false;

    /**
     * Load all settings from database
     */
    public static function load(): void
    {
        if (self::$loaded) return;

        $model = new SettingModel();
        self::$settings = $model->getSettingsAsArray();
        self::$loaded = true;
    }

    /**
     * Get a setting value
     */
    public static function get(string $key, string $default = ''): string
    {
        if (!self::$loaded) {
            self::load();
        }
        return self::$settings[$key] ?? $default;
    }

    /**
     * Get all settings as array
     */
    public static function all(): array
    {
        if (!self::$loaded) {
            self::load();
        }
        return self::$settings;
    }

    /**
     * Get settings by group
     */
    public static function group(string $group): array
    {
        if (!self::$loaded) {
            self::load();
        }
        $result = [];
        foreach (self::$settings as $key => $value) {
            if (strpos($key, $group) === 0) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * Clear cache
     */
    public static function clear(): void
    {
        self::$settings = [];
        self::$loaded = false;
    }
}
