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
function insert_subject($subject) {
    global $db;

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . $subject['menu_name'] ."',";
    $sql .= "'" . $subject['position'] ."',";
    $sql .= "'" . $subject['visible'] ."'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result){
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function find_all_pages() {
    global $db;

    $sql = "SELECT * FROM Pages ";
    $sql .= "ORDER BY subject_id ASC, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
function update_subject($subject) {
    global $db;

    $sql = "UPDATE Subjects SET ";
    $sql .= "menu_name='" . $subject['menu_name'] . "', ";
    $sql .= "position='" . $subject['position'] . "', ";
    $sql .= "visible='" . $subject['visible'] . "' ";
    $sql .= "WHERE id='" . $subject['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    //for UPDATE statements, $result is true/false
    if($result) {
        return true;
    } else {
        //UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

?>