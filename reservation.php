<?php include('includes/header.php'); ?>
<div class="container">
    <h2>Reservation</h2>
    <div id="reservation-form">
        <!-- Reservation form will be dynamically populated -->
    </div>
</div>
<?php include('includes/footer.php'); ?>
<script src="assets/js/scripts.js"></script>
<script>
    // Get query parameters from URL
    const urlParams = new URLSearchParams(window.location.search);
    const carId = urlParams.get('carId');

    // Function to populate the reservation form
    function populateReservationForm(car) {
        const reservationForm = `
            <form action="api/reservation.php" method="post" onsubmit="return validateForm()">
                <input type="hidden" name="carId" value="${car.id}">
                <p>Car Model: <span id="car-model">${car.brand} ${car.model}</span></p>
                <p>Price per Day: $<span id="price-per-day">${car.price_per_day}</span></p>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="${car.quantity}" required>
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" required>
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" required>
                <p>Total Cost: $<span id="total-cost">0</span></p>
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="mobile">Mobile:</label>
                <input type="text" name="mobile" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="license">Driver's License:</label>
                <input type="text" name="license" required>
                <button type="submit">Reserve</button>
                <button type="button" onclick="cancelReservation()">Cancel</button>
            </form>
        `;
        document.getElementById('reservation-form').innerHTML = reservationForm;
        calculateTotalCost();
    }

    // Function to calculate the total cost
    function calculateTotalCost() {
        const quantity = document.getElementById('quantity').value;
        const pricePerDay = document.getElementById('price-per-day').innerText;
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        const totalCost = quantity * pricePerDay * diffDays;
        document.getElementById('total-cost').innerText = totalCost.toFixed(2);
    }

    // Event listeners for dynamic cost calculation
    document.addEventListener('change', (event) => {
        if (['quantity', 'start_date', 'end_date'].includes(event.target.id)) {
            calculateTotalCost();
        }
    });

    // Function to validate the reservation form
    function validateForm() {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);
        if (startDate >= endDate) {
            alert('End date must be after start date.');
            return false;
        }
        return true;
    }

    // Function to cancel the reservation
    function cancelReservation() {
        window.location.href = 'index.php';
    }

    // Fetch car details by ID and populate the form
    if (carId) {
        getCarById(carId).then(car => {
            populateReservationForm(car);
        });
    }
</script>
