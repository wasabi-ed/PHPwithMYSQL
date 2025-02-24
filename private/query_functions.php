<?php
function find_all_subjects() {
    global $db;
    $sql = "SELECT * FROM Subjects ";
    $sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
    
?>