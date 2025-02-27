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
    $sql .= "WHERE id = '" . db_escape($db,$id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}
function validate_subject($subject) {

    $errors = [];
    
    // menu_name
    if(is_blank($subject['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
  
    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }
  
    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }
  
    return $errors;
}
function insert_subject($subject) {
    global $db;

    $errors = validate_subject($subject);
    if(!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db,$subject['menu_name']) ."',";
    $sql .= "'" . db_escape($db,$subject['position']) ."',";
    $sql .= "'" . db_escape($db,$subject['visible']) ."'";
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
function update_subject($subject) {
    global $db;

    $errors = validate_subject($subject);
    if(!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE Subjects SET ";
    $sql .= "menu_name='" . db_escape($db,$subject['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db,$subject['position']) . "', ";
    $sql .= "visible='" . db_escape($db,$subject['visible']) . "' ";
    $sql .= "WHERE id='" . db_escape($db,$subject['id']) . "' ";
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
function delete_subject($id) {
    global $db;

    $sql = "DELETE FROM Subjects ";
    $sql .= "WHERE id='" . db_escape($db,$id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if($result) {
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
function find_page_by_id($id) {
    global $db;
    $sql = "SELECT * FROM Pages ";
    $sql .= "WHERE id = '" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $pages = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $pages;
}
function insert_page($page) {
    global $db;
    $errors = validate_page($page);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . $page['subject_id'] . "',";
    $sql .= "'" . $page['menu_name'] . "',";
    $sql .= "'" . $page['position'] . "',";
    $sql .= "'" . $page['visible'] . "',";
    $sql .= "'" . $page['content'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}
function update_page($page) {
    global $db;

    $errors = validate_page($page);
    if(!empty($errors)) {
      return $errors;
    }
    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . $page['subject_id'] . "', ";
    $sql .= "menu_name='" . $page['menu_name'] . "', ";
    $sql .= "position='" . $page['position'] . "', ";
    $sql .= "visible='" . $page['visible'] . "', ";
    $sql .= "content='" . $page['content'] . "' ";
    $sql .= "WHERE id='" . $page['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

}
function delete_page($id) {
    global $db;

    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}
function validate_page($page) {

  $errors = [];
  // subject id
  if(is_blank($page['subject_id'])) {
    $errors[] = "Subject cannot be blank.";
  }
  // menu_name
  if(is_blank($page['menu_name'])) {
    $errors[] = "Name cannot be blank.";
  } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Name must be between 2 and 255 characters.";
  }
  $current_id = $page['id'] ?? '0';
  if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
    $errors[] = "Menu name must be unique";
  }

  // position
  // Make sure we are working with an integer
  $postion_int = (int) $page['position'];
  if($postion_int <= 0) {
    $errors[] = "Position must be greater than zero.";
  }
  if($postion_int > 999) {
    $errors[] = "Position must be less than 999.";
  }

  // visible
  // Make sure we are working with a string
  $visible_str = (string) $page['visible'];
  if(!has_inclusion_of($visible_str, ["0","1"])) {
    $errors[] = "Visible must be true or false.";
  }
  //content
  if(is_blank($page['content'])) {
    $errors[] = "Content cannot be blank.";
  }

  return $errors;
}
?>