<?php


class Sae_Mysql{
    
   function addslashes_array($input_arr){
        if(is_array($input_arr)){
            $tmp = array();
            foreach ($input_arr as $key1 => $val){
                $key1 = addslashes($key1);
                $tmp[$key1] = addslashes($val);
            }
            return $tmp;
        }elseif(is_string($input_arr)){
            return addslashes($input_arr);
        }
    }  
    
    
    

    function orderselect($saetable,$field,$val,$order,$desc){
        $this->addslashes_array($saetable);
        $this->addslashes_array($field);
        $this->addslashes_array($val);
        $this->addslashes_array($order);
        $this->addslashes_array($desc);
        $wheredata = '';
        $wheredata = "`".$field."`='".$val."'";
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM `$saetable` WHERE ".$wheredata.'order by '.$order.' '.$desc;
        $mysql->closeDb(); 
        return $mysql->getData($sql); 
    }
    
    
    
    

    function simpleselect($saetable,$field,$val){
        $this->addslashes_array($saetable);
        $this->addslashes_array($field);
        $this->addslashes_array($val);        
        $wheredata = '';
        $wheredata = "`".$field."`='".$val."'";
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM `$saetable` WHERE ".$wheredata;
        $mysql->closeDb(); 
        return $mysql->getData($sql); 
    }


    
    function select($saetable,$where){
        $this->addslashes_array($saetable);
        $this->addslashes_array($where);
        $wheredata = '';
        foreach ($where as $key => $value) {
            $value = strip_tags($value);
            $wheredata = $wheredata."`".$key."`='".$value."' and ";
        }
        $wheredata = substr($wheredata,0,-5);
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM `$saetable` WHERE ".$wheredata;
        //return $sql;
        $mysql->closeDb(); 
        return $mysql->getData($sql);      
    }


    function selectwhere($saetable,$where){
        $this->addslashes_array($saetable);
        $this->addslashes_array($where);
        $wheredata = $where;
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM `$saetable` WHERE ".$wheredata;
        //echo $sql;
        //return $sql;
        $mysql->closeDb(); 
        return $mysql->getData($sql);      
    }


    
    function simpleupdate($saetable,$wherefield,$wheredata,$updatefield,$updatedata){
        
        $this->addslashes_array($saetable);
        $this->addslashes_array($wherefield);
        $this->addslashes_array($wheredata);
        $this->addslashes_array($updatefield);
        $this->addslashes_array($updatedata);
        $update = '';
        $where = '';

        $update = "`".$updatefield."` = '".$updatedata."'";
        $where = "`".$wherefield."` = '".$wheredata."'";

        $mysql = new SaeMysql();
        $sql = "UPDATE `$saetable` SET  ".$update." WHERE ".$where;
        $mysql->runSql($sql);
        if ($mysql->errno() != 0)
        {
            die("Error:" . $mysql->errmsg());
        }
        else
        {
        }

        $mysql->closeDb(); 
    }





    

    function saeupdate($saetable,$where,$update){
        $this->addslashes_array($saetable);
        $this->addslashes_array($where);
        $this->addslashes_array($update);

        $updatedata = '';
        $wheredata = '';

        foreach ($where as $key => $value) {
            $value = strip_tags($value);
            $wheredata = $wheredata."`".$key."`='".$value."' and ";
        }

        foreach ($update as $key => $value) {
            $value = strip_tags($value);
            $updatedata = $updatedata."`".$key."`='".$value."',";
        }

        $wheredata = substr($wheredata,0,-5);
        $updatedata = substr($updatedata,0,-1);

        $mysql = new SaeMysql();
        $sql = "UPDATE `$saetable` SET  ".$updatedata." WHERE ".$wheredata;
        $mysql->runSql($sql);
        if ($mysql->errno() != 0)
        {
            die("Error:" . $mysql->errmsg());
        }
        else
        {
        }

        $mysql->closeDb(); 
    }
    
    function saeinsert($saetable,$array){
        $this->addslashes_array($saetable);
        $this->addslashes_array($array);
        
        $field='';
        $values='';

        foreach ($array as $key => $value) {
            $value = strip_tags($value);
            $field = $field.'`'.$key.'`'.',';
            $values = $values.'"'.$value.'",';
        
        }
        $field = substr($field,0,-1);
        $values = substr($values,0,-1);

        $mysql = new SaeMysql();
        $sql = "INSERT  INTO `$saetable` ( ".$field.") VALUES (".$values.")";
        $mysql->runSql($sql);
        if ($mysql->errno() != 0)
        {
            die("Error:" . $mysql->errmsg());
        }
        else
        {
        }

        $mysql->closeDb();
        

    }


    function saefind($saetable,$field,$value){
        $this->addslashes_array($saetable);
        $this->addslashes_array($field);
        $this->addslashes_array($value);

        
        
        $mysql = new SaeMysql();
        $value = strip_tags($value);
        $findsql = "SELECT * FROM `$saetable`  WHERE $field  =  '$value'";
        echo $findsql;
        $findres = $mysql->runSql($findsql);        
        $row = $findres->num_rows;      
        $mysql->closeDb();
        return $row;
    }



}
