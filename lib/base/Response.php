<?php

class Response implements IResponse {
    
    /**
     * 
     */
    private $version;
    
    /**
     * 
     */
    private $headers;
    
    /**
     * 
     */
    public function __construct($version = null) {
        $this->version = $version;
    }
    
    /**
     * 
     */
    public function getVersion() {
        return $this->version;
    }
    
    /**
     * 
     */
    public function addHeader($header) {
        $this->headers[] = $header;
        return $this;
    }
    
    /**
     * 
     */
    public function addHeaders($headers = []) {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }
        return $this;
    }
    
    /**
     * 
     */
    public function getHeaders() {
        return $this->headers;
    }
    
    /**
     * 
     */
    public function send() {
        if (!headers_sent()) {
            foreach($this->headers as $header) {
                header("$this->version $header", true);
            }
        }
    }
}
