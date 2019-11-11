<?php
declare (strict_types = 1);

namespace app\subscribe;
use think\Event;
use think\facade\Config;
use think\facade\App;

class AppInit
{
	protected $eventPrefix = 'AppInit';

	public function onAppInit()
    {
        // 定义项目入口路径
        define('PUBLIC_ROOT_PATH', root_path().'public'.DIRECTORY_SEPARATOR);

        // 定义模块名称
        $module_name = strtolower(app('http')->getName());

        $config = [
            'tpl_replace_string' => [
                '__ROOT__'        => root_path(),
                '__PUBLIC__'      => PUBLIC_ROOT_PATH,
                '__BASE__'        => PUBLIC_ROOT_PATH.'base',
                '__STATIC__'      => PUBLIC_ROOT_PATH.'static',
                '__LIBS__'        => PUBLIC_ROOT_PATH.'static'.DIRECTORY_SEPARATOR.'libs',
                '__MODULE_IMG__'  => $module_name.'images',
                '__MODULE_CSS__'  => $module_name.'css',
                '__MODULE_JS__'   => $module_name.'js'
            ]
        ];

        Config::set($config, 'view');

        // print_r(View::config());
        // MemberLogin事件响应处理
    }

    public function subscribe(Event $event)
    {
        $event->listen('AppInit', [$this,'onAppInit']);
    }
}
