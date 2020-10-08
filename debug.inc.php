<?php

echo '<pre>';

$returnArr=dbConn('u_logsend');
$mdbHost=$returnArr['host'];$dbName=$returnArr['dbname'];
if($mysql_main_Arr[$mdbHost]){
    $sql="SELECT * FROM {$dbName}.`u_logsend202010` WHERE  1";
    $result=mysqli_query($mysql_main_Arr[$mdbHost],$sql);
    if($result){        
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);   
        print_r($row);
    }
}
echo $mdbHost,'<br>';
$returnArr=dbConn('user_magic_log');
$mdbHost=$returnArr['host'];$dbName=$returnArr['dbname'];
if($mysql_main_Arr[$mdbHost]){
    echo __LINE__.'OK<br>';
    $sql="SELECT * FROM {$dbName}.`user_magic_log202010` WHERE  1 LIMIT 1";
    $result=mysqli_query($mysql_main_Arr[$mdbHost],$sql);
    if($result){       
        echo __LINE__.'OK<br>'; 
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);   
        print_r($row);
    }
}
echo $mdbHost,'<br>';



//链接主库
if(!$mysql_main){
    $mysql_main = mysqli_connect($configArr['hostname'],$configArr['username'],$configArr['password'],$configArr['database']);
    mysqli_query($mysql_main,"set names '".$configArr['charset']."';");                      
}

//连接 _s库
if(!$mysql_main_sub){
    $mysql_main_sub = mysqli_connect($configArr['HOSTS_SUB'],$configArr['username'],$configArr['password'],$configArr['database'].'_s');
    mysqli_query($mysql_main_sub,"set names '".$configArr['charset']."';");                      
} 
//链接 _d库
if(!$mysql_main_d){
    $mysql_main_d = mysqli_connect($configArr['HOSTS_D'],$configArr['username'],$configArr['password'],$configArr['database'].'_d');
    mysqli_query($mysql_main_d,"set names '".$configArr['charset']."';");                      
} 


//链接 _m 库
	$returnArr=getuserSub($pidV);
	$tbl_sub=$returnArr['tbl_sub'];$outArr['L'][__LINE__]=$tbl_sub;
	$mdbHost=$returnArr['host'];
    if(!$mysql_main_m){
        $mysql_main_m = mysqli_connect($mdbHost,$configArr['username'],$configArr['password'],$configArr['database'].'_m');
        mysqli_query($mysql_main_m,"set names '".$configArr['charset']."';");                                      
    }
//#############################################################
//只读一条
    $sql="SELECT id,mobile,nick_name FROM `user` WHERE `id`=1 LIMIT 1";//检查是否已存在的记录
    $result=mysqli_query($mysql_main,$sql);
    if($result){        
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        
    }

    echo '<pre>'; print_r($row);echo '</pre>';

//读多条
    $userArr=array();
    $sql="SELECT id,mobile,nick_name FROM `user` WHERE 1 LIMIT 5";//检查是否已存在的记录
    $result=mysqli_query($mysql_main,$sql);
    if($result){        
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $userArr[]=$row;
        }       
    }    

    echo '<pre>'; print_r($userArr);echo '</pre>';



echo json_encode($userArr); 

    
?>