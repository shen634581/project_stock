<?php


$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["id"])){
    if ($mydata["id"] != "") {
        $p_id = $mydata["id"];
      
        require_once("dbtools.php");
        $link = create_connection();

        $sql = "DELETE FROM stock WHERE Id = '$p_id'";

       
     
        if( execute_sql($link, "stock", $sql)){
            echo '{"state" : true,"message" : "刪除成功"}';
        }else{
            
            echo '{"state" : false, "message" : "刪除失敗和錯誤代碼等"}';
        }
        mysqli_close($link);
           
       
    } else {
        echo '{"state" : false, "message" : "欄位不得為空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位命名錯誤"}';
}
?>