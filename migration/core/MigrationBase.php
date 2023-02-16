<?php

namespace core;

abstract class MigrationBase
{
    protected Database $databaseInstance;
    public function __construct(Database $dbInstance)  {
        $this->databaseInstance = $dbInstance;
    };
    public abstract function up();
    public abstract function down();
}