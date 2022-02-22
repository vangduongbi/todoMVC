<?php
/**
 * Class Model
 * Model abstract class
 * This class should be inherited by all models
 * contains basic common methods for any model
 */
abstract class Model
{
    /**
     * @var Database
     * Instance of database object
     */
    protected $db;
    
    /**
     * @var string
     * Table (model) name
     */
    protected static $name;

    protected function __construct()
    {
        $this->db = Database::instance();
    }
    
    /**
     * insert
     * @param $data
     * @return array|false|int|string
     * @author hosylibi
     * @since 2022-02-22
     */
    protected function insert($data)
    {
        return $this->db->insert(static::$name, $data);
    }
    
    /**
     * delete
     * @param $id
     * @return array|false|int|string
     * @author hosylibi
     * @since 2022-02-22
     */
    public static function delete($id)
    {
        return Database::instance()->deleteById(static::$name, $id);
    }
    
    /**
     * getAll
     * @return array|false|int|string
     * @author hosylibi
     * @since 2022-02-22
     */
    public static function getAll()
    {
        $name = static::$name;
        $sql = "SELECT * FROM `$name` ORDER BY id ASC";
        return Database::instance()->run($sql);
    }
}
