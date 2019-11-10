<?php
declare (strict_types = 1);
namespace app\index\controller;

class Error
{
    public function __call($method, $args)
    {
    	echo $method;
    	print_r($args);
    	exit;
        return '这是一个不存在的方法';
    }
}
