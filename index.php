<?php include('includes/header.php'); ?>
<div class="container">
    <div class="search-box">
        <input type="text" id="search-input" placeholder="Search cars..." onfocus="showRecentSearches()" onblur="hideRecentSearches()">
        <div id="suggestions" class="suggestions"></div>
        <div id="recent-searches" class="recent-searches"></div>
    </div>
    <div class="car-categories">
        <button onclick="toggleCategories()">Browse products</button>
        <div id="categories-list" class="categories-list">
            <ul>
                <li><a href="category.php?type=sedan">Sedan</a></li>
                <li><a href="category.php?type=suv">SUV</a></li>
                <li><a href="category.php?type=coupe">Coupe</a></li>
                <li><a href="category.php?type=hatchback">Hatchback</a></li>
            </ul>
        </div>
    </div>
    <div id="car-grid" class="car-grid"></div>
</div>
<?php include('includes/footer.php'); ?>
<script src="assets/js/scripts.js"></script>
