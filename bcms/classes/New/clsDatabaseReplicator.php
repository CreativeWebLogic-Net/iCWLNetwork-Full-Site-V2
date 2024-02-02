<?php
    class clsRetrieveRecordsReplicator extends clsServerTransfer{
        public $db_types=array();
		public $db_type_titles=array(0=>"clsDbMySQL",1=>"clsDbPG",2=>"clsDbSqlite");

        function __construct(){
			for($x=0;$x++;$x<count($this->db_type_titles)){
				$this->db_types[$x]=new $this->db_type_titles[$x]();
			}
		}
    }

?>