<?php
class db {
	private $_db;
	private $debug = false;

	public function __construct($server, $user, $password, $dbase) {
		$this->_db = new mysqli($server, $user, $password, $dbase);
		if ($this->_db->connect_errno) {
			throw new Exception ("Failed to connect to database: " . $this->_db->connect_error);
		}
		return true;
	}

	public function debug($mode = null) {
		if ($mode === true) {
			$this->debug = true;
		}

		if ($mode === false) {
			$this->debug = false;
		}

		return $this->debug;
	}

	public function query($query) {
		if ($this->debug) {
			echo "QUERY: $query<br>";
		}
		$res = $this->_db->query($query);
		if ($res === false) {
			if ($this->debug) {
				throw new Exception("FAILED: " . $this->_db->error);
			}
		}
		return $res;
	}
}
?>