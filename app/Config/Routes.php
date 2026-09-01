<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ============================================================
// FRONTEND ROUTES
// ============================================================

$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Contact::index');
$routes->post('/contact/submit', 'Contact::submit');

// Practice Areas
$routes->get('/practice-areas', 'PracticeAreas::index');

// Blog
$routes->get('/blog', 'Blog::index');
$routes->get('/blog/(:segment)', 'Blog::view/$1');

// Consultation
$routes->get('/online-legal-consultation', 'Consultation::index');
$routes->get('/book-consultation', 'Consultation::book');
$routes->post('/book-consultation', 'Consultation::store');
$routes->get('/payment/(:segment)', 'Consultation::payment/$1');
$routes->post('/payment/confirm', 'Consultation::confirmPayment');

// Legal Pages
$routes->get('/privacy-policy', 'Pages::view/privacy-policy');
$routes->get('/terms-conditions', 'Pages::view/terms-conditions');
$routes->get('/legal-disclaimer', 'Pages::view/legal-disclaimer');
$routes->get('/refund-cancellation-policy', 'Pages::view/refund-cancellation-policy');
$routes->get('/cookie-policy', 'Pages::view/cookie-policy');

// FAQ API
$routes->get('/api/faqs/(:alpha)/(:num)', 'Api::getFaqs/$1/$2');
$routes->get('/api/faqs/global', 'Api::getGlobalFaqs');

// Razorpay API (frontend)
$routes->post('/api/razorpay/create-order', 'Api::createRazorpayOrder');
$routes->post('/api/razorpay/verify', 'Api::verifyRazorpayPayment');

// Sitemap
$routes->get('/sitemap.xml', 'Sitemap::index');

// Catch-all practice area pages (MUST be last among frontend routes)
$routes->get('/(:segment)', 'PracticeAreas::view/$1');

// ============================================================
// ADMIN ROUTES
// ============================================================

$routes->group('admin', function ($routes) {

    // Auth
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::doLogin');
    $routes->get('logout', 'Admin\Auth::logout');

    // All admin routes require authentication
    $routes->group('', ['filter' => 'adminauth'], function ($routes) {

        // Dashboard
        $routes->get('/', 'Admin\Dashboard::index');
        $routes->get('dashboard', 'Admin\Dashboard::index');

        // Homepage Settings
        $routes->get('homepage', 'Admin\Homepage::index');
        $routes->post('homepage/save', 'Admin\Homepage::save');

        // Pages
        $routes->get('pages', 'Admin\Pages::index');
        $routes->get('pages/create', 'Admin\Pages::create');
        $routes->post('pages/store', 'Admin\Pages::store');
        $routes->get('pages/edit/(:num)', 'Admin\Pages::edit/$1');
        $routes->post('pages/update/(:num)', 'Admin\Pages::update/$1');
        $routes->post('pages/delete/(:num)', 'Admin\Pages::delete/$1');

        // Policy Pages
        $routes->get('policy-pages', 'Admin\PolicyPages::index');
        $routes->get('policy-pages/edit/(:segment)', 'Admin\PolicyPages::edit/$1');
        $routes->post('policy-pages/save', 'Admin\PolicyPages::save');
        $routes->get('policy-pages/toggle/(:segment)', 'Admin\PolicyPages::toggle/$1');
        $routes->post('policy-pages/delete/(:segment)', 'Admin\PolicyPages::delete/$1');

        // Navigation
        $routes->get('navigation', 'Admin\Navigation::index');
        $routes->post('navigation/store', 'Admin\Navigation::store');
        $routes->post('navigation/update/(:num)', 'Admin\Navigation::update/$1');
        $routes->post('navigation/delete/(:num)', 'Admin\Navigation::delete/$1');
        $routes->post('navigation/item/store', 'Admin\Navigation::storeItem');
        $routes->post('navigation/item/update/(:num)', 'Admin\Navigation::updateItem/$1');
        $routes->post('navigation/item/delete/(:num)', 'Admin\Navigation::deleteItem/$1');

        // Advocate Profile
        $routes->get('advocate/profile', 'Admin\Advocate::index');
        $routes->post('advocate/profile/save', 'Admin\Advocate::save');

        // Practice Areas
        $routes->get('practice-areas', 'Admin\PracticeAreas::index');
        $routes->get('practice-areas/create', 'Admin\PracticeAreas::create');
        $routes->post('practice-areas/store', 'Admin\PracticeAreas::store');
        $routes->get('practice-areas/edit/(:num)', 'Admin\PracticeAreas::edit/$1');
        $routes->post('practice-areas/update/(:num)', 'Admin\PracticeAreas::update/$1');
        $routes->post('practice-areas/delete/(:num)', 'Admin\PracticeAreas::delete/$1');

        // Blog
        $routes->get('blog', 'Admin\Blog::index');
        $routes->get('blog/create', 'Admin\Blog::create');
        $routes->post('blog/store', 'Admin\Blog::store');
        $routes->get('blog/edit/(:num)', 'Admin\Blog::edit/$1');
        $routes->post('blog/update/(:num)', 'Admin\Blog::update/$1');
        $routes->post('blog/delete/(:num)', 'Admin\Blog::delete/$1');
        $routes->get('blog/categories', 'Admin\Blog::categories');
        $routes->post('blog/categories/store', 'Admin\Blog::storeCategory');
        $routes->post('blog/categories/delete/(:num)', 'Admin\Blog::deleteCategory/$1');
        $routes->get('blog/tags', 'Admin\Blog::tags');
        $routes->post('blog/tags/store', 'Admin\Blog::storeTag');
        $routes->post('blog/tags/delete/(:num)', 'Admin\Blog::deleteTag/$1');

        // FAQs
        $routes->get('faqs', 'Admin\Faqs::index');
        $routes->get('faqs/create', 'Admin\Faqs::create');
        $routes->post('faqs/store', 'Admin\Faqs::store');
        $routes->get('faqs/edit/(:num)', 'Admin\Faqs::edit/$1');
        $routes->post('faqs/update/(:num)', 'Admin\Faqs::update/$1');
        $routes->post('faqs/delete/(:num)', 'Admin\Faqs::delete/$1');

        // Testimonials
        $routes->get('testimonials', 'Admin\Testimonials::index');
        $routes->get('testimonials/create', 'Admin\Testimonials::create');
        $routes->post('testimonials/store', 'Admin\Testimonials::store');
        $routes->get('testimonials/edit/(:num)', 'Admin\Testimonials::edit/$1');
        $routes->post('testimonials/update/(:num)', 'Admin\Testimonials::update/$1');
        $routes->post('testimonials/delete/(:num)', 'Admin\Testimonials::delete/$1');

        // Locations
        $routes->get('locations', 'Admin\Locations::index');
        $routes->get('locations/create', 'Admin\Locations::create');
        $routes->post('locations/store', 'Admin\Locations::store');
        $routes->get('locations/edit/(:num)', 'Admin\Locations::edit/$1');
        $routes->post('locations/update/(:num)', 'Admin\Locations::update/$1');
        $routes->post('locations/delete/(:num)', 'Admin\Locations::delete/$1');

        // Consultations
        $routes->get('consultations', 'Admin\Consultations::index');
        $routes->get('consultations/view/(:num)', 'Admin\Consultations::view/$1');
        $routes->post('consultations/update/(:num)', 'Admin\Consultations::update/$1');

        // Payments
        $routes->get('payments', 'Admin\Payments::index');
        $routes->get('payments/view/(:num)', 'Admin\Payments::view/$1');
        $routes->post('payments/update/(:num)', 'Admin\Payments::update/$1');
        $routes->get('payments/settings', 'Admin\Payments::settings');
        $routes->post('payments/settings/save', 'Admin\Payments::saveSettings');
        $routes->post('payments/settings/razorpay/save', 'Admin\Payments::saveRazorpay');
        $routes->get('payments/qr', 'Admin\Payments::qr');
        $routes->post('payments/qr/store', 'Admin\Payments::storeQR');
        $routes->post('payments/qr/update/(:num)', 'Admin\Payments::updateQR/$1');
        $routes->post('payments/qr/delete/(:num)', 'Admin\Payments::deleteQR/$1');
        $routes->get('payments/bank', 'Admin\Payments::bank');
        $routes->post('payments/bank/store', 'Admin\Payments::storeBank');
        $routes->post('payments/bank/update/(:num)', 'Admin\Payments::updateBank/$1');
        $routes->post('payments/bank/delete/(:num)', 'Admin\Payments::deleteBank/$1');

        // Enquiries
        $routes->get('enquiries', 'Admin\Enquiries::index');
        $routes->get('enquiries/view/(:num)', 'Admin\Enquiries::view/$1');
        $routes->post('enquiries/update/(:num)', 'Admin\Enquiries::update/$1');
        $routes->post('enquiries/delete/(:num)', 'Admin\Enquiries::delete/$1');

        // Media Library
        $routes->get('media', 'Admin\Media::index');
        $routes->post('media/upload', 'Admin\Media::upload');
        $routes->post('media/delete/(:num)', 'Admin\Media::delete/$1');
        $routes->post('media/update/(:num)', 'Admin\Media::update/$1');

        // Settings
        $routes->get('settings', 'Admin\Settings::general');
        $routes->post('settings/save', 'Admin\Settings::saveGeneral');
        $routes->get('settings/social', 'Admin\Settings::social');
        $routes->post('settings/social/save', 'Admin\Settings::saveSocial');
        $routes->get('settings/footer', 'Admin\Settings::footer');
        $routes->post('settings/footer/save', 'Admin\Settings::saveFooter');

        // Announcements
        $routes->get('announcements', 'Admin\Announcements::index');
        $routes->get('announcements/create', 'Admin\Announcements::create');
        $routes->post('announcements/store', 'Admin\Announcements::store');
        $routes->get('announcements/edit/(:num)', 'Admin\Announcements::edit/$1');
        $routes->post('announcements/update/(:num)', 'Admin\Announcements::update/$1');
        $routes->post('announcements/delete/(:num)', 'Admin\Announcements::delete/$1');

        // Users (Super Admin only)
        $routes->group('users', ['filter' => 'adminauth:super_admin'], function ($routes) {
            $routes->get('/', 'Admin\Users::index');
            $routes->get('create', 'Admin\Users::create');
            $routes->post('store', 'Admin\Users::store');
            $routes->get('edit/(:num)', 'Admin\Users::edit/$1');
            $routes->post('update/(:num)', 'Admin\Users::update/$1');
            $routes->post('delete/(:num)', 'Admin\Users::delete/$1');
        });
    });
});
