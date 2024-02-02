<?php

class clsGenericProxy
{
    private $obj;
    private $handler;

    
    //public function __construct($target, callable $exceptionHandler = null)
    public function __construct($target, callable $exceptionHandler = null)
    {
        $this->obj = $target;
        $this->handler = $exceptionHandler;
    }
    
    /*
    public function __construct()
    {
        
    }

    public function add_class($class_name, $obj)
    {
        $this->obj[$class_name]=$obj;
    }

    public function get_class($class_name)
    {
        return $this->obj[$class_name];
    }

    public function add_exception(callable $exceptionHandler = null)
    {
        $this->handler = $exceptionHandler;
    }
    */
    /*
    public function __call($method, $arguments)
    {
        try {
            return call_user_func_array([$this->obj, $method], $arguments);
        } catch (Exception $e) {
            // catch all
            if ($this->handler) {
                throw call_user_func($this->handler, $e);
            } else {
                throw $e;
            }
        }
    }
    */
    public function __call($method, $arguments)
    {
        try {
            return call_user_func_array([$this->obj, $method], $arguments);
        } catch (Exception $e) {
            // catch all
            if ($this->handler) {
                throw call_user_func($this->handler, $e);
            } else {
               throw $e;
            }
        }
    }
}
/*
$proxy = new GenericProxy($something, function(Exception $e) {
    return new MyCoolException($e->getMessage(), $e->getCode(), $e);
});
echo $proxy->whatever_method($foo, $bar);
*/