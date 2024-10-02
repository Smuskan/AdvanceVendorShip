<?php
    include("./config.php");

    $challanid = $_POST['challanid'];

    $query = "SELECT * FROM challandetails WHERE ChallanId = {$challanid}";
    $result = mysqli_query($conn, $query);

    if($result){
        if($result->num_rows > 0){
            mysqli_autocommit($conn, false);

            while($row = $result->fetch_assoc()){
                $stockid = $row['StockId'];
                $billingqty = $row['BillingQty'];
                $otherqty = $row['OtherQty'];

                $updateSock = "UPDATE stockdetails SET BillingQty = BillingQty + {$billingqty}, OtherQty = OtherQty + {$otherqty} WHERE StockId = {$stockid}";
                $result_updateStocks = mysqli_query($conn, $updateSock);

                if(!$result_updateStocks){
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die("-3"); // -3 => Error In Updating Stocks
                }
            }

            $updateRecStatus = "UPDATE challanmst SET RecStatus = false WHERE ChallanId = {$challanid}";
            $result_updateRecStatus = mysqli_query($conn, $updateRecStatus);
            if(!$result_updateRecStatus){
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-5"); // -5 => Error In Updating Rec Status
            }
            
            if(mysqli_commit($conn)){
                mysqli_autocommit($conn, true);
                echo "1"; // 1 => success
            }
            else{
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-4"); // -4 => Error In Commit
            }
        }
        else{
            die("-2"); // -2 => No Record Found
        }
    }
    else{
        die("-1"); // -1 => Error In Query
    }
?>