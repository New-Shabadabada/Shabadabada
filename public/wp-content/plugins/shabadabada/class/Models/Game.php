<?php

namespace Shabadabada\Models;

class Game extends CoreModel 
{

    // table property
    protected $id; 
    protected $custom_id;
    protected $game_data;
    protected $game_response;
    protected $status;
    protected $created_at;
    protected $updated_at;

    /**
     * Manage the custom table name
     *
     * @return string $tableName
     */
    public static function getTableName()
    {
        $database = static::getDatabase();
        // $database->prefix enable us to get the WP table prefix 
        $tableName = $database->prefix . 'game';
        return $tableName;
    }

    /**
     * Create our DB custom table 
     *
     * @return void
     */
    public static function createTable()
    {

        // instantiate the global $wpdb object, providing access to WP database
        $database = static::getDatabase();

        // retrives the database character collate for our WP DB
        // DOC https://developer.wordpress.org/reference/classes/wpdb/get_charset_collate/
        $charset = $database->get_charset_collate();

        $tableName = static::getTableName();

        // DOC ENUM TYPE : https://dev.mysql.com/doc/refman/8.0/en/enum.html
        $sql = "
            CREATE TABLE IF NOT EXISTS `{$tableName}` (
                `id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `custom_id` VARCHAR(64) NOT NULL,
                    `game_data` LONGTEXT,
                    `game_response` LONGTEXT,
                    `status` ENUM ('en cours', 'terminée'),
                    `created_at` DATETIME NOT NULL,
                    `updated_at` DATETIME,
                    PRIMARY KEY(`id`),
                    INDEX (`custom_id`)  
                );
            ) {$charset};
        ";

        static::executeCreateTableQuery($sql);

    }

    /**
     * Update custom table 
     *
     * @param int $id
     * @param mixed $data
     * @return void
     */
    public static function update($id, $data)
    {
        // retrieve the table name
        $tableName = static::getTableName();
        
        // retrieve global $wpdb object
        // DOC https://developer.wordpress.org/reference/classes/wpdb/update/
        $database = static::getDatabase();
        $database->update(
            $tableName,
            $data,
            ['id' => $id]
        );
    }

    /**
     * Delete rows in DB custom table 
     *
     * @param int $id
     * @return void
     */
    public static function delete($id)
    {
        // retrieve the table name
        $tableName = static::getTableName();

        // sql request
        $sql = "
            DELETE FROM `{$tableName}`
            WHERE `id`=%d
        ";

        // retrieve global $wpdb object
        $database = static::getDatabase();

        // prepare the request, need to inject the value in the request
        $preparedQuery = $database->prepare(
            $sql, [
                // les paramètres de la requête doivent respecter l'ordre d'apparition des %* dans la requête
                $id
            ]
        );
        // execution de la requête
        $database->query($preparedQuery);
    }


    // ========= GETTER & SETTER =========


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of custom_id
     */ 
    public function getCustomId()
    {
        return $this->custom_id;
    }

    /**
     * Set the value of custom_id
     *
     * @return  self
     */ 
    public function setCustomId($custom_id)
    {
        $this->custom_id = $custom_id;

        return $this;
    }

    /**
     * Get the value of game_data
     */ 
    public function getGameData()
    {
        return $this->game_data;
    }

    /**
     * Set the value of game_data
     *
     * @return  self
     */ 
    public function setGameData($game_data)
    {
        $this->game_data = $game_data;

        return $this;
    }

    /**
     * Get the value of game_response
     */ 
    public function getGameResponse()
    {
        return $this->game_response;
    }

    /**
     * Set the value of game_response
     *
     * @return  self
     */ 
    public function setGameResponse($game_response)
    {
        $this->game_response = $game_response;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }  
}