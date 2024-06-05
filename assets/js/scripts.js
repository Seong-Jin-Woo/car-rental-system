let recentSearches = [];

document.getElementById('search-input').addEventListener('input', function() {
    let keyword = this.value;
    if (keyword.length > 2) {
        searchCars(keyword);
    } else {
        document.getElementById('suggestions').style.display = 'none';
    }
});

function searchCars(keyword) {
    fetch(`api/search.php?keyword=${keyword}`)
        .then(response => response.json())
        .then(data => {
            console.log('Search results:', data); // Debugging statement
            displaySuggestions(data);
            displayCars(data);
        })
        .catch(error => console.error('Error:', error));
}

function displaySuggestions(cars) {
    let suggestions = document.getElementById('suggestions');
    suggestions.innerHTML = '';
    if (cars.length > 0) {
        cars.forEach(car => {
            let suggestionDiv = document.createElement('div');
            suggestionDiv.innerText = `${car.brand} ${car.model}`;
            suggestionDiv.onclick = () => {
                document.getElementById('search-input').value = suggestionDiv.innerText;
                displayCars([car]);
                addRecentSearch(suggestionDiv.innerText);
                suggestions.style.display = 'none';
            };
            suggestions.appendChild(suggestionDiv);
        });
        suggestions.style.display = 'block';
    } else {
        suggestions.style.display = 'none';
    }
}

function displayCars(cars) {
    let carGrid = document.getElementById('car-grid');
    carGrid.innerHTML = '';
    if (cars.length > 0) {
        cars.forEach(car => {
            let carDiv = document.createElement('div');
            carDiv.classList.add('car');
            carDiv.innerHTML = `
                <img src="assets/images/${car.image}" alt="${car.model}">
                <h3>${car.model}</h3>
                <p>$${car.price_per_day} per day</p>
                <p>${car.availability ? 'Available' : 'Not Available'}</p>
                <button onclick="rentCar(${car.id})" ${!car.availability ? 'disabled' : ''}>Rent</button>
            `;
            carGrid.appendChild(carDiv);
        });
    } else {
        carGrid.innerHTML = '<p>No cars found.</p>';
    }
}

function addRecentSearch(keyword) {
    if (!recentSearches.includes(keyword)) {
        recentSearches.push(keyword);
        if (recentSearches.length > 5) {
            recentSearches.shift();
        }
    }
}

function showRecentSearches() {
    let recentSearchesDiv = document.getElementById('recent-searches');
    if (recentSearches.length > 0) {
        recentSearchesDiv.innerHTML = '';
        recentSearches.forEach(search => {
            let searchDiv = document.createElement('div');
            searchDiv.innerText = search;
            searchDiv.onclick = () => {
                document.getElementById('search-input').value = search;
                searchCars(search);
                recentSearchesDiv.style.display = 'none';
            };
            recentSearchesDiv.appendChild(searchDiv);
        });
        recentSearchesDiv.style.display = 'block';
    } else {
        recentSearchesDiv.innerHTML = '<div>No recent searches</div>';
        recentSearchesDiv.style.display = 'block';
    }
}

function hideRecentSearches() {
    setTimeout(() => {
        document.getElementById('recent-searches').style.display = 'none';
    }, 200);
}

function fetchCarsByCategory(category) {
    fetch(`api/search.php?category=${category}`)
        .then(response => response.json())
        .then(data => {
            console.log('Category results:', data); // Debugging statement
            displayCars(data);
        })
        .catch(error => console.error('Error:', error));
}

function rentCar(carId) {
    getCarById(carId).then(car => {
        let pricePerDay = car.price_per_day;
        let rentalForm = `
            <form action="api/reservation.php" method="post">
                <input type="hidden" name="carId" value="${carId}">
                <p>Car Model: ${car.brand} ${car.model}</p>
                <p>Price per Day: $${pricePerDay}</p>
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="mobile">Mobile:</label>
                <input type="text" name="mobile" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="license">Driver's License:</label>
                <input type="text" name="license" required>
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" required>
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" required>
                <input type="hidden" name="price" value="${pricePerDay}">
                <button type="submit">Reserve</button>
            </form>
        `;
        document.getElementById('reservation-form').innerHTML = rentalForm;
    }).catch(error => console.error('Error:', error));
}

function getCarById(carId) {
    return fetch('data/cars.json')
        .then(response => response.json())
        .then(cars => {
            return cars.find(car => car.id === carId);
        })
        .catch(error => console.error('Error:', error));
}

function toggleCategories() {
    let categoriesList = document.getElementById('categories-list');
    if (categoriesList.style.display === 'block') {
        categoriesList.style.display = 'none';
    } else {
        categoriesList.style.display = 'block';
    }
}

// Fetch initial data
document.addEventListener('DOMContentLoaded', function() {
    fetch('data/cars.json')
        .then(response => response.json())
        .then(data => {
            console.log('Initial car data:', data); // Debugging statement
            displayCars(data);
        })
        .catch(error => console.error('Error:', error));
});
