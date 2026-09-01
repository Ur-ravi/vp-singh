<?php
/**
 * Router script for PHP's built-in development server.
 * Usage: php -S localhost:8080 public/router.php
 *
 * Routes all requests through CodeIgniter's front controller,
 * while serving static files directly if they exist.
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files directly if they exist
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Route everything else through CodeIgniter's front controller
require __DIR__ . '/index.php';
