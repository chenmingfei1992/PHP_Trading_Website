
 <?php
function getNextId($mongo,$name,$param=array()){  
  
     $param += array(   //默认ID从1开始,间隔是1  
       'init' => 1,  
       'step' => 1,  
     );  
  
     $update = array('$inc'=>array('id'=>$param['step']));   //设置间隔  
     $query = array('name'=>$name);  
     $command = array(  
        'findandmodify' => 'ids',  
        'update' => $update,  
        'query' => $query,  
        'new' => true  
     );  
  
     $id = $mongo->db->command($command);  
     if (isset($id['value']['id'])) {  
        return $id['value']['id'];  
     }else{  
        $mongo->insert(array(  
           'name' => $name,  
           'id' => $param['init'],     //设置ID起始数值  
        ));  
        return $param['init'];  
    }  
}   
?>