<?php include('includes/header.php'); ?>
<div class="container">
    <div id="car-grid" class="car-grid"></div>
</div>
<?php include('includes/footer.php'); ?>
<script>
    const category = '<?php echo $_GET["type"]; ?>';
    fetchCarsByCategory(category);
</script>
