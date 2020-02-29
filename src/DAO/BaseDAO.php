<?php
/**
 * Abstract Base DAO
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\DAO;

/**
 * All data access objects will extend from this class
 */
abstract class BaseDAO {
    /**
     * @var \PDO
     */
    protected $database;

    /**
     * Returns the current database object
     **
     * @return \PDO
     */
    protected function getDatabase() : \PDO {
        return $this->database;
    }
}
