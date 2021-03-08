<?php
class Database
{
    // database credentials
    private $host = "eyw6324oty5fsovx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db_name = "c4pmxhczh6wzxpgq";
    private $username = "ug5fh4ctpr19iov7";
    private $password = "r7ygzj50w9c7xwko";

    # 1.
    private static $instance = null;
    public $conn;

    # 2. Add a new function __construct
    private function __construct(){
        $db_dsn = array(
            'host'    => $this->host,
            'dbname'  => $this->db_name,
            'charset' => 'utf8',
        );

        if (getenv('IDP_ENVIRONMENT') === 'docker') {
            $db_dsn['host'] = 'mysql';
            $this->username = 'docker_u';
            $this->password = 'docker_p';
        }

        try {
            $dsn        = 'mysql:' . http_build_query($db_dsn, '', ';');
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo json_encode(
                array(
                    'error'   => 'Database connection failed',
                    'message' => $exception->getMessage(),
                )
            );
            exit;
        }
    }

    # 3. Anither getInstance function 
    // get a new self unsance if does not exist
    public static function getInstance(){
        if (!self::$instance){
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // get the database connection
    # 4. 
    public function getConnection()
    {
        return $this->conn;
    }
}
