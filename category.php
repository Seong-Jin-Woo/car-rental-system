<?php include('includes/header.php'); ?>
<div class="container">
    <div id="car-grid" class="car-grid"></div>
    <div id="reservation-form"></div> <!-- Ensure this div is present -->
</div>
<?php include('includes/footer.php'); ?>
<script src="assets/js/scripts.js"></script>
<script>
    const category = '<?php echo $_GET["type"]; ?>';
    console.log('Category:', category); // Debugging statement
    fetchCarsByCategory(category);
</script>
