<?php include('includes/header.php'); ?>
<div class="container">
    <div id="car-grid" class="car-grid"></div>
</div>
<?php include('includes/footer.php'); ?>
<script src="assets/js/scripts.js"></script> <!-- Added script source -->
<script>
    const category = '<?php echo $_GET["type"]; ?>';
    console.log('Category:', category); // Debugging statement
    fetchCarsByCategory(category);
</script>
