<?php

namespace kuaikuaicloud\oss;

use kuaikuaicloud\oss\Exception\SDKException;
use kuaikuaicloud\oss\Requests\AddBucketRequest;
use kuaikuaicloud\oss\Requests\GetBucketListsRequest;

/**
 * Class Client
 * @package oss
 * @method AddBucketRequest;
 * @method GetBucketListsRequest;
 */
class Client
{
    protected $config;

    /**
     * Client constructor.
     * @param array $config
     * @throws SDKException
     */
    public function __construct(array $config = [])
    {
        if (!empty($config)) foreach ($config as $property => $conf) {
            $this->$property = $conf;
        }
        $this->checkProperty();
        $this->config = $config;
    }

    /**
     * 检测配置项
     * @throws SDKException
     */
    protected function checkProperty()
    {
        $need = ['api_url', 'access_key', 'secret_key', 'version'];
        foreach ($need as $key) {
            if (empty($this->$key)) {
                throw new SDKException('params ' . $key .  ' is invalid');
            }
        }
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return property_exists($this, $name) ? $this->$name : '';
    }

    /**
     * @param $name
     * @param $arguments
     * @return Response
     * @throws SDKException
     */
    public function __call($name, $arguments)
    {
        $class = "\\kuaikuaicloud\\oss\\Requests\\" . ucfirst($name);
        if (!class_exists($class)) {
            throw new SDKException('this request is invalid, please check and try it again');
        }
        $arguments = current($arguments);
        $object = new $class($this->config, $arguments);
        return $object->handle();
    }

}