<?php 

if(isset($_POST) && !empty($_POST)){
    $postData = $_POST;
    
}
?>

<form id="redirectForm" method="POST" action="data">
    <?php foreach($postData as $key => $value) { ?>
        <input type="hidden" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>">
    <?php } ?>
</form>

<script type="text/javascript">
    document.getElementById('redirectForm').submit();
</script>
