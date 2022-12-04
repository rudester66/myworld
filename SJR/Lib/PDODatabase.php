<?php # PDODatabase.php
namespace SJR\Lib;

use \PDO as PDO;

set_time_limit(30000);

require_once 'vendor/noahheck/e_pdostatement/EPDOStatement.php';

/**
 * PDODatabase class uses PDO(php data object) to query a database table and extends PDO class.
 * @author Scott Crossan
 * @version 0.1.2
 */

class PDODatabase extends \PDO
{
	/**
	 * Parameter to store the interpolated query (with the parameters interpreted and inserted into the query string)
	 * @var string fullQuery
	 */
	public $fullQuery = null;
	
	/**
	 * Constructor that connects to database
	 *
	 * @param string $connection
	 * Format: mysql:host=...; dbname=...;, user, pass<br />
	 * @param bool $removeSpaces
	 */
	public function __construct($connection, $removeSpaces = true, $error_mode = 'exception')
	{
		// Removes any spaces
		if($removeSpaces === true)
			$connection = str_replace(' ', '', $connection);

		// Split connections by ",":
		$con = explode(",", $connection);

		// For Debugging:
		// var_dump($con);

		// Try to connect to database:
		try
		{
			// New PDO(PHP Data Object)/Database Connection:
			parent::__construct($con[0], $con[1], $con[2]);

			// Set how errors are handled:
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// Extended statement class
			$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array("noahheck\EPDOStatement", array($this)));
		}
		catch(PDOException $e)
		{
			//echo $e->getMessage();
			throw new PDOException($e->getMessage());
		}// End try/catch
	}// End __construct()

	/**
	 * Method to run first section of PDO SQL query
	 * @param SQL Statement/Sring $q
	 * @param array $values
	 * @param int $fetch
	 * @param string $class
	 * @param bool $execute
	 * @param bool $interpolateQuery
	 * @return array/bool/string
	 */
	private function prepare_stmt($q, $values, $fetch, $class = null, $execute = false, $interpolateQuery = false)
	{
		// Try to run query
		try
		{
			// Prepare SQL statement:
			$stmt = $this->prepare($q);

			// Check if values variable is not null and bind values:
			if(!is_null($values))
			{
				foreach($values as $key => $value)
				{
					// If i've not specified parameter names array must be a 1 based instead of 0 based
					if(is_int($key))
					{
						$key++;
					}

					if(is_array($value))
					{
						// Strip tags and slashes from value:
						//$value = strip_tags(stripslashes($value['value']));
						// Give value to named param:
						//$stmt->bindValue(":".$key, $value['value']);

						if(isset($value['type']) && $value['type'] == "search")
							$stmt->bindValue($key, $value['value'] . "%");
						else if(isset($value['type']) && $value['type'] == "search1")
							$stmt->bindValue($key, "%" . $value['value'] . "%");
						else if(is_numeric($value['value']) && !isset($value['paramType']))
							$stmt->bindParam($key, $value['value'], PDO::PARAM_INT);
						else if(isset($value['type']) && isset($value['paramType']))
							$stmt->bindParam($key, $value['value'], $value['paramType']);
						else
							$stmt->bindValue($key, $value['value']);
					}
					else
					{
						// Give value to named param:
						$stmt->bindValue($key, $value);
					}

					/*if($key == "password")
					{
						$stmt->bindValue($key, hash("sha256", $value . $this->salt), PDO::PARAM_STR);
					}
					else
					{
						// Give value to named param:
						$stmt->bindValue($key, $value, PDO::PARAM_STR);
					}*/
				}
			}

			if(!is_null($class))
			{
				// Set fetch Mode:
				$stmt->setFetchMode($fetch, $class);
			}
			else
			{
				// Set fetch Mode:
				$stmt->setFetchMode($fetch);
			}

			$return = $stmt;
			
			if(!$interpolateQuery)
			{
				//("PDO: " . $q . "</br>");
				// If we want to return execute value instead of statement
				if($execute == true)
				{
					// Execute statement:
					$return =  $stmt->execute();
				}
				else
				{
					$stmt->execute();
				}
				
				$this->fullQuery = $stmt->fullQuery;
			}
			else
			{
				$return = $stmt->interpolateQuery();
			}

			return $return;
		}
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		}
	}// End prepare_stmt() method

	/**
	 * Method to return the last inserted id into the database
	 * @param string $q
	 * @param array $values
	 * @throws PDOException
	 * @return number
	 */
	public function last_id($q, array $values = null)
	{
		try
		{
			$stmt = $this->prepare_stmt($q, $values, PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		}

		return $this->lastInsertId();
	}

	/**
	 * Method to run PDO SQL query and return affected row(s)
	 * @param SQL query/String $q
	 * @param array $values
	 * @throws PDOException
	 * @return int
	 */
	 public function row_count($q, array $values = null)
	 {
	 	try
	 	{
	 		$stmt = $this->prepare_stmt($q, $values, PDO::FETCH_ASSOC);
	 	}
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		}

	 	return $stmt->rowCount();
	 }// End row_count()

	/**
	 * Method to run PDO SQL query and return one row
	 * @param SQL query/String $q
	 * @param array $values
	 * @param int $fetchType
	 * @throws PDOException
	 * @return array
	 */
	public function fetch_one($q, array $values = null, $fetchType = PDO::FETCH_ASSOC)
	{
		try
		{
			$stmt = $this->prepare_stmt($q, $values, $fetchType);
		}
		catch(PDOException $e)
		{
			throw new PDOException($e);
		}

		return $stmt->fetch();
	}// End function_one() method

	/**
	 * Method to run PDO SQL query and return all rows or classes
	 * @param SQL query/String $q
	 * @param array $values
	 * @param int $fetchType
	 * @throws PDOException
	 * @return mulit-demnsional array
	 */
	public function fetch_all($q, array $values = null, $class = null, $fetchType = PDO::FETCH_ASSOC)
	{
		try
		{
			// If class is not set
			if(is_null($class))
			{
				$stmt = $this->prepare_stmt($q, $values, $fetchType);
			}
			else
			{
				$stmt = $this->prepare_stmt($q, $values, PDO::FETCH_CLASS, $class);
			}
		}
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		}

		return $stmt->fetchAll();
	}// End fetch_all()	method

	/**
	 * Method to run PDO SQL query and return a class with class attributes values
	 * @param string $q
	 * @param array $values
	 * @param string $class
	 * @throws PDOException
	 * @return class
	 */
	public function fetch_class($q, array $values = null, $class)
	{
		try
		{
			$stmt = $this->prepare_stmt($q, $values, PDO::FETCH_CLASS, $class);
		}
		catch(PDOException $e)
		{
			throw new Exception($e->getMessage());
		}

		return $stmt->fetch();
	}// End fetch_class() method

	/**
	 * Method to ruen PDO SQL query and return execute value
	 * @param string $q
	 * @param array $values
	 * @throws PDOException
	 * @return bool
	 */
	public function execute($q, array $values = null)
	{
		try
		{
			$stmt = $this->prepare_stmt($q, $values, PDO::FETCH_ASSOC, null, true);
		}
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		}

		return $stmt;
	}

	/**
	 * Function to retrieve row count of all rows in table
	 * @param string $table
	 * @param array $where
	 * @throws PDOException
	 * @return int
	 */
	public function count_all($table, $where = null, $join = null, $group = null)
	{
		// SQL Query to retrieve a count of all rows
		$q = "SELECT count(*) row_count FROM $table $join";

		if(!is_null($where))
		{
			$q .= "\nWHERE\n" . $where[0];
		}
		
		if (strpos($table, ' ') > 0) {
		    $parts = explode(' ', $table);
		    if (is_array($parts)) {
		        $alias = end($parts);
		        $col = $alias;
		    }
		}
		else
		{
		    $col = $table;
		}

		if(!is_null($group))
		{
		    $w = (!is_null($where))? "\nWHERE\n" . $where[0] : '';

		    $q = "SELECT count(*) row_count FROM (SELECT $group FROM $table $join $w \nGROUP BY $group) t";
		}

		//die(var_dump($q, $where[1]));

		try
		{
			if(is_null($where))
			{
				// Row count of entire table
				$row_count = $this->fetch_one($q);
			}
			else
			{
				// Row count of entire table
				$row_count = $this->fetch_one($q, $where[1]);
			}
		}
		catch(PDOException $e)
		{
			var_dump($where[1]);
			echo "<pre>$q</pre>";
			throw new PDOException($e);
		}

		if(is_array($row_count) && $row_count != false)
		{
			$count = $row_count['row_count'];
		}
		else
		{
			$count = 0;
		}

		return $count;
	}

	/**
 	* Function to retrieve databse results by page and total pages
	* @param int $page
	* @param int $per_page
	* @param string $page_name<p>
	* Page name is used to create the ancor tag href</p>
	* @param string $table
	* @param string $columns
	* @param array $where <br />
	* Index 0 is clause and index 1 is param values array
	* @param string $joins
	* @param string $order
	* @param bool $returnSQL
	* @throws PDOException
	* @return array<br />
	* Returns total pages at index 0 and rows at index 1 and page details at index 2 and SQL at index 3
	*/
	public function retrieve_page($page, $per_page, $page_name, $table, $columns = "*", $where = null, $join = null, $order = null, $returnSQL = false)
	{
		// Count all logs:
		$count = $this->count_all($table, $where, $join);
		// Calculate number of pages:
		$pages_count = $count / $per_page;

		// Calculate start and end:
		// If it is the first page start limit at zero
		if($page == 1)
			$start = 0;
		else
			$start = ($page * $per_page) - $per_page;

		if($start < 0)$start = 0;

		$sql = "SELECT $columns	FROM $table\n";

		if(!is_null($join))
		{
			$sql .= $join . "\n";
		}

		if(!is_null($where))
		{
			$sql .= "WHERE \n" .
			$where[0] . "\n";
		}

		if(!is_null($order))
		{
				$sql .= "\nORDER BY $order";
		}

		if($questionMarkPlaceholders === false)
			$sql .= "\nLIMIT :start , :end";
		else
			$sq .= "\nLIMIT ?, ?";



			// Array to pass SQL param values
			$values['start']['value'] = (int)$start;
			$values['end']['value'] = (int)$per_page;

			if(!is_null($where) && !is_null($where[1]))
				$values = array_merge($values, $where[1]);

			// For Debugging
			//die(var_dump($sql, $values));

			try
			{
			// Retrieve requested pseduo page of data
				$page_data = $this->fetch_all($sql, $values);
			}
			catch(PDOException $e)
			{
			trigger_error($e->getMessage() . $sql, E_USER_ERROR);
			}

			if(is_array($page_data) && count($page_data) > 0)
			{
				// Check if there is a need for a next not totall filled page
				$decimal_check = explode('.', number_format($pages_count, 2));
				$decimal_check  = $decimal_check[1];

				if(substr($decimal_check, 0, 1) == 0)
				{
					$pages_count = ceil($pages_count); // Rounds up incase number returned is a float so as not to miss off any results
					//--$pages_count;
				}
				else
				{
					$pages_count = ceil($pages_count); // Rounds up incase number returned is a float so as not to miss off any results
				}

				$show_pages = 7;

				$display = '<div class="pagination">'; // Dispaly pagination

				$page_link = "index.php?$page_name&p="; // Page link, needs to have page number added to end

				$display .= "Total Records: $count<br />";

				// If current page is more than one
				if($page > 1)
				{
					$display .= "<span class='prev'><a class='pagination'  href='$page_link" . ($page - 1) . "'>Prev</a></span>&nbsp;&nbsp;";
				}

				// If there are enough break up page numbers
				if($pages_count > $show_pages)
				{
					// If page is at the begining
					if($page <= $show_pages)
					{
						// Display begining pages
						for($i = 1; $i <= $show_pages; ++$i)
						{
							if($page == $i){
								$display .= "<b>$i</b>&nbsp;&nbsp;";
							}else{
								$display .= "<a class='pagination'  href='$page_link{$i}'>$i</a>&nbsp;&nbsp;";
							}
						}

						$display .= "...&nbsp;&nbsp;";
					}
					else
					{
						// Display begining pages
						$display .= "<a class='pagination'  href='{$page_link}1'>1</a>&nbsp;&nbsp;";
						$display .= "<a class='pagination'  href='{$page_link}2'>2</a>&nbsp;&nbsp;";
						$display .= "...&nbsp;&nbsp";
					}

					// If page is in the middle
					if($page > $show_pages && $page < ($pages_count - $show_pages) + 1)
					{
						// Display middle pages
						for($i = ($page - 3); $i <= ($page + 3); ++$i)
						{
							if($page == $i)
								$display .= "<b>$i</b>&nbsp;&nbsp";
							else
								$display .= "<a class='pagination'  href='{$page_link}$i'>$i</a>&nbsp;&nbsp;";
						}

						$display .= "...&nbsp;&nbsp;";
					}

					// If page is at the end
					if($page > $pages_count - $show_pages && $page > $show_pages)
					{
						// Display end pages
						for($i = ($pages_count - $show_pages); $i <= $pages_count; ++$i)
						{
							if($i > 2)
							{
								if($page == $i)
									$display .= "<b>$i</b>&nbsp;&nbsp;";
								else
									$display .= "<a class='pagination'  href='{$page_link}$i'>$i</a>&nbsp;&nbsp;";
							}
						}
					}
					else
					{
						$scnd_lst = $pages_count - 1; // Second to last page number

						if($show_pages != $scnd_lst)
							$display .= "<a class='pagination'  href='{$page_link}$scnd_lst'>$scnd_lst</a>&nbsp;&nbsp;";
							$display .= "<a class='pagination'  href='{$page_link}$pages_count'>$pages_count</a>&nbsp;&nbsp;";
						}

						if($page != $pages_count)
							$display .= "<span class='next'><a class='pagination'  class='pagination'  href='{$page_link}" . ($page + 1) . "'>Next</a></span>";
				}
				else
				{
					// Display begining pages
					for($i = 1; $i <= $pages_count; ++$i)
					{
						if($page == $i)
						{
							$display .= "<b>$i</b>&nbsp;&nbsp;";
						}
						else
						{
							$display .= "<a class='pagination'  class='pagination'  href='$page_link{$i}'>$i</a>&nbsp;&nbsp;";
						}
					}

					if($page != $pages_count)
						$display .= "<span class='next'><a class='pagination'  href='{$page_link}" . ($page + 1) . "'>Next</a></span>";
				}

				$display .= "</div>";


				$return = array($display, $page_data, $count, $sql);
			}
			else
			{
				$return = array(null, null, null, null);
			}

			return $return;
	}

	/**
	 * Function to retrieve databse results by page and total pages
	 * @param array $params<p>These are the indexs that can be used to pass values to the function variables via associative array
	 * int $page<br />
	 * int $per_page<br />
	 * string $page_name<p>
	 * Page name is used to create the ancor tag href</p>
	 * string $table<br />
	 * string $columns<br />
	 * array $where<p>
	 * Index 0 is clause and index 1 is param values array</p>
	 * string $joins<br />
	 * string $order<br />
	 * string $group<br />
	 * bool $returnSQL<br />
	 * bool $questionMarkPlaceholders</p>
	 * @throws PDOException
	 * @return array<br />
	 * Returns total pages at index 0 and rows at index 1 and page details at index 2 and SQL at index 3
	 */
	public function retrievePage(array $params)
	{
		// Start time of the currect price insert used to work out the time it takes to import the prices from this spread sheet
		$mtime = microtime();
		$mtime = explode(' ' , $mtime);
		$mtime = $mtime[0] + $mtime[1];
		$startTime = $mtime;

		$page = 0;
		$per_page = 0;
		$page_name = null;
		$table = null;
		$columns = "*";
		$where = null;
		$having = null;
		$join = null;
		$order = null;
		$group = null;
		$returnSQL = false;
		$questionMarkPlaceholders = false;
		$values = array();
		$class = null;
		$countGroup = true;
		$queryString = null;

		foreach($params as $k => $v)
		{
			$$k = $v;
		}

		// Count all logs:
		$count = $this->count_all($table, $where, $join, ($countGroup ? $group : null));

		if($count > 0)
		{
			// Calculate number of pages:
			$pages_count = $count / $per_page;
		}
		else
		{
			$pages_count = 0;
		}

		// Calculate start and end:
		// If it is the first page start limit at zero
		if($page == 1)
			$start = 0;
		else
			$start = ($page * $per_page) - $per_page;

		if($start < 0)$start = 0;

		$sql = "SELECT $columns	\nFROM $table\n";

		if(!is_null($join))
		{
			$sql .= $join . "\n";
		}

		if(!is_null($where))
		{
			$sql .= "WHERE \n" . $where[0];
		}

		if(!is_null($having))
		{
			$sql .= "\nHAVING " . $having;
		}

		if(!is_null($group))
		{
			$sql .= "\nGROUP BY $group";
		}

		if(!is_null($order))
		{
			$sql .= "\nORDER BY $order";
		}

		if($questionMarkPlaceholders === false)
			$sql .= "\nLIMIT :start , :rows";
		else
			$sql .= "\nLIMIT ?, ?";

		// Array to pass SQL param values
		($questionMarkPlaceholders === false ? $values['start']['value'] = (int)$start : $values[]['value'] = (int)$start);
		($questionMarkPlaceholders === false ? $values['rows']['value'] = (int)$per_page : $values[]['value'] = (int)$per_page);

		if(!is_null($where) && !is_null($where[1]))
			$values = array_merge($where[1], $values);

		// For Debugging
		//die(var_dump($sql, $values));

		try
		{
			// Retrieve requested pseduo page of data
			$page_data = $this->fetch_all($sql, $values, $class);
		}
		catch(PDOException $e)
		{
			if(substr_count($e->getMessage(), 'SQL Server') || substr_count($e->getMessage(), 'SQLSRV'))
			{
				try
				{
					$sqlServerLimit = "OFFSET " . ($questionMarkPlaceholders === false ? $values['start']['value'] : '?') . "\n"
									. "ROWS FETCH NEXT " . ($questionMarkPlaceholders == false ? $values['rows']['value'] : '?') . " ROWS ONLY";

					$sql = preg_replace('/LIMIT (:start|\?) , (:rows|\?)/', $sqlServerLimit, $sql);
					unset($values['start'], $values['rows']);
					
					$page_data = $this->fetch_all($sql, $values, $class);
					//die($this->interpolateQuery($sql, $values));
				}
				catch(PDOException $e)
				{
					echo "<pre>$sql</pre>";
					throw new PDOException($e);
				}
			}
			else
			{
				echo "<pre>$sql</pre>";
				throw new PDOException($e);
			}
		}

		if(substr_count($pages_count, '.'))
		{
			// Check if there is a need for a next not totally filled page
			$decimal_check = explode('.', round($pages_count, 2));
			$decimal_check  = $decimal_check[1];
		}

		$pages_count = ceil($pages_count); // Rounds up incase number returned is a float so as not to miss off any results

		$show_pages = 7;

		$display = '<div class="pagination">'; // Dispaly pagination

		$page_link = "index.php?$page_name&p="; // Page link, needs to have page number added to end
		
		$queryString =  (!empty($queryString) ? "&$queryString" : '');

		$display .= "Total Records: $count<br />";

		// If current page is more than one
		if($page > 1)
		{
			$display .= (is_null($queryString) ? "<span class='prev'><a class='pagination'  href='$page_link" . ($page - 1) . "'>Prev</a></span>&nbsp;&nbsp;" : "<span class='prev'><a class='pagination'  href='$page_link" . ($page - 1) . $queryString . "'>Prev</a></span>&nbsp;&nbsp;");
		}

		// If there are enough break up page numbers
		if($pages_count > $show_pages)
		{
			// If page is at the begining
			if($page <= $show_pages)
			{
				// Display begining pages
				for($i = 1; $i <= $show_pages; ++$i)
				{
					if($page == $i){
						$display .= "<b>$i</b>&nbsp;&nbsp;";
					}else{
						$display .= (!is_null($queryString) ? "<a class='pagination'  href='$page_link{$i}$queryString'>$i</a>&nbsp;&nbsp;" : "<a class='pagination'  href='$page_link{$i}'>$i</a>&nbsp;&nbsp;");
					}
				}

				$display .= "...&nbsp;&nbsp;";
			}
			else
			{
				// Display begining pages
				$display .= (!is_null($queryString) ? "<a class='pagination'  href='{$page_link}1$queryString'>1</a>&nbsp;&nbsp;" : "<a class='pagination'  href='{$page_link}2$queryString'>2</a>&nbsp;&nbsp;");
				$display .= (!is_null($queryString) ? "<a class='pagination'  href='{$page_link}1'>1</a>&nbsp;&nbsp;" : "<a class='pagination'  href='{$page_link}2'>2</a>&nbsp;&nbsp;");
				$display .= "...&nbsp;&nbsp";
			}

			// If page is in the middle
			if($page > $show_pages && $page < ($pages_count - $show_pages) + 1)
			{
				// Display middle pages
				for($i = ($page - 3); $i <= ($page + 3); ++$i)
				{
					if($page == $i)
						$display .= "<b>$i</b>&nbsp;&nbsp";
					else
						$display .= (!is_null($queryString) ? "<a class='pagination'  href='{$page_link}$i$queryString'>$i</a>&nbsp;&nbsp;" : "<a class='pagination'  href='{$page_link}$i'>$i</a>&nbsp;&nbsp;");
				}

				$display .= "...&nbsp;&nbsp;";
			}

			// If page is at the end
			if($page > $pages_count - $show_pages && $page > $show_pages)
			{
				// Display end pages
				for($i = ($pages_count - $show_pages); $i <= $pages_count; ++$i)
				{
					if($i > 2)
					{
						if($page == $i)
							$display .= "<b>$i</b>&nbsp;&nbsp;";
						else
							$display .= (!is_null($queryString) ? "<a class='pagination'  href='{$page_link}$i$queryString'>$i</a>&nbsp;&nbsp;" : "<a class='pagination'  href='{$page_link}$i'>$i</a>&nbsp;&nbsp;");
					}
				}
			}
			else
			{
				$scnd_lst = $pages_count - 1; // Second to last page number

				if($show_pages != $scnd_lst)
					$display .= (!is_null($queryString) ? "<a class='pagination'  href='{$page_link}$scnd_lst$queryString'>$scnd_lst</a>&nbsp;&nbsp;" : "<a class='pagination'  href='{$page_link}$scnd_lst'>$scnd_lst</a>&nbsp;&nbsp;");

				$display .= (!is_null($queryString) ? "<a class='pagination'  href='{$page_link}$pages_count$queryString'>$pages_count</a>&nbsp;&nbsp;" : "<a class='pagination'  href='{$page_link}$pages_count'>$pages_count</a>&nbsp;&nbsp;");
			}

			if($page != $pages_count)
				$display .= (!is_null($queryString) ? "<span class='next'><a class='pagination'  class='pagination'  href='{$page_link}" . ($page + 1) . $queryString . "'>Next</a></span>" : 
				             "<span class='next'><a class='pagination'  class='pagination'  href='{$page_link}" . ($page + 1) . "'>Next</a></span>");
		}
		else
		{
			// Display begining pages
			for($i = 1; $i <= $pages_count; ++$i)
			{
				if($page == $i)
				{
					$display .= "<b>$i</b>&nbsp;&nbsp;";
				}
				else
				{
					$display .= (!is_null($queryString) ? "<a class='pagination'  class='pagination'  href='$page_link{$i}$queryString'>$i</a>&nbsp;&nbsp;" : "<a class='pagination'  class='pagination'  href='$page_link{$i}'>$i</a>&nbsp;&nbsp;");
				}
			}

			if($page != $pages_count)
				$display .= (!is_null($queryString) ? "<span class='next'><a class='pagination'  href='{$page_link}" . ($page + 1) . $queryString . "'>Next</a></span>" : "<span class='next'><a class='pagination'  href='{$page_link}" . ($page + 1) . "'>Next</a></span>");
		}

		$display .= "</div>";

		if(is_array($page_data) && count($page_data) > 0)
		{
			$return = array($display, $page_data, $count, ($returnSQL ? $sql : null));
		}
		else
		{
			if($count == 0)
			{
				$display = null;
			}

			$return = array($display, $page_data, null, ($returnSQL ? $sql : null));
		}

		// Start time of the currect price insert used to work out the time it takes to import the prices from this spread sheet
		$mtime = microtime();
		$mtime = explode(' ' , $mtime);
		$mtime = $mtime[0] + $mtime[1];
		$endTime = $mtime;
		//die($endTime - $startTime);

		return $return;
	}
	
	/**
	 * Method to interpolate the query parameters and insert them in place in the query string and then return the string
	 * @param string $query
	 * @param array $values
	 * @throws PDOException
	 * @return string
	 */
	function interpolateQuery($query, array $values)
	{
		try
		{
			$fullQuery = $this->prepare_stmt($query, $values, PDO::FETCH_ASSOC, null, false, true);			
		}	
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		}
		
		return $fullQuery;
	}
	
}// End PDODatabase
