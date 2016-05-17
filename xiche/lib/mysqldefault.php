<?php


class Sae_Mysql{

    function orderselect($saetable,$field,$val,$order,$desc){
        $wheredata = '';
        $wheredata = "`".$field."`='".$val."'";
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM `$saetable` WHERE ".$wheredata.'order by '.$order.' '.$desc;
        //echo $sql;
        /*
        $mysql->runSql($sql);
        if ($mysql->errno() != 0)
        {
            die("Error:" . $mysql->errmsg());
        }
        else
        {
        }
        */
        $mysql->closeDb(); 
        return $mysql->getData($sql); 
    }
    
    
    
    

    function simpleselect($saetable,$field,$val){
        $wheredata = '';
        $wheredata = "`".$field."`='".$val."'";
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM `$saetable` WHERE ".$wheredata;
        //echo $sql;
        /*
        $mysql->runSql($sql);
        if ($mysql->errno() != 0)
        {
            die("Error:" . $mysql->errmsg());
        }
        else
        {
        }
        */
        $mysql->closeDb(); 
        return $mysql->getData($sql); 
    }


    
    function select($saetable,$where){
        $wheredata = '';
        foreach ($where as $key => $value) {
            $value = strip_tags($value);
            $wheredata = $wheredata."`".$key."`='".$value."' and ";
        }
        $wheredata = substr($wheredata,0,-5);
        $mysql = new SaeMysql();
        $sql = "SELECT * FROM `$saetable` WHERE ".$wheredata;
        //echo $sql;
        /*
        $mysql->runSql($sql);
        if ($mysql->errno() != 0)
        {
            die("Error:" . $mysql->errmsg());
        }
        else
        {
        }
        */
        $mysql->closeDb(); 
        return $mysql->getData($sql);      
        
    }
    
    function simpleupdate($saetable,$wherefield,$wheredata,$updatefield,$updatedata){
        //UPDATE  `app_wushuiapp`.`order` SET  `orderstatus` =  '2' WHERE  `order`.`orderid` =2015112757521005;
        //UPDATE  `app_wushuiapp`.`order` SET  `service` =  '11',`address` =  'baoann' WHERE  `order`.`orderid` =2015112757521005;
        $update = '';
        $where = '';


        $update = "`".$updatefield."` = '".$updatedata."'";
        $where = "`".$wherefield."` = '".$wheredata."'";

        $mysql = new SaeMysql();
        $sql = "UPDATE `$saetable` SET  ".$update." WHERE ".$where;
        //echo $sql;
        //die();
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
        //UPDATE  `app_wushuiapp`.`order` SET  `orderstatus` =  '2' WHERE  `order`.`orderid` =2015112757521005;
        //UPDATE  `app_wushuiapp`.`order` SET  `service` =  '11',`address` =  'baoann' WHERE  `order`.`orderid` =2015112757521005;
        $updatedata = '';
        $wheredata = '';
        //$where = array('orderid' => 1, 'staffid'=>0 );
        //$update = array('orderstatus' => 2, 'staffid'=>2);

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
        //echo $sql;
        //die();
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

        $field='';
        $values='';

        foreach ($array as $key => $value) {
            
            //$value = strip_tags($value);
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
            //echo '注册成功';
        }

        $mysql->closeDb();
        

    }


    function saefind($saetable,$field,$value){

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

/*
    $mysql = new SaeMysql();
    $name = strip_tags( $user['nikename'] );
    $openid = strip_tags($user['openid']);
    $usergroup = 1;
    
    $findsql = "SELECT * FROM user  WHERE openid  =  '$openid'";
    $findres = $mysql->runSql($findsql);
    
    $row = $findres->num_rows;
    //var_dump($findres->num_rows);
    if($row)
    {
        echo '已经注册';
    }
    else
    {
    $sql = "INSERT  INTO `user` ( `openid`, `nickname`, `usergroup`) VALUES ('$openid','$nickname','$usergroup')";
    $mysql->runSql($sql);
        echo '未注册';
    }
    
    //die();

    if ($mysql->errno() != 0)
    {
      die("Error:" . $mysql->errmsg());
}
else
{
    echo '注册成功';
}

$mysql->closeDb();


*/