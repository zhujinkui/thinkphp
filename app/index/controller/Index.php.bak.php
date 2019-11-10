<?php
declare (strict_types = 1);
namespace app\index\controller;

use think\Request;
//use app\middleware\Check;
use app\facade\Test;

class Index
{
    //protected $middleware = [Check::class];
    protected $middleware = ['\app\middleware\Check'];

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        echo '这里是输出中间定义的'.$this->request->hello; // ThinkPHP
        echo '<br/>';
        echo Test::hello('Test类');
        echo '<br/>';
    	halt($this->request);
        echo '<br/>';
        return '您好！这是一个[index]示例应用';
    }

    public function hello($name)
    {
        return 'Hello,' . $name . '！This is '. $this->request->action();
    }
}
