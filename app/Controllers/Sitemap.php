<?php

namespace App\Controllers;

use App\Models\PracticeAreaModel;
use App\Models\BlogPostModel;
use App\Models\PageModel;

class Sitemap extends BaseController
{
    public function index()
    {
        $practiceAreaModel = new PracticeAreaModel();
        $blogModel = new BlogPostModel();
        $pageModel = new PageModel();

        $baseUrl = base_url();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static pages
        $staticPages = ['', 'about', 'practice-areas', 'blog', 'contact',
                        'online-legal-consultation', 'book-consultation',
                        'privacy-policy', 'terms-conditions', 'legal-disclaimer',
                        'refund-cancellation-policy', 'cookie-policy'];

        foreach ($staticPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . $baseUrl . '/' . $page . '</loc>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        // Practice areas
        foreach ($practiceAreaModel->getPublished() as $area) {
            $xml .= '<url>';
            $xml .= '<loc>' . $baseUrl . '/' . $area->slug . '</loc>';
            $xml .= '<lastmod>' . date('Y-m-d', strtotime($area->updated_at)) . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        // Blog posts
        foreach ($blogModel->getPublished(100) as $post) {
            $xml .= '<url>';
            $xml .= '<loc>' . $baseUrl . '/blog/' . $post->slug . '</loc>';
            $xml .= '<lastmod>' . date('Y-m-d', strtotime($post->updated_at)) . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.6</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return $this->response->setContentType('application/xml')->setBody($xml);
    }
}
