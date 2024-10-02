<?php

    include('./config.php');
    $result = mysqli_query($conn, "SELECT DISTINCT Code From ProductMst Where RecStatus = true");

    if($result)
    {
        if($result->num_rows>0)
        {
            $flag = array('FLAG' => "OKK");
            $dataToBeSent[] = $flag;

            while($row = $result -> fetch_assoc())
            {
                $code = $row['Code'];

                $obj = array('code' => $code);
                $dataToBeSent[] = $obj;
            }

            echo json_encode($dataToBeSent);
        }
        else
        {
            $flag = array('FLAG' => "NORECORD");
            $dataToBeSent[] = $flag;
            echo json_encode($dataToBeSent);
        }
    }
    else
    {
        $flag = array('FLAG' => "ERREXECUTINGQUERY");
        $dataToBeSent[] = $flag;
        echo json_encode($dataToBeSent);
    }

?>