<?php
    include('./config.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $c_id = $mydata['cid'];
    $as = $mydata['as'];

    if($as == '1')
    {
        $as = '0';
    }
    else
    {
        $as = '1';
    }

    //echo $c_id;

    $query = "Update categories set active_status='".$as."' where category_id='".$c_id."'" ;
    $result = mysqli_query($conn, $query);

    if($result)
    {
        echo '1';
    }
    else
    {   
        echo '0';
    }
?>