<?php

namespace citcervera\Model\Connections;

ini_set('memory_limit', '-1');

use citcervera\Model\Interfaces\IConnection;

use mysqli;

if ( !class_exists( 'DB' ) ) {
	class DB implements IConnection
	{
		private $_lastInsertedId;
		#region Protected
        
		protected function connect() {
            $mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
            if (!$mysqli->set_charset($this->charset)) {
                printf("Error loading character set utf8: %s\n", $mysqli->error);
                exit();
            }
			return $mysqli;
        }

        #endregion
        
        #region Public 

		public function __construct() 
		{
			/*
			$this->user = 'mycerverad';
			$this->password = '06g6m52y';
			$this->database = 'citcerveradb';
            $this->host = 'cerveradepisuerga.eu';
			$this->charset = 'utf8';
			*/
			$this->user = 'root';
			$this->password = '12345';
			$this->database = 'citcerveradb';
            $this->host = 'localhost';
			$this->charset = 'utf8';
        }

		public function query(string $query, $fetch_type = 'fetch_assoc') 
		{
			$results = [];
			$db = $this->connect();
			$result = $db->query($query);
			while ( $row = $result->{$fetch_type}())
			{
				$results[] = $row;
			}
			// print_r($results);
			return $results;
        }
        
		public function insert(string $table, Array $data, Array $format) 
		{
			// Check for $table or $data not set
			if ( empty( $table ) || empty( $data ) ) {
				return false;
			}
			
			// Connect to the database
			$db = $this->connect();
			
			// Cast $data and $format to arrays
			$data = (array) $data;
			$format = (array) $format;

			// Build format string
			$format = implode('', $format); 
			$format = str_replace('%', '', $format);

			//var_dump($this->prep_query($data));

			list( $fields, $placeholders, $values ) = $this->prep_query($data);
			
			// Prepend $format onto $values
			array_unshift($values, $format); 

			//echo "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";
			//var_dump($values);

			// Prepary our query for binding
			$stmt = $db->prepare("INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})");

			// Dynamically bind values
			call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($values));
			
			// Execute the query
			$stmt->execute();
			
			// Check for successful insertion
			if ( $stmt->affected_rows ) {
				$this->_lastInsertedId = $stmt->insert_id;
				return true;
			}
			
			return false;
        }
		
		public function getLastInsertedId()
		{
			return $this->_lastInsertedId;
		}

		public function update($table, $data, $format, $where, $where_format) 
		{
			// Check for $table or $data not set
			if ( empty( $table ) || empty( $data ) ) {
				return false;
			}
			
			// Connect to the database
			$db = $this->connect();
			
			// Cast $data and $format to arrays
			$data = (array) $data;
			$format = (array) $format;

			// Build format array
			$format = implode('', $format); 
			$format = str_replace('%', '', $format);
			$where_format = implode('', $where_format); 
			$where_format = str_replace('%', '', $where_format);
			$format .= $where_format;
			
			//var_dump($this->prep_query($data, 'update'));

			list( $fields, $placeholders, $values ) = $this->prep_query($data, 'update');
			
			//Format where clause
			$where_clause = '';
			$where_values = [];
			$count = 0;
			
			foreach ( $where as $field => $value ) {
				if ( $count > 0 ) {
					$where_clause .= ' AND ';
				}
				
				$where_clause .= $field . '=?';
				$where_values[] = $value;
				
				$count++;
			}

			// Prepend $format onto $values
			array_unshift($values, $format);
			$values = array_merge($values, $where_values);

			// Prepary our query for binding
			$stmt = $db->prepare("UPDATE {$table} SET {$placeholders} WHERE {$where_clause}");
			
			//var_dump($this->ref_values($values));
			// Dynamically bind values
			call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($values));
			
			// Execute the query
			$stmt->execute();
			
			// Check for successful insertion
			if ( $stmt->affected_rows ) {
				return true;
			}
			
			return false;
        }
        
		public function select($query, $data, $format, $entity = 'stdClass') 
		{
			// Connect to the database
			$db = $this->connect();
			
			//Prepare our query for binding
			$stmt = $db->prepare($query);
		
			//Normalize format
			$format = implode('', $format); 
			$format = str_replace('%', '', $format);
      
			// Prepend $format onto $values
			array_unshift($data, $format);
			
			//Dynamically bind values
			call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($data));
	
			//Execute the query
			$stmt->execute();
            
            $results = [];
			//Fetch results
			$result = $stmt->get_result();
			
            //Create results object
			while ($row = $result->fetch_object($entity)) {
				$results[] = $row;
			}

			return $results;
        }
				
		public function selectAll($query, $entity = 'stdClass') 
		{
			// Connect to the database
			$db = $this->connect();
			
			//Prepare our query for binding
			$stmt = $db->prepare($query);

			//Execute the query
			$stmt->execute();
            
            $results = [];
			//Fetch results
			$result = $stmt->get_result();
			
            //Create results object
			while ($row = $result->fetch_object($entity)) {
				$results[] = $row;
			}

			return $results;
		}

		public function Search($table, $query, $where_param, $where_format)
		{
			// Check for $table or $data not set
			if ( empty( $table ) ) {
				return false;
			}

			// Connect to the database
			$db = $this->connect();

			$where_format = (array) $where_format;
			$where_for = implode('', $where_format); 
			$where_for = str_replace('%', '', $where_for);

			$stmt = $db->prepare($query);
			if(count($where_param) > 0)
			{
				array_unshift($where_param, $where_for);
				call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($where_param));
			}
			$stmt->execute();
			
			
			//Fetch results
			$result = $stmt->get_result();
			//Create results object

			$results = [] ;
			while ($row = $result->fetch_object()) {
				$results[] = $row;
			}	
			return $results;
		}

		public function search2($table, $where, $where_format) 
		{
			// Check for $table or $data not set
			if ( empty( $table ) ) {
				return false;
			}

			// Connect to the database
			$db = $this->connect();

			$where_format = (array) $where_format;
			$where_format = implode('', $where_format); 
			$where_format = str_replace('%', '', $where_format);

			//Format where clause
			$where_clause = '';		
			$where_values = [];
			$count = 0;
			
			foreach ( $where as $field => $value ) {
				if ( $count > 0 ) {
					$where_clause .= ' AND ';
				}
				$where_clause .= $field . '=?';
				$where_values[] = $value;
				$count++;
			}

			// Prepend $format onto $values
			array_unshift($where_values, $where_format);
			// Prepary our query for binding

			$stmt = $db->prepare("SELECT * FROM {$table}  WHERE {$where_clause}");

			call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($where_values));

			// Execute the query
			$stmt->execute();

			$results = [];
			//Fetch results
			$result = $stmt->get_result();
			
			//$result->num_rows;
            //Create results object
			while ($row = $result->fetch_object()) {
				$results[] = $row;
			}
			
			return $results;
		}
		
		public function delete(string $table, int $id) 
		{

			$primaryKey = $this->get_primary_key($table);

			// Connect to the database
			$db = $this->connect();
			
			// Prepary our query for binding
			$stmt = $db->prepare("DELETE FROM {$table} WHERE {$primaryKey} = ?");
			
			// Dynamically bind values
			$stmt->bind_param('d', $id);
			
			// Execute the query
			$stmt->execute();
			
			// Check for successful insertion
			if ( $stmt->affected_rows ) {
				return true;
			}
        }
		
        #endregion

		#region Private
		
		private function prep_query($data, $type='insert') 
		{
			// Instantiate $fields and $placeholders for looping
			$fields = '';
			$placeholders = '';
			$values = array();
			
			// Loop through $data and build $fields, $placeholders, and $values			
			foreach ( $data as $field => $value ) {
				$fields .= "{$field},";
				$values[] = $value;
				if ( $type == 'update') {
					$placeholders .= $field . '=?,';
				} else {
					$placeholders .= '?,';
				}
			}
			
			// Normalize $fields and $placeholders for inserting
			$fields = substr($fields, 0, -1);
			$placeholders = substr($placeholders, 0, -1);
			
			return array( $fields, $placeholders, $values );
        }
        
		private function ref_values($array) 
		{
			$refs = array();

			foreach ($array as $key => $value) {
				$refs[$key] = &$array[$key]; 
			}

			return $refs; 
        }
		
		private function get_primary_key($tableName)
		{
			$db = $this->connect();
			$stmt = $db->prepare("SHOW KEYS FROM {$tableName} WHERE Key_name = 'PRIMARY'");
			$stmt->execute();
            
            $results = [];
			//Fetch results
			$result = $stmt->get_result();
			while ($row = $result->fetch_object()) {
				$results[] = $row;
			}

			return $results[0]->Column_name;
			
		}
        #endregion
	}
}

//print_r($db->insert('objects', array('post_title'=>'Abstraction Test', 'post_content' => 'Abstraction test content'), array('%s', '%s')));
//print_r($db->update('objects', array('post_title'=>'Abstraction Test Update', 'post_content' => 'Abstraction test update content'), array('%s', '%s'), array('ID'=>28), array('%d')));
//print_r($db->get_results("SELECT * FROM objects"));
//print_r($db->get_row("SELECT * FROM objects"));
//print_r($db->delete('objects', 9));