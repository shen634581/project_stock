<?php
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["stocknumber"]) && isset($mydata["stockname"]) && isset($mydata["price"]) && isset($mydata["remark"]) && isset($mydata["date"])){
        if($mydata["stocknumber"] != "" && $mydata["stockname"] != "" && $mydata["price"] != "" && $mydata["remark"] != "" && $mydata["date"] != ""){
            $p_stocknumber = $mydata["stocknumber"];           
            $p_stockname = $mydata["stockname"];
            $p_price    = $mydata["price"];
            $p_remark    = $mydata["remark"];
            $p_date    = $mydata["date"];
            require_once("dbtools.php");
            $link = create_connection();
            $sql = "INSERT INTO stock(Stockdate, StockNum, StockName, Price, Remark) VALUES('$p_date','$p_stocknumber', '$p_stockname', '$p_price', '$p_remark')";
            if(execute_sql($link, "stock", $sql)){
                echo '{"state" : true, "message" : "新增成功"}';
            }else{
                echo '{"state" : false, "message" : "新增失敗"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位命名錯誤"}';
    }
?>