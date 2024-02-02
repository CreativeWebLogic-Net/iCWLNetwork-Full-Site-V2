<?php
    class clsCodeFactory extends clsVariables{
		public $db_classes=array();
		public $db_class_titles=array(0=>"clsDBConnect",1=>"clsUpdateDatabase",
		2=>"clsAddToDatabase",3=>"clsRetrieveRecords",4=>"clsDeleteFromDatabase",5=>"clsBulkDBChange");
		public $common_classes=array();
		public $common_class_titles=array(0=>"clsAutokeyword",1=>"clsEmail",2=>"clsCountVisitors",3=>"clsMembers",
		4=>"clsDomains",5=>"clsContent",6=>"clsLanguages",7=>"clsCategories",8=>"clsAssets",9=>"clsMenus",10=>"clsPages",11=>"clsNews",12=>"clsSetup",13=>"clsTemplates");
		function __construct(){
			for($x=0;$x++;$x<count($this->db_class_titles)){
				$this->db_classes[$x]=new $this->db_class_titles[$x]();
			}
			/*
			$this->db_classes["clsRetrieveRecordsConnect"]=new clsRetrieveRecordsConnect();
			$this->db_classes["clsUpdateDatabase"]=new clsUpdateDatabase();
			$this->db_classes["clsAddToDatabase"]=new clsAddToDatabase();
			$this->db_classes["clsRetrieveRecords"]=new clsRetrieveRecords();
			$this->db_classes["clsDeleteFromDatabase"]=new clsDeleteFromDatabase();
			$this->db_classes["clsBulkDBChange"]=new clsBulkDBChange();
			*/
		}

	}


?>