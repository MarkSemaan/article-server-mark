<?php

require_once __DIR__ . '/connection/connection.php';

abstract class seeder
{
    protected mysqli $mysqli;

    public function __construct()
    {
        $this->mysqli;
    }
    abstract public function run(): void;
}
