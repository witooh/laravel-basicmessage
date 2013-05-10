<?php

namespace Witooh\BasicMessage;

use Illuminate\Support\Collection;

class ReqMsg
{
    /** @var \Illuminate\Support\Collection */
    protected $data;

    /** @var \Illuminate\Support\Collection */
    protected $header;

    /**
     * @param array $data
     * @param array $header
     * @return ReqMsg
     */
    public function make(array $data, array $header = array()){
        $this->setData($data);
        $this->setHeader($header);
        return $this;
    }

    /**
     * @param array $data
     */
    public function setData(array $data){
        $this->data = new Collection($data);
    }

    /**
     * @param array $header
     */
    public function setHeader(array $header){
        $this->header = new Collection($header);
    }

    /**
     * @param $name
     * @param null $default
     * @return \Illuminate\Support\Collection
     */
    public function getData($name, $default = null){
        $data = $this->data->get($name);
        if(is_array($data)){
            return new Collection($data);
        }elseif(!empty($data)){
            return $data;
        }else{
            return $default;
        }
    }

    /**
     * @return array
     */
    public function allData(){
        return $this->data->all();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getDataCollection(){
        return $this->data;
    }
}