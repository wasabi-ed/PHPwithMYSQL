<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<?php $id = $_GET['id'] ?? '1'; ?>
<div id="content">
    
    <a href="<?php echo url_for('pages/index.php'); ?>"><?php echo h("<< Back to List")?></a>
    <div class="page show">Page ID: <?php echo h($id); ?></div>
  
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>