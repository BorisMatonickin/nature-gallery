<?php

interface IDatabaseAdapter {
    
    public function connect();
    public function disconnect();
    public function getDb();
}

