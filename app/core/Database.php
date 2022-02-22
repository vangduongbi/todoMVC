<?php

class Database
{
    public $pdo;

    /**
     * @var
     * Only one instance per http request
     */
    protected static $instance;

    protected function __construct()
    {
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ];
        $this->pdo = new PDO(DSN, DB_USER, DB_PASS, $options);
    }

    /**
     * @return Database
     * Use only one instance per http request (application)
     */
    public static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * run
     * @param $sql
     * @return array|false|int|string
     * @author hosylibi
     * @since 2022-02-22
     */
    public function run($sql)
    {
        $sql      = trim($sql);
        $isSelect = strtolower(substr( $sql, 0, 6 )) === "select";
        $isInsert = strtolower(substr( $sql, 0, 6 )) === "insert";
        $stmt     = $this->pdo->prepare($sql);
        
        if($stmt->execute()) {
            if($isSelect){
                return $stmt->fetchAll();
            }
            if($isInsert){
                return $this->pdo->lastInsertId();
            }
            return $stmt->rowCount();
        }
        return false;
    }
    
    /**
     * delete
     * @param $table
     * @param string $where
     * @return array|false|int|string
     * @author hosylibi
     * @since 2022-02-22
     * Delete items from $table depending on the parameters
     */
    public function delete($table, $where='')
    {
        $where = $where == '' ? '' : " WHERE $where";
        $sql   = "DELETE FROM `$table`{$where};";

        return $this->run($sql);
    }
    
    /**
     * deleteById
     * @param $table
     * @param $id
     * @return array|false|int|string
     * @author hosylibi
     * @since 2022-02-22
     * Delete item from $table where id is $id
     */
    public function deleteById($table, $id)
    {
        return $this->delete($table, "`id` = $id");
    }
    
    /**
     * insert
     * @param $table
     * @param $data
     * @return array|false|int|string
     * @author hosylibi
     * @since 2022-02-22
     * insert new data into $table
     */
    public function insert($table, $data)
    {
        $fields = implode(array_keys($data), "`, `");
        $values = implode(array_values($data), "', '");
        $sql    = "INSERT INTO `$table` (`{$fields}`) VALUES ('" . "{$values}" . "')";
        return $this->run($sql);
    }
}
