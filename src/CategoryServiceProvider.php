<?php

namespace Dcat\Admin\Category;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;

class CategoryServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];
    // 定义菜单
    protected $menu = [
        [
            'title' => '分类管理',
            'uri'   => 'category',
            'icon'  => '', // 图标可以留空
        ],
    ];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

		//

	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
