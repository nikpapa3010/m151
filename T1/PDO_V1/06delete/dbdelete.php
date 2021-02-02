<?php
class DeleteDataDemo{
	const DB_HOST = 'localhost';
	const DB_NAME = 'classicmodels';
	const DB_USER = 'root';
	const DB_PASSWORD = '';

	private $conn = null;

	/**
	 * Open the database connection
	 */
	public function __construct(){
		// open database connection
		$connectionString = sprintf("mysql:host=%s;dbname=%s",
				DeleteDataDemo::DB_HOST,
				DeleteDataDemo::DB_NAME);
		try {
			$this->conn = new PDO($connectionString,
					DeleteDataDemo::DB_USER,
					DeleteDataDemo::DB_PASSWORD);

		} catch (PDOException $pe) {
			die($pe->getMessage());
		}
	}
	
	/**
	 * truncate the tasks table
	 * @return a PDOStatement object, or false on failure.
	 */
	public function truncateTable() {
		$sql = 'TRUNCATE TABLE tasks';
		return $this->conn->exec($sql);
		
	}
	/**
	 * Delete all rows in the tasks tabble
	 * @return a PDOStatement object, or false on failure.
	 */
	public function deleteAll(){
		$sql = 'DELETE FROM tasks';
		return $this->conn->exec($sql);
	}

	/**
	 * Delete a task based on the task id
	 * @param int $id
	 * @return mixed false on failure
	 */
	public function delete($id) {

		$sql = 'DELETE FROM tasks
				WHERE task_id = :task_id';

		$q = $this->conn->prepare($sql);

		return $q->execute(array(':task_id' => $id));
	}


	/**
	 * close the database connection
	 */
	public function __destruct() {
		// close the database connection
		$this->conn = null;
	}
}

$obj = new DeleteDataDemo();
// delete id 2
$obj->delete(2);
// delete all rows
$obj->deleteAll();
// truncate table 
$obj->truncateTable();