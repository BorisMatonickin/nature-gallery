<?php

interface IRequest {

    public function isPost();
    public function isParamSet($param);
    public function getParam($param);
}

