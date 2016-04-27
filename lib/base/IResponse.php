<?php

interface IResponse {
    
    public function getVersion();
    
    public function addHeader($header);
    
    public function addHeaders($headers = []);
    
    public function getHeaders();
    
    public function send();
}
