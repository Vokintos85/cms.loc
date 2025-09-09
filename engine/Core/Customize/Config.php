<?php
namespace Engine\Core\Customize;

class Config
{
    /**
     * @var array
     */
    protected array $config = [
        'dashboardMenu' => [
            [
                'url' => '/admin',
                'icon' => 'icon-speedometer icons',
                'title' => 'Home',
                'active' => true
            ],
            [
                'url' => '/admin/pages',
                'icon' => 'icon-doc icons',
                'title' => 'Pages',
                'active' => false
            ],
            [
                'url' => '/admin/posts',
                'icon' => 'icon-pencil icons',
                'title' => 'Posts',
                'active' => false
            ],
            [
                'url' => '/admin/plugins',
                'icon' => 'icon-puzzle icons',
                'title' => 'Plugins',
                'active' => false
            ],
            [
                'url' => '/admin/settings/general',
                'icon' => 'icon-equalizer icons',
                'title' => 'Settings',
                'active' => false
            ]
        ],
        'settingMenu' => [
            'general' => [
                'urlPath'   => '/backend/settings/general/',
                'title'     => 'General'
            ],
            'themes' => [
                'urlPath'   => '/backend/settings/appearance/themes/',
                'title'     => 'Themes'
            ],
            'menus' => [
                'urlPath'   => '/backend/settings/appearance/menus/',
                'title'     => 'Menus'
            ],
            'custom_fields' => [
                'urlPath'   => '/backend/settings/custom_fields/',
                'title'     => 'Custom Fields'
            ]
        ]
    ];

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->config[$key]);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->config[$key] : null;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->config[$key] = $value;
    }
}