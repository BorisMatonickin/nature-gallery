<?php

class PdoDataMapper {
    
    /**
     * PDO object reference.
     */
    protected $pdo;
    
    /**
     * The name of the table which should be mapped.
     */
    protected $entityTable;
    
    /**
     * Set the object parameters.
     * @param PdoAdapter $pdo
     */
    public function __construct(PdoAdapter $pdo) {
        $this->pdo = $pdo->getDb();
    }
    
    /**
     * Check if field value exists in the choosen table.
     * @param string $fieldName
     * @param mixed $fieldValue
     * @param string $tableName
     */
    public function getField($fieldName, $fieldValue, $tableName) {
        try {
            $query = "SELECT {$fieldName} FROM {$tableName} WHERE {$fieldName} = ?";
            $sth = $this->pdo->prepare($query);
            $sth->execute([$fieldValue]);
            return ($sth->rowCount() > 0) ? true : false;
        } catch (PDOException $e) {
            $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Get one column as array.
     * @param string $sql
     * @param array $params - the params for prepared statement
     * @return array - the array of columns in row
     */
    protected function getColumn($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Get the columns as asscociative array by default.
     * @param type $sql
     * @param array $params - the params for prepared statement
     * @param const $fetchMode
     * @return mixed - array of columns or false if query is unsuccessfull
     */
    protected function getColumns($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch($fetchMode);
                return $row;
            }
            return false;
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Get the id of the last inserted row.
     * @param string $name
     */
    protected function getLastInsertId($name = null) {
        try {
            return $this->pdo->lastInsertId($name);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Get the rows array indexed by choosen column from the query.
     * @param string $sql
     * @param string $index
     * @param array $params - the params for prepared statement 
     * @return array - the array of rows
     */
    protected function getAllColumns($sql, $index = '', $params = []) {
        try {
            $returnArray = [];
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (isset($index)) {
                    foreach ($rows as $row) {
                        $arrayIndex = (isset($row[$index])) ? $row[$index] : $index;
                        $returnArray[$arrayIndex] = $row;
                    }
                }
                return $returnArray;
            }
            return $returnArray;
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Get all rows of one column.
     * @param type $sql
     * @param type $params - the params for prepared statement
     * @return array
     */
    public function getOneColumnRows($sql, $params = []) {
        try {
            $returnArray = [];
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
                return $rows;
            }
            return $returnArray;
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Returns PDO errors.
     * @param PDOException $e
     */
    protected function returnPdoErrors(PDOException $e) {
        print("Error code: " . $e->getCode() . "\n");
        print("Error message: " . $e->getMessage() . "\n");
        return false;
    }
}
