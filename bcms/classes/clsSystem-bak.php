<?php

    class clsSystem{
        private $app_data=array();
        private $module_data=array();
        private $domain_user_data=array();
        private $domain_data=array();
        private $template_data=array();
        private $content_data=array();
        private $text_data=array();
        private $bizcat_data=array();
        private $sidebar_data=array();
        private $news_data=array();
        private $content_domain_data=array();

        private $menu_data=array();
        private $all_data_arrays=array();
        private $all_data_names=array(0=>"app",1=>"module",2=>"domain_user",3=>"domain",4=>"template",5=>"content",6=>"text",
        7=>"bizcat",8=>"sidebar",9=>"news",10=>"content_domain",11=>"menu");
        private $all_classes=array();
        private $proxy_classes=array();

        private $sess;
        private $log;
        private $r;
        private $a;

        private $e;
        private $vs;

        private $Current_Dir="";

        private $membersID;
        private $template_code="";

        function __construct(){
            
		}

        static function execute_webpage(){
            $this->Find_Current_Directory();
            $this->Set_Autoloader();
            $this->Set_Exception_Handler();
            $this->Set_Error_Handler();
            
            $this->Set_Headers();
            
            
            $this->Set_Assorted();
            
			$this->Set_Log();
			$this->Set_Variables();
            $this->Set_Base_Constants();
            $this->Set_DataBase();
            $this->Set_Session_Handler();
            $this->Set_Data_Array_Vars();
            $this->Set_Each_Data_Vars();
            $this->Set_App_Vars();
            $this->Set_Asset_Servers();
            
            $this->Set_DataBase_Data_Array();
            $this->Set_Memebers();

            $this->Set_Domain_Init();
            $this->Set_Content_Init();
            $this->Set_Language_Init();
            $this->Set_Template_Init();
            $this->Set_Language_Definitions();
            $this->Set_Template();
            $this->Set_Content();
            $this->Output_HTML();
            $this->log->output_messages();
            $this->e->output_errors();
            //echo"xxx";
            //throw new Exception('Uncaught Exception');
        }

        function Set_Headers(){
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                $http_origin = $_SERVER['HTTP_ORIGIN'];
                header("Access-Control-Allow-Origin: $http_origin");
            }
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        }

        function Set_Autoloader(){
            include($this->Current_Dir."/classes/clsAutoloader.php");
            // Register the static method as the autoload function
            spl_autoload_register(array("clsAutoloader", "load"));
        }

        
        function Set_Session_Handler(){
            $this->sess = new clsSession();
            $this->sess->set_database($this->r);
            
            $this->sess->Set_Log($this->log);
            $this->sess->set_new_guid($this->make_guid());
            $this->sess->set_ip_address($_SERVER['REMOTE_ADDR']);
            $this->sess->session_set_globals();
            $this->sess->session_start();
            //$dir=$this->Current_Dir."/sessions/";
            //$this->sess->session_save_path($dir);
            
            //session_set_save_handler($this->sess, true);
            //session_start();
        
        }

        function Set_Class($class_name,$obj=null){
            if(is_null($obj)){
                $this->all_classes[$class_name]=new $class_name();
            }else{
                $this->all_classes[$class_name]=$obj;
            }
            $this->proxy_classes[$class_name] = new clsGenericProxy($this->all_classes[$class_name]);
		}

        function Set_Exception_Handler(){
            $this->all_classes["exception_handler"]=new clsExceptionHandler();
			set_exception_handler([$this->all_classes["exception_handler"], 'handle']);
		}

        function Set_Error_Handler(){
            $e=new clsError();
			$this->e=$e;
            set_error_handler(array($this, 'myErrorHandler'));
            //set_error_handler('clsError::myErrorHandler');
		}
        
        function Set_DataBase(){
            $r=new clsDatabaseInterface($this->log);
			$this->r=$r;
            $this->r->Set_Vs($this->vs);
            $this->Set_DataBase_Data_Array();
            $this->r->CreateDB();
            //trigger_error("Test Msg", E_USER_ERROR);
            //xxx
            //$this->r->Add_App_Data($this->app_data);
		}

        function myErrorHandler($errno, $errstr, $errfile, $errline)
        {
            $this->e->myErrorHandler($errno, $errstr, $errfile, $errline);
        }

        function Set_DataBase_Data_Array(){
            //print_r($this->app_data);
            $this->log->general("App Data Array ",4,$this->app_data);
            //echo"kkk";
            $this->r->Add_App_Data($this->app_data);
		}

        function Set_Log(){
            $log = new clsLog();
			$this->log=$log;
			
		}

        function Set_Variables(){
            $this->vs=new clsVariables();
		    $this->vs->Set_Log($this->log);
			
		}

        function Find_Current_Directory()
        {
            if($this->Current_Dir==""){
                $this->Current_Dir=pathinfo(__DIR__);
            }
            $this->Current_Dir=$this->Current_Dir['dirname'];
            //print_R($this->Current_Dir);
            //return $this->Current_Dir;
            
            
        }

        function Set_Assorted($tag_match_array=array()){
            $this->a=new clsAssortedFunctions();
            //$this->Current_Dir=$this->a->Find_Current_Directory();
            //print_r($this->Current_Dir);
            //$this->a->add_tag_array($this->a->tag_replace());
		}

        function Set_Data_Array_Vars(){
			//----------------------------------------------------------------
            // root data types
            //----------------------------------------------------------------
            $this->all_data_arrays[$this->all_data_names[0]."_data"]=$this->app_data;
            $this->all_data_arrays[$this->all_data_names[1]."_data"]=$this->module_data;
            $this->all_data_arrays[$this->all_data_names[2]."_data"]=$this->domain_user_data;
            $this->all_data_arrays[$this->all_data_names[3]."_data"]=$this->domain_data;
            $this->all_data_arrays[$this->all_data_names[4]."_data"]=$this->template_data;
            $this->all_data_arrays[$this->all_data_names[5]."_data"]=$this->content_data;
            $this->all_data_arrays[$this->all_data_names[6]."_data"]=$this->text_data;
            $this->all_data_arrays[$this->all_data_names[7]."_data"]=$this->bizcat_data;
            $this->all_data_arrays[$this->all_data_names[8]."_data"]=$this->sidebar_data;
            $this->all_data_arrays[$this->all_data_names[9]."_data"]=$this->news_data;
            $this->all_data_arrays[$this->all_data_names[10]."_data"]=$this->content_domain_data;
            $this->all_data_arrays[$this->all_data_names[11]."_data"]=$this->menu_data;
		}

        function Set_Each_Data_Vars(){
			//----------------------------------------------------------------
            // root data types
            //----------------------------------------------------------------
            $this->app_data=$this->all_data_arrays[$this->all_data_names[0]."_data"];
            $this->module_data=$this->all_data_arrays[$this->all_data_names[1]."_data"];
            $this->domain_user_data=$this->all_data_arrays[$this->all_data_names[2]."_data"];
            $this->domain_data=$this->all_data_arrays[$this->all_data_names[3]."_data"];
            $this->template_data=$this->all_data_arrays[$this->all_data_names[4]."_data"];
            $this->content_data=$this->all_data_arrays[$this->all_data_names[5]."_data"];
            $this->text_data=$this->all_data_arrays[$this->all_data_names[6]."_data"];
            $this->bizcat_data=$this->all_data_arrays[$this->all_data_names[7]."_data"];
            $this->sidebar_data=$this->all_data_arrays[$this->all_data_names[8]."_data"];
            $this->news_data=$this->all_data_arrays[$this->all_data_names[9]."_data"];
            $this->content_domain_data=$this->all_data_arrays[$this->all_data_names[10]."_data"];
            $this->menu_data=$this->all_data_arrays[$this->all_data_names[11]."_data"];
		}

        function Set_App_Vars(){
			//----------------------------------------------------------------
            // root data types
            //----------------------------------------------------------------
            
            $this->module_data=array();
            $this->module_data['db']=array();
            $this->domain_data['db']=array();
            $this->template_data['db']=array();
            $this->content_data['db']=array();
            $this->text_data['db']=array();
		}

        function Set_Asset_Servers(){
            //--------------------------------------------------
            
            //print_r($current_dir);
            //echo"0001-----------------------------------------------------------------------------\n";
            //----------------------------------static asset files------------------------------
            $this->app_data['asset-severs'][0]='https://assets.bubblecms.biz/'; // linode server
            $this->app_data['asset-severs'][1]='https://spaces.auseo.net/'; // digital ocean custom server
            $this->app_data['asset-severs'][2]='https://static-cms.nyc3.cdn.digitaloceanspaces.com/'; // digital ocean cdn server
            $this->app_data['asset-severs'][3]='https://static-cms.nyc3.digitaloceanspaces.com/'; //digital ocean standard server
            $this->app_data['asset-severs'][4]='https://assets.ownpage.club/'; //asura standard server
            $this->app_data['asset-severs'][5]='https://assets.hostingdiscount.club/'; //asura reseller server
            $this->app_data['asset-severs'][6]='https://assets.icwl.me/'; //hostgator reseller server
            $this->app_data['asset-severs'][7]='https://static-assets.w-d.biz/'; //cloud unlimited server
            $this->app_data['asset-severs'][8]='https://assets.i-n.club/'; //ionos unlimited server
            $this->app_data['asset-severs'][9]='https://assets.creativeweblogic.net/'; //ionos unlimited server
            $this->app_data['asset-severs'][10]='https://static-assets.site/'; //ionos unlimited server
            $this->app_data['asset-severs'][11]='https://f005.backblazeb2.com/file/iCWLNet-Website-Assets/';

            $this->app_data['current_asset-sever']=$this->app_data['asset-severs'][11];
            
            $this->app_data["include_callback"]="callback";
            //----------------------------------------------------------------
        }

        function Set_Base_Constants(){
            //echo"xxx";
            //if(isset($_GET['cpid'])){
            $root_array=explode('/',$_SERVER['PHP_SELF']);
            //print_r($root_array);
            if($root_array[1]=="bcms"){
                $this->app_data['APPBASEDIR']='./';
                $this->app_data['ROOTDIR']='//bcms//';
            }else{
                $this->app_data['APPBASEDIR']='bcms/';
                $this->app_data['ROOTDIR']='/';
            }
            //echo"000101-----------------------------------------------------------------------------\n";
            $this->app_data['APPLICATIONSDIR']=$this->app_data['APPBASEDIR'].'apps';
            $this->app_data['MODULEBASEDIR']=$this->app_data['APPBASEDIR'].'modules/';
            $this->app_data['CLASSESBASEDIR']=$this->app_data['APPBASEDIR'].'classes/';
            $this->app_data['INCLUDESBASEDIR']=$this->app_data['APPBASEDIR'].'includes/';
            //----------------------------------------------------------------
        }

        function Set_Memebers(){
            
            if(isset($_SESSION['membersID'])){
                $this->membersID=$_SESSION['membersID'];
            }else{
                
                $this->membersID=0;
            }
        }
        function Set_Domain_Init(){
            $this->all_classes["domain"]=new clsDomain();
            $this->all_classes["domain"]->Set_DataBase($this->r);
            $this->all_classes["domain"]->Set_Log($this->log);
            //$content_domain_data,$content_data,$domain_data,$domain_user_data,$app_data
            $this->all_classes["domain"]->Domain_Set_Data_Arrays($this->content_domain_data,$this->content_data,$this->domain_data,$this->domain_user_data,$this->app_data);
            $this->all_classes["domain"]->Domain_Init();
            $temp_array=$this->all_classes["domain"]->Domain_Get_Data_Arrays();
            $this->Set_Data_Array_Changes($temp_array);
        }
        function Set_Content_Init(){
            $this->all_classes["content"]=new clsContent();
            $this->all_classes["content"]->Set_DataBase($this->r);
            $this->all_classes["content"]->Set_Log($this->log);
            $this->all_classes["content"]->Set_Assorted($this->a);
            //$content_domain_data,$content_data,$domain_data,$domain_user_data,$module_data,$bizcat_data,$app_data
            $this->all_classes["content"]->Content_Set_Data_Arrays($this->content_domain_data,$this->content_data,$this->domain_data,$this->domain_user_data,$this->module_data,$this->bizcat_data,$this->app_data);
            $this->all_classes["content"]->Content_Init();
            $temp_array=$this->all_classes["content"]->Content_Get_Data_Arrays();
            $this->Set_Data_Array_Changes($temp_array);
        }
        function Set_Language_Init(){
            $this->all_classes["language"]=new clsLanguage();
            $this->all_classes["language"]->Set_DataBase($this->r);
            $this->all_classes["language"]->Set_Log($this->log);
            $this->all_classes["language"]->Language_Set_Data_Arrays($this->app_data);
            $this->all_classes["language"]->Language_Init();
            $temp_array=$this->all_classes["language"]->Language_Get_Data_Arrays();
            $this->Set_Data_Array_Changes($temp_array);
        }

        function Set_Template_Init(){
            $this->all_classes["template"]=new clsTemplate();
            $this->all_classes["template"]->Set_DataBase($this->r);
            $this->all_classes["template"]->Set_Log($this->log);
            $this->all_classes["template"]->Set_Assorted($this->a);
            $this->all_classes["template"]->Template_Set_Data_Arrays($this->template_data,$this->content_data,$this->domain_data,$this->app_data);
            $this->all_classes["template"]->Template_Init();
            $temp_array=$this->all_classes["template"]->Template_Get_Data_Arrays();
            $this->Set_Data_Array_Changes($temp_array);
        }

        function Set_Data_Array_Changes($temp_array){
            foreach($temp_array as $key=>$val){
                $this->all_data_arrays[$key."_data"]=$val;
            }
            $this->Set_Each_Data_Vars();
        }

        function Set_Language_Definitions(){
            //$language=new clsLanguage();
            $this->all_classes["language"]->Language_Definitions();
        }

        function Set_Template(){
            $template_code="";
            $this->template_code=$this->all_classes["template"]->Run_Template();
            
            //print $template_code;
        }

        function Set_Modules(){
            $this->all_classes["module"]=new clsModules();
            $this->all_classes["module"]->Set_DataBase($this->r);
            $this->all_classes["module"]->Set_Log($this->log);
            $this->module_data['db']=$this->all_classes["module"]->Find_Module($this->all_data_arrays["content_data"]["db"]['id']);
            $this->module_data['views']=$this->all_classes["module"]->Find_Module_View($this->all_data_arrays["content_data"]["db"]['module_viewsID']);
            $temp_array=$this->all_classes["module"]->Language_Get_Data_Arrays();
            $this->Set_Data_Array_Changes($temp_array);
        }

        function Output_HTML(){
            $output_code=$this->template_code;
            $keywords=$this->all_data_arrays["content_data"]["db"];
            $main_menu="";
            $main_content="";
            $tag_match_array=array("asset-sever"=>$this->app_data['current_asset-sever'],"html-title"=>$keywords['title'],"dc-title"=>$keywords['meta_title'],
            "meta_description"=>$keywords['meta_description'],"meta_keywords"=>$keywords['meta_keywords'],"main-menu"=>$main_menu,
            "main-title"=>$keywords['title'],"main-content"=>$main_content);
            $output_code=$this->a->modify_tags($this->template_code,$tag_match_array);
            print $output_code;
            //print_r( $this->all_data_arrays);
        }


       

        function make_guid ($length=32) 
		{ 
			$key="";    
            $minlength=$length;
            $maxlength=$length;
            $charset = "abcdefghijklmnopqrstuvwxyz"; 
            $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
            $charset .= "0123456789"; 
            if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
            else                         $length = mt_rand ($minlength, $maxlength); 
            for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
            return $key;
		}
    }
