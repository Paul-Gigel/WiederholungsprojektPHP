<?php

namespace core;

abstract class MigrationBase
{
    protected Database $databaseInstance;
    public abstract function __construct(Database $dbInstance);
    public abstract function up();
    public abstract function down();
}