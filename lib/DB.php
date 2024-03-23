<?php


namespace RMS;

/**
 * Generic datasource class for handling DB operations.
 * Uses MySqli and PreparedStatements.
 *
 * @version 2.7 - PDO connection option added
 */
class DB
{

    private $host;

    private $username;

    private $password;

    private $db;

    private $conn;

    /**
     * PHP implicitly takes care of cleanup for default connection types.
     * So no need to worry about closing the connection.
     *
     * Singletons not required in PHP as there is no
     * concept of shared memory.
     * Every object lives only for a request.
     *
     * Keeping things simple and that works!
     * Create a folder name config, inside config create a file call index.php
     */
    function __construct()
    {
        $configFilePath = __DIR__ . '/../config/index.php';
        require_once($configFilePath);
        $this->host = DB_HOST;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->db = DB_NAME;
        $this->conn = $this->getConnection();
        return $this->conn;
    }

    /**
     * If connection object is needed use this method and get access to it.
     * Otherwise, use the below methods for insert / update / etc.
     *
     * @return \mysqli
     */
    public function getConnection()
    {

        // $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);
        $conn = new \mysqli($this->host, $this->username, $this->password, $this->db);

        if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }

        $conn->set_charset("utf8");
        return $conn;
    }

    /**
     * If you wish to use PDO use this function to get a connection instance
     *
     * @return \PDO
     */
    public function getPdoConnection()
    {
        $conn = FALSE;
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
            $conn = new \PDO($dsn, $this->username, $this->password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\Exception $e) {
            exit("PDO Connect Error: " . $e->getMessage());
        }
        return $conn;
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (!empty($resultset)) {
            return $resultset;
        }
    }

    public function selectOne($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return the first record as an associative array
        } else {
            return null; // No record found
        }
    }

    /**
     * To insert
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insert($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }

    /**
     * To execute query
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     */
    public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
    }

    /**
     * 1.
     * Prepares parameter binding
     * 2. Bind prameters to the sql statement
     *
     * @param string $stmt
     * @param string $paramType
     * @param array $paramArray
     */
    public function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = &$paramType;
        for ($i = 0; $i < count($paramArray); $i++) {
            $paramValueReference[] = &$paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function getRecordCount($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);
        if (!empty($paramType) && !empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }

    /**
     * To delete
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function delete($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return false; // Check for preparation failure.
        }
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $isDeleted = $stmt->execute();
        if ($isDeleted) {
            return true;
        }
        return false;
    }

    /**
     * To UPDATE
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function update($query, $paramType, $params)
    {
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $params);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertMultiple($query, $data = [])
    {
        $values = str_repeat('?,', count($data[0]) - 1) . '?'; //GIVES ? , ? , ?
        $query = $query . str_repeat("($values),", count($data) - 1) . "($values)";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute(array_merge(...$data));
        return $result;
    }

    /**
     * Example Usage :
     * 
     * // Example usage for deleteMultiple method
     *$query = "DELETE FROM your_table_name";
     *$conditions = array("column1 = ?", "column2 > ?");
     *$paramType = "si";
     *$paramArray = array("value1", 5);
     */

    public function deleteMultiple($query, $conditions, $paramType, $paramArray)
    {
        // Add WHERE clause with conditions
        $query .= " WHERE " . implode(" AND ", $conditions);

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return false; // Check for preparation failure.
        }

        // Bind parameters dynamically
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        // Execute the statement
        $isDeleted = $stmt->execute();

        if ($isDeleted) {
            return true;
        }

        return false;
    }
}
