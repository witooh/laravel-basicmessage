<?php

namespace Witooh\BasicMessage;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Collection;

class ResMsg
{
    const SUCCESS    = 200;
    const ERROR      = 500;
    const VALIDATION = 501;
    const PERMISSION = 400;
    const AUTH       = 401;

    /** @var \Illuminate\Support\Collection */
    protected $data;

    /** @var string */
    protected $status;

    /** @var int */
    protected $code;

    /** @var MessageBag */
    protected $error;

    function __construct()
    {
        $this->status = null;
        $this->code   = null;
        $this->error  = null;
        $this->data   = null;
    }

    /**
     * @param $code
     * @return bool
     */
    public function is($code)
    {
        return $this->code === $code ? true : false;
    }

    /**
     * @param string $errorMessage
     * @param \Illuminate\Support\Collection|array|null $data
     * @return $this
     */
    public function error($errorMessage, $data = null)
    {
        $this->status = 'error';
        $this->code   = static::ERROR;
        $this->error  = new MessageBag();
        $this->error->add('error', $errorMessage);
        $this->setData($data);

        return $this;
    }

    /**
     * @param \Illuminate\Support\Collection|array|null $data
     * @return ResMsg $this
     */
    public function success($data = null)
    {
        $this->status = 'success';
        $this->code   = static::SUCCESS;
        $this->error  = null;
        $this->setData($data);

        return $this;
    }

    /**
     * @param MessageBag $errors
     * @param \Illuminate\Support\Collection $data
     * @return ResMsg $this
     */
    public function validation($errors, Collection $data = null)
    {
        $this->status = 'error';
        $this->code   = static::VALIDATION;
        $this->error  = $errors;
        $this->data   = $data;

        return $this;
    }

    /**
     * @param string $errorMessage
     * @return ResMsg $this
     */
    public function auth($errorMessage = 'Authenticate is required')
    {
        $this->status = 'error';
        $this->code   = static::AUTH;
        $this->error  = new MessageBag();
        $this->error->add('error', $errorMessage);
        $this->data = null;

        return $this;
    }

    /**
     * @param string $errorMessage
     * @return ResMsg $this
     */
    public function permission($errorMessage = 'Permission denied')
    {
        $this->status = 'error';
        $this->code   = static::VALIDATION;
        $this->error  = new MessageBag();
        $this->error->add('error', $errorMessage);
        $this->data = null;

        return $this;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->status === 'error' ? true : false;
    }

    /**
     * @return bool
     */
    public function isAuthError()
    {
        return $this->code === static::AUTH ? true : false;
    }

    /**
     * @return bool
     */
    public function isPermissionError()
    {
        return $this->code === static::PERMISSION ? true : false;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->code == static::SUCCESS ? true : false;
    }

    /**
     * @return bool
     */
    public function isValidationError()
    {
        return $this->code == static::VALIDATION ? true : false;
    }

    public function clear()
    {
        $this->data   = null;
        $this->status = null;
        $this->code   = null;
        $this->error  = null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();
        if (!empty($this->status)) {
            $result['status'] = $this->status;
        }

        if (!empty($this->code)) {
            $result['code'] = $this->code;
        }

        if (!empty($this->error)) {
            $result['error'] = $this->error->toArray();
        }

        if (!empty($this->data)) {
            $result['data'] = $this->data->toArray();
        }

        return $result;
    }

    protected function setData($data){
        if(!empty($data)){
            if($data instanceof Collection){
                $this->data = $data;
            }elseif(is_array($data)){
                $this->data = new Collection($data);
            }
        }else{
            $this->data = null;
        }
    }


}