<?php 
    if(!isset($page_title)) { $page_title = 'Staff Area';}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>GBI - <?php echo $page_title; ?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" media="all" href="<?php echo url_for('../stylesheets/staff.css'); ?>" />
    </head>

    <body>
        <header>
            <h1>GBI Staff Area</h1>
        </header>

        <navigation>
            <ul>
                <li><a href="<?php echo WWW_ROOT . 'index.php'; ?>">Menu</a></li>
            </ul>
        </navigation>
    </body>
</html>