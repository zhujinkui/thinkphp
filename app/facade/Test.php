<?php
namespace app\facade;
use think\Facade;

class Test extends Facade
{
    protected static function getFacadeClass()
    {
    	return 'app\index\controller\Test';
    }
}