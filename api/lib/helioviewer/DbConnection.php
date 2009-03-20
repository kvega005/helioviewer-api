<?php
/**
 * @package DbConnection
 * @author Patrick Schmiedel <patrick.schmiedel@gmx.net>
 * @author Keith Hughitt <Vincent.K.Hughitt@nasa.gov>
 */
class DbConnection {
	private $host     = Config::DB_HOST;
	private $dbname   = Config::DB_NAME;
	private $user     = Config::DB_USER;
	private $password = Config::DB_PASS;
	
	/**
	 * @param string [optional] Database name
	 * @param string [optional] Database user
	 * @param string [optional] Database password
	 * @param string [optional] Database hostname
	 */
	public function __construct($dbname = null, $user = null, $password = null, $host = null) {
        if ($user) {
            $this->user = $user;	
		}
		if ($password) {
			$this->password = $password;
		}
		if ($host) {
			$this->host = $host;
		}
		if ($dbname) {
			$this->dbname = $dbname;
		}
		$this->connect();
	}
	
	/**
	 * connect 
	 */
	public function connect() {
		if (!$this->link = mysqli_connect($this->host, $this->user, $this->password)) {
            die('Error connecting to data base: ' . mysqli_error($this->link));
		}
		mysqli_select_db($this->link, $this->dbname);
	}

    /**
     * query
     * @param string SQL
     * @return mixed Query result
     */	
	public function query($query) {
		$result = mysqli_query($this->link, $query);
        if (!$result) {
            die("Error executing query:<br>\n$query <br>\n " . mysqli_error($this->link));
		}
		return $result;
	}
}
?>
