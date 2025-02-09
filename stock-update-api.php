<?php
$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["id"]) && isset($mydata["remark"])){
    if ($mydata["id"] != "" && $mydata["remark"] != "") {
        $p_id = $mydata["id"];
        $p_remark = $mydata["remark"];
        require_once("dbtools.php");
        $link = create_connection();

        $sql = "UPDATE stock SET Remark = '$p_remark' WHERE Id = '$p_id'";

       
     
        if( execute_sql($link, "stock", $sql)){
            echo '{"state" : true,"message" : "更新成功"}';
        }else{
            
            echo '{"state" : false, "message" : "更新失敗和錯誤代碼等"}';
        }
        mysqli_close($link);
           
       
    } else {
        echo '{"state" : false, "message" : "欄位不得為空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位命名錯誤"}';
}
?>