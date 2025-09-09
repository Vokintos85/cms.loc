<?php

namespace Admin\Controller;

class PluginController extends AdminController
{
    public function pluginsPage()
    {
        $plugins = [
            [
                'name' => 'SEO Optimizer',
                'slug' => 'seo-optimizer',
                'description' => 'Improves website SEO by adding meta tags and sitemap.',
                'enabled' => true,
            ],
            [
                'name' => 'Image Compressor',
                'slug' => 'image-compressor',
                'description' => 'Automatically compresses uploaded images to save space.',
                'enabled' => false,
            ],
            [
                'name' => 'Security Guard',
                'slug' => 'security-guard',
                'description' => 'Provides firewall and login attempt protection.',
                'enabled' => true,
            ],
            [
                'name' => 'Analytics Tracker',
                'slug' => 'analytics-tracker',
                'description' => 'Tracks user visits and generates traffic reports.',
                'enabled' => false,
            ],
            [
                'name' => 'Backup Manager',
                'slug' => 'backup-manager',
                'description' => 'Creates scheduled backups of your site and database.',
                'enabled' => true,
            ],
        ];

        $this->view->render('plugins', [
            'plugins' => $plugins,
        ]);
    }

}
