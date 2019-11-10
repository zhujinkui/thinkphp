<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {
        $this->initBaseInfo();
    }

    /**
     * 验证数据
     * @access protected
     */
    protected function initBaseInfo()
    {
        $this->param           = $this->request->param();
        $this->module_name     = strtolower(app('http')->getName());
        $this->controller_name = strtolower($this->request->controller());
        $this->action_name     = strtolower($this->request->action());

        // 获取当前请求类型
        defined('METHOD') or define('METHOD', $this->request->method());
        // 判断是否GET请求
        defined('IS_GET') or define('IS_GET', $this->request->isGet());
        // 判断是否POST请求
        defined('IS_POST') or define('IS_POST', $this->request->isPost());
        // 判断是否PUT请求
        defined('IS_PUT') or define('IS_PUT', $this->request->isPut());
        // 判断是否DELETE请求
        defined('IS_DELETE') or define('IS_DELETE', $this->request->isDelete());
        // 判断是否AJAX请求
        defined('IS_AJAX') or define('IS_AJAX', $this->request->isAjax());
        // 判断是否PJAX请求
        defined('IS_PJAX') or define('IS_PJAX', $this->request->isPjax());
        // 判断是否JSON请求
        defined('IS_JSON') or define('IS_JSON', $this->request->isJson());
        // 判断是否手机访问
        defined('IS_MOBILE') or define('IS_MOBILE', $this->request->isMobile());
        // 判断是否HEAD请求
        defined('IS_HEAD') or define('IS_HEAD', $this->request->isHead());
        // 判断是否PATCH请求
        defined('IS_PATCH') or define('IS_PATCH', $this->request->isPatch());
        // 判断是否OPTIONS请求
        defined('IS_OPTIONS') or define('IS_OPTIONS', $this->request->isOptions());
        // 判断是否为CLI执行
        defined('IS_CLI') or define('IS_CLI', $this->request->isCli());
        // 判断是否为CGI模式
        defined('IS_CGI') or define('IS_CGI', $this->request->isCgi());
    }

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                list($validate, $scene) = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

}
