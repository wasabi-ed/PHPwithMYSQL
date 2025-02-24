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
function find_subject_by_id($id){
    global $db;
    $sql = "SELECT * FROM Subjects ";
    $sql .= "WHERE id = '" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}
function find_all_pages() {
    global $db;

    $sql = "SELECT * FROM Pages ";
    $sql .= "ORDER BY subject_id ASC, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
    
?>