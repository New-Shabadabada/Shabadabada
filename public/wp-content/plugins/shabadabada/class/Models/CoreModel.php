<?php

namespace Shabadabada\Models;

abstract class CoreModel
{
    // property to communicate with the DB
    protected $database;

    // heritage : force daughter's class to have these functions
    abstract public static function delete($id);
    abstract public static function getTableName();

     
    public function __construct()
    {
        $this->database = static::getDatabase();
    }

    /**
     * Access database method
     *
     * @return void
     */
    public static function getDatabase()
    {
        // DOC wpdb https://developer.wordpress.org/reference/classes/wpdb/
        global $wpdb;
        return $wpdb;
    }

    /**
     * Insert rows into our table
     *
     * @param mixed $data 
     * @return void
     */
    public static function insert($data)
    {

        $database = static::getDatabase();

        // DOC https://developer.wordpress.org/reference/classes/wpdb/insert/
        $database->insert(
            static::getTableName(),
            $data
        );
    }

    /**
     * Create new table
     *
     * @param mixed $sql 
     * @return void
     */
    public static function executeCreateTableQuery($sql)
    {
        // we do not execute sql directly
        // we are calling dbDelta which can migrate database
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        // DOC DbDelta https://developer.wordpress.org/reference/functions/dbdelta/
        dbDelta($sql);
    }


    /**
     * Execute sql request on wpdb
     *
     * @param mixed $sql
     * @return void
     */
    public static function execute($sql)
    {
        $database = static::getDatabase();
        return $database->query($sql);
    }


    /**
     * Drop a table in DB 
     *
     * @return void
     */
    public static function dropTable()
    {
        $tableName = static::getTableName();
        $sql = "
            DROP TABLE {$tableName}
        ";

        static::execute($sql);
    }

    
    
    
}