<?php

/**
 * Class Tasks
 * Model for task manipulations
 */
class Tasks extends Model
{
    protected static $name = 'tasks';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Saves prepared data to database
     * @param $data
     * @return string
     * @author hosylibi
     * @since 2022-02-22
     */
    public function save($data)
    {
        $error = '';

        if (empty($data['title']) || empty($data['start_date']) || empty($data['end_date'])
        ) {
            $error = "Input is required";
        } else if ($data['start_date'] > $data['end_date']) {
            $error = "The ending date can not lower than starting date";
        }
        
        if (!$error) {
            $result = $this->insert($data);
            if (!$result) {
                $error = "Unable to save";
            }
        }
        
        return $error;
    }

}
