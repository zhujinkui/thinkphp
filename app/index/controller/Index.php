<?php
declare (strict_types = 1);
namespace app\index\controller;

use app\BaseController;
use think\facade\Event;
use think\facade\Config;

class Index extends BaseController
{
    protected $request;


    public function index()
    {
        echo '<pre/>';
        halt(Config::get());
    }

    public function hello($name)
    {
        return 'Hello,' . $name . '！This is '. $this->request->action();
    }
}
