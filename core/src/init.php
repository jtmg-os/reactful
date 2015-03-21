<?php

namespace core;

class init
{
//@TODO: debug flag to be introduced and debug silencer added
    protected $models = 'apps';
    protected $view = null;
    protected $request, $response,$payload;

    public function __construct($request, $response,$payload)
    {

        $this->request = $request;
        $this->response = $response;
        $this->payload = $payload;
        $this->render();
    }

    private function bootstrap()
    {

        $route = $this->route();
        try {
            $model = $route[$this->request->getPath()];
        } catch (\Exception $e) {
            return $this->view = $this->handleError('500', $e->getMessage());
        }

        if (!isset($model['file'])) {
            return $this->view = $this->handleError('404', 'file not found');
        }
        try {
            require_once $this->models . DIRECTORY_SEPARATOR . $model['namespace'] . DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR . $model['file'];
        } catch (\Exception $e) {
            return $this->view = $this->handleError('404', $e->getMessage());
        }
        try {
            $className = $model['namespace'] . '\\' . $model['class'];
            $class = new $className();
            return $this->view = $this->methodMapper($class);
        } catch (\Exception $e) {
            return $this->view = $this->handleError('500', $e->getMessage());
        }
        return $class;
    }

    private function route()
    {
    $route = array();
    $apps = (include 'config/apps.php');
        foreach ($apps as $app)
        {
            $route = array_merge((include $app.'/config/route.php'),$route);
        }
    return $route;
    }

    private function handleError($code, $message)
    {
        return $this->view = ["status" => 'error', 'code' => $code, 'message' => $message];
    }

    private function methodMapper($class)
    {
        switch ($this->request->getMethod()) {
            case 'GET':
                return $class->read();
            case 'POST';
                return $class->create($this->payload);
            case 'PUT':
                return $class->update($this->payload);
            case 'DELETE';
                return $class->delete();
            case 'OPTIONS':
                break;
            default:
                return $this->handleError('405', 'method not allowed');
        }
        return;
    }

    private function render()
    {
        $this->bootstrap();
        $this->response->writeHead('200', array('Content-Type' => 'application/json'));
        $this->response->end(json_encode($this->view));
    }

}
