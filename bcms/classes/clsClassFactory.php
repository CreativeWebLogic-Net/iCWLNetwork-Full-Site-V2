<?php


    class clsClassFactory{

        public static $all_vars=array();
        public static $vars;
        public $name_map=array('clsLog'=>'log','clsDatabaseInterface'=>'r','clsSession'=>'sess','clsAssortedFunctions'=>'log','clsExceptionHandler'=>'ex');

        function __construct(){
            self::Initialize_Basic_Classes();
		}
        function Initialize_Basic_Classes(){
            self::$vars=new clsObjectAccess();


            $ex=new clsExceptionHandler();
            self::$all_vars['ex']=new clsGenericProxy($ex);
            $log=new clsLog();
            self::$all_vars['log']=new clsGenericProxy($log);
            $r=new clsDatabaseInterface();
            self::$all_vars['r']=new clsGenericProxy($r);
            $sess=new clsSession();
            self::$all_vars['sess']=new clsGenericProxy($sess);
            $a=new clsAssortedFunctions();
            self::$all_vars['a']=new clsGenericProxy($a);

            //print_r(self::$all_vars);
            //exit("todo");
		}

        static function Initialize_Class_Variables($name){
            foreach(self::$all_vars as $key=>$val){

            }
		}

        static function Get_Class_Variable($name){
            $pos = strpos('cls', $name);
            if($pos>-1){
                $target_name=self::$name_map[$name];
            }else{
                $target_name=$name;
            }
            return self::$all_vars[$target_name];
		}

        static function Set_Class_Variable($name,$object){
            self::$all_vars[$name]=$object;
		}


    }