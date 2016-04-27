<?php

class UniqueValidator extends Validator {
    
    /**
     * Table name.
     */
    private $table;
    
    /**
     * Table field.
     */
    private $field;
    
    /**
     * PdoDataMapper object reference.
     */
    private $pdoMapper;
    
    /**
     * Set the object parameters.
     * @param PdoDataMapper $pdoMapper
     * @param $table
     * @param $field
     * @throws Exception - table and field names should be passed to the object
     */
    public function __construct(PdoDataMapper $pdoMapper, $table, $field) {
        $this->pdoMapper = $pdoMapper;
        if (empty($table)) {
            throw new Exception('Table name is not specified');
        } else {
            $this->table = $table;
        }
        if (empty($field)) {
            throw new Exception('Table field name is not specified');
        } else {
            $this->field = $field;
        }
    }
    
    /**
     * Validate if the value exists in the database.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        $dbValue = $this->pdoMapper->getField($this->field, $value, $this->table);
        if ($dbValue) {
            $this->error = 'Already in use';
            return false;
        }
        $this->validated = $value;
        return true;
    }
}
