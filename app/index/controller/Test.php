<?php
declare (strict_types = 1);
namespace app\index\controller;

class Test
{
    public function hello($name = 'ThinkPHP')
    {
        return '这里是自定义的门面类' . $name;
    }
}
