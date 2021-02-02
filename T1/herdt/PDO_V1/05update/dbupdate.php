<?php
class UpdateDataDemo{
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
				UpdateDataDemo::DB_HOST,
				UpdateDataDemo::DB_NAME);
		try {
			$this->conn = new PDO($connectionString,
					UpdateDataDemo::DB_USER,
					UpdateDataDemo::DB_PASSWORD);

		} catch (PDOException $pe) {
			die($pe->getMessage());
		}
	}

	/**
	 * update an existing task in the tasks table
	 * @param string $subject
	 * @param string $description
	 * @param string $startDate
	 * @param string $endDate
	 * @return mixed returns false on failure
	 */
	public function update($id,$subject,$description,$startDate,$endDate) {
		$task = array(
				':taskid' => $id,
				':subject' => $subject,
				':description' => $description,
				':start_date' => $startDate,
				':end_date' => $endDate);



		$sql = 'UPDATE tasks
				SET subject = :subject,
					start_date = :start_date,
					end_date = :end_date,
					description = :description
				WHERE task_id = :taskid';

		$q = $this->conn->prepare($sql);

		return $q->execute($task);
	}


	/**
	 * close the database connection
	 */
	public function __destruct() {
		// close the database connection
		$this->conn = null;
	}
}

$obj = new UpdateDataDemo();

if($obj->update(2,
				'MySQL PHP Update Tutorial',
				'MySQL PHP Update using prepared statement', 
				'2013-01-01',
				'2013-01-01') !== false)
	echo 'The task has been updated successfully';
else 
	echo 'Error updated the task';
