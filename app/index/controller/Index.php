<?php
declare (strict_types = 1);
namespace app\index\controller;

use app\BaseController;

class Index extends BaseController
{
    protected $request;


    public function index()
    {
        echo '<pre/>';
        print_r($this->param);
        halt($this->request);
    }

    public function hello($name)
    {
        return 'Hello,' . $name . '！This is '. $this->request->action();
    }
}
