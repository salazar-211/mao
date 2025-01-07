<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS MAP</title>
    <link rel="icon" type="image/png" href="../img/Mabini-Logo.ico" />



    <style>
        #header {
    background-color: #007bff; /* Blue background */
  
}

        /* Right Container Header */
#right-container-header {
    background-color: #007bff; /* Blue background */
    color: white; /* White text color */
    padding: 5px;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px; /* Space between icon and text */
    font-weight: bold;
    
}

#right-container-header i {
    font-size: 20px; /* Icon size */
}
#right-container {
    position: fixed;
    bottom: 20px; /* Position at the bottom */
    right: 25px; /* Adjust the right margin */
    width: 350px;
    height: 65%; /* Adjust the height */
    background-color: white;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    transform: translateX(100%); /* Start off-screen */
    opacity: 0; /* Initially hidden (transparent) */
    transition: transform 0.40s ease, opacity 0.3s ease; /* Smooth transition for transform and opacity */
    z-index: 1050; /* Higher z-index to make sure it's above the map */
    display: block; /* Always available for transitions */
}

/* Show the container when the 'visible' class is added */
#right-container.visible {
    transform: translateX(0); /* Move it into view from the right */
    opacity: 1; /* Fade in to full opacity */
}

/* Optionally: Add a hidden class to hide it completely */
#right-container.hidden {
    opacity: 0; /* Fade out to transparent */
    transform: translateX(100%); /* Move it off-screen */
}
      #map-container {
            position: relative;
            width: 100%;
            height: 550px;
            margin-top: 10px; 
        }

        #map {
            width: 100%;
            height: 100%;
            
            
        }
        .leaflet-tile {
            filter: invert(30%) sepia(100%) saturate(300%) hue-rotate(180deg);
        }

        /* Widget Container (Buttons inside the map) */
        #widget-container {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            display: flex;
            gap: 10px;
        }

        .map-button {
            padding: 8px;
            background-color: rgba(0, 123, 255, 0.7);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            opacity: 0.8;
        }

        .map-button:hover {
            opacity: 1;
            background-color: rgba(0, 123, 255, 1);
        }

       /* Initially hide the right container */


        #search-bar {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        #data-container {
            display: none;
        }

        #location-info {
            margin-top: 20px;
        }

        canvas {
            max-width: 100%;
            height: 300px;
        }
    #info-container {
    width: 1157%; /* Adjusts to parent container */
    max-width: 1157px; /* Maximum width */
    height: auto;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
    background-color: #fff;
    border: 2px solid black;
    padding: 20px;
    margin-top: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

canvas {
    width: 1120% !important; /* Ensures the chart takes full width of the parent container */
    max-width: 1120px; /* Increased max width */
    height: 400px !important; /* Explicitly set a height for better visibility */
}
    #info-container h4 {
        color: #000000FF;
        font-size: 20px;
        margin-bottom: 15px;
    }


    /* Container for map and info */
    #container {
        display: flex;
        flex-direction: row; /* Align horizontally */
        gap: 20px; /* Space between map and info */
        margin: 20px;
    }

    #search-bar {
        width: 100%;
        padding: 12px 20px;
        margin: 15px 0;
        box-sizing: border-box;
        position: relative;
        bottom: 0;
        top: 100px; /* Offset slightly downward */
        border: 2px solid #000; /* Black border */
        border-radius: 8px; /* Rounded corners */
        background-color: #FFFFFFFF; /* Soft background color */
        font-size: 16px;
        color: #333; /* Text color */
        transition: all 0.30s ease; /* Smooth transition for focus and hover effects */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    }

    /* Add a focus state with a highlight */
    #search-bar:focus {
        border-color: #FFFFFFFF; 
        background-color: #fff; /* Slightly change the background on focus */
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15); /* Stronger shadow when focused */
        outline: none; /* Remove the default focus outline */
    }

    /* Add hover effect */
    #search-bar:hover {
        border-color: #000; /* Slightly darker border on hover */
    }

    /* Optional: Add a placeholder color for modern look */
    #search-bar::placeholder {
        color: #aaa; /* Light gray placeholder */
        font-style: italic; /* Italicized placeholder for modern feel */
    }
    .chart-title {
        font-size: 18px;
        font-weight: bold;
        color: #000;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .chart-title i {
        margin-right: 8px;
        color: #007bff;
    }

    .title-text {
        font-family: 'Arial', sans-serif;
        letter-spacing: 0.5px;
    }
    .leaflet-control-attribution {
    display: none !important;
}
#chartContainer {
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-height: 400px;
    overflow-y: auto; /* Add scrolling if content exceeds max height */
    padding: 10px;
    box-sizing: border-box;
}

canvas {
    max-width: 100%;
    height: auto;
}
#widget-header {
    position: absolute;
    top: 80px;
    left: 8px; /* Positioned on the top-right */
    background-color: rgba(75, 71, 71, 0); /* Transparent */
    color: white;
    padding: 6px;
    z-index: 1000;
    display: flex;
    flex-direction: column; /* Stack buttons vertically */
    align-items: center;
    gap: 3px; /* Space between buttons */
    border-radius: 0; /* Removed rounded corners for a more modern look */
}

.widget-button {
    background-color: #FFFFFFFF; /* Blue button background */
    color: white;
    padding: 7px 6px; /* Adjust padding for normal button size */
    border: none;
    cursor: pointer;
    font-size: 16px; /* Adjust font size for normal readability */
    transition: background-color 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 5px; /* Slightly rounded corners for buttons */
}

.widget-button i {
    font-size: 17px; /* Modern, larger icon size */
    color: black;
    transition: color 0.3s ease; /* Smooth transition for color change */
    transform: scale(1); /* Keeps icon size consistent */
}

.widget-button:hover {
    background-color: #007bff; /* Darker blue on hover */
}

.widget-button:hover i {
    color: white; /* Solid white icon on hover */
    transform: scale(1.1); /* Slightly scale up icon on hover for effect */
}


/* Search Bar Container */
.search-bar-container {
    padding: 20px;
    background-color: #f9f9f9;
    display: flex;
    align-items: center; /* Align input and icon */
}

#search-bar {
    width: 100%;
    top: 0px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 0; /* No rounded corners */
    margin-right: 10px; /* Space for the icon */
}

#search-icon {
    font-size: 20px; /* Adjust icon size */
    cursor: pointer;
    color: #007bff; /* Blue icon color */
}

/* Optional: Add hover effect on the icon */
#search-icon:hover {
    color: #0056b3; /* Darker blue when hovered */
}
/* Remove rounded corners for popups */
.leaflet-popup-content-wrapper {
    border-radius: 0 !important; /* Remove rounded corners */
}

/* Optional: Adjust padding and other styles for better control */
.leaflet-popup-content {
    padding: 0 !important;
}


#loading-indicator i {
    color: #007bff; /* Change color for better visibility */
    animation: spin 1.5s linear infinite; /* Spinner animation */
}



/* Spinner animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Fade-in animation */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}
.loading-spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loading-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }




</style>

</head>
<body>

    <div id="header">
        <h1><a href="dashboard.html"></a></h1>
    </div>
    <?php include 'includes/topheader.php'?>
    <?php $page = 'location-map'; include 'includes/sidebar.php'; ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="location_map.php" class="current">Location Map</a>
            </div>
        </div>
        
<!-- Right Container -->
<div id="right-container" class="hidden">
    <!-- Header Section -->
    <div id="right-container-header">
        <i class="fas fa-search"></i>
        <span>Search Panel</span>
    </div>
    
    <!-- Search Bar Section -->
    <div class="search-bar-container">
        <input type="text" id="search-bar" placeholder="Search..." />
        <button id="submit-search" style="background-color: #007bff; color: white; border: none; padding: 3px 10px; border-radius: 4px;">Go</button>
    </div>

     <!-- Autocomplete Suggestions Container -->
     <div id="autocomplete-suggestions" style="display: none; background-color: white; position: absolute; width: 100%; border: 1px solid #ccc; z-index: 1000; 
     box-shadow: 0px 5px 10px rgba(0,0,0,0.1); max-height: 200px; overflow-y: auto;"></div>

    
    <!-- Informational Message -->
    <div class="info-message" style="font-size: 9.2px; color: #666; margin-top: -32px; text-align: center;">
        <p>You can search for locations in nearby areas (e.g., Anilao, Mabini, Batangas).</p>
    </div>

   <!-- Loading Indicator -->
 <div id="loading-indicator" style="display: none; text-align: center; margin-top: 100px; margin-left: 152px; font-size: 10px;">
    <div class="loading-container">
        <i class="fas fa-spinner fa-spin" style="font-size: 40px;"></i>
        <p>Loading...</p>
    </div>
</div>
</div>

        <div id="container">
            <!-- Map Container -->
            <div id="map-container">
                <!-- Custom Widget Header for Buttons -->
                <div id="widget-header" class="jimu-widget">
                    <!-- Search Button (Icon) -->
                    <button id="search-icon" class="widget-button" title="Search">
                        <i class="fas fa-search"></i>
                    </button>
                     <!-- Map Style Toggle Button -->
            <button id="style-toggle-btn" class="widget-button" title="Toggle Map Style">
                <i class="fas fa-globe"></i>
            </button>
                </div>
                <!-- Map -->
                <div id="map"></div>
            </div>
        </div>
    </div>
    <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet Search (version 2.4.0) CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/4.0.0/leaflet-search.min.css" />


<!-- FontAwesome for icons (optional) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet Search JS (version 2.4.0) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/4.0.0/leaflet-search.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@maptiler/leaflet-maptilersdk@1.0.0/leaflet-maptilersdk.js"></script>
   <script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.5.1/maptiler-sdk.umd.js"></script>
    <link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.5.1/maptiler-sdk.css" rel="stylesheet" />
    <script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Initialize the map centered at Mabini, Batangas
    const map = L.map('map').setView([13.9000, 121.0545], 10.4);

    // Define the map layers to be used
    const openStreetMapLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18 });
    const earthLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://carto.com/attributions">CartoDB</a>',
        maxZoom: 18
    });

    // Initialize the MapTiler layer correctly using the API
    const maptilerLayer = L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=wIh2J8EQcPEBIBvvaqZH', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    // Add MapTiler to map initially
    maptilerLayer.addTo(map);

    // Fallback to OpenStreetMap if MapTiler layer fails
    maptilerLayer.on('tileloaderror', function() {
        console.log('MapTiler tiles failed to load, switching to OpenStreetMap.');
        map.removeLayer(maptilerLayer); // Remove MapTiler layer
        openStreetMapLayer.addTo(map);  // Add OpenStreetMap layer
    });

    // Add the scale control to the map
    L.control.scale().addTo(map);

    // Handle the style toggle button click
    const styleToggleBtn = document.getElementById('style-toggle-btn');
    let currentLayer = maptilerLayer; // Initially set to MapTiler Layer

    styleToggleBtn.addEventListener('click', () => {
        // Remove the current layer and switch to the next one
        if (currentLayer === maptilerLayer) {
            map.removeLayer(currentLayer);
            currentLayer = openStreetMapLayer; // Switch to OpenStreetMap
        } else if (currentLayer === openStreetMapLayer) {
            map.removeLayer(currentLayer);
            currentLayer = earthLayer; // Switch to Earth view
        } else {
            map.removeLayer(currentLayer);
            currentLayer = maptilerLayer; // Switch back to MapTiler
        }

        // Add the new layer
        currentLayer.addTo(map);
    });

    // Display latitude and longitude on mouse movement
    const latLngDisplay = L.control({ position: 'bottomleft' });

    latLngDisplay.onAdd = function () {
        const div = L.DomUtil.create('div', 'latlng-display');
        
        // Remove background styles for transparent look
        div.style.fontSize = '12px';
        div.style.fontFamily = 'Arial, sans-serif';
        div.style.color = '#000'; // Solid white text color
        div.style.fontWeight = 'bold'; // Make the text more solid
        div.innerHTML = 'Move the cursor over the map';
        return div;
    };

    latLngDisplay.addTo(map);

    map.on('mousemove', function (event) {
        const { lat, lng } = event.latlng;
        const formattedLat = lat.toFixed(5);
        const formattedLng = lng.toFixed(5);
        latLngDisplay.getContainer().innerHTML = `Latitude: ${formattedLat}, Longitude: ${formattedLng}`;
    });

    // Search functionality and event handling
    const searchButton = document.getElementById('search-icon');
    const searchInput = document.getElementById('search-bar');
    const submitSearch = document.getElementById('submit-search');
    const autocompleteSuggestions = document.getElementById('autocomplete-suggestions');
    const rightContainer = document.getElementById('right-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const markers = L.layerGroup().addTo(map);

    submitSearch.addEventListener('click', () => {
        const query = searchInput.value.trim();
        handleSearch(query);
    });

    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            const query = searchInput.value.trim();
            handleSearch(query);
        }
    });

 // Add click event listener to the button
searchButton.addEventListener('click', function() {
    // Toggle the visibility of the right container
    if (rightContainer.classList.contains('visible')) {
        rightContainer.classList.remove('visible');
        rightContainer.classList.add('hidden');  // Optional if you want to remove it completely
    } else {
        rightContainer.classList.add('visible');
        rightContainer.classList.remove('hidden');  // Optional if you want to remove it completely
    }
    });

    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    const handleSearch = debounce((query) => {
    if (!query) {
        // Don't clear markers when search is empty, just clear info panel
        return;
    }

// Show loading indicator
loadingIndicator.style.display = 'inline-block';
        
        const normalizedQuery = query.trim()
            .replace(/\s+/g, ' ')
            .replace(/,\s+/g, ', ')
            .replace(/\s+,/g, ', ');

             // Simulating an API call or search operation (you can replace with actual logic)
    setTimeout(() => {
        // Hide loading indicator after search is complete
        loadingIndicator.style.display = 'none';

        // You can place any other logic here, if needed
        console.log(`Search completed for: ${query}`);
    }, 2000); // Simulated delay for demonstration (replace with actual search logic)

        fetch(`search_members.php?address=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Debugging log
                if (data.members && data.members.length > 0) {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(normalizedQuery)}`)
                        .then(geoResponse => geoResponse.json())
                        .then(geoData => {
                            if (geoData.length > 0) {
                                const latitude = geoData[0].lat;
                                const longitude = geoData[0].lon;

                                console.log(`Flying to: ${latitude}, ${longitude}`);

                                 // Use flyTo for a smooth animation
                map.flyTo([latitude, longitude], 14, {
                    animate: true,
                    duration: 3 // Animation duration in seconds
                });

                                markers.clearLayers(); // Clear old markers
                                map.setView([latitude, longitude], 12); // Zoom closer

                                // Show autocomplete suggestions
    searchInput.addEventListener('input', debounce((event) => {
        const query = event.target.value.trim();
        if (query.length < 6) {
            autocompleteSuggestions.style.display = 'none';
            return;
        }

        // Fetch autocomplete suggestions based on the input
        fetch(`search_suggestions.php?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(suggestions => {
                if (suggestions.length > 0) {
                    autocompleteSuggestions.innerHTML = suggestions.map(item => 
                        `<div class="suggestion-item" style="padding: 8px; cursor: pointer; border-bottom: 1px solid #ddd;">${item}</div>`
                    ).join('');
                    autocompleteSuggestions.style.display = 'block';
                } else {
                    autocompleteSuggestions.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
            });
    }, 500));

    // Select suggestion and populate input field
    autocompleteSuggestions.addEventListener('click', function(event) {
        const selectedSuggestion = event.target.textContent;
        searchInput.value = selectedSuggestion;
        autocompleteSuggestions.style.display = 'none'; // Hide suggestions after selection
        handleSearch(selectedSuggestion); // Trigger search with selected suggestion
    });

// Prepare data for gear frequency chart
// Custom Leaflet marker icon with adjusted popupAnchor
var greenIcon = L.icon({
    iconUrl: '../img/marker-map.png', // Default icon
    iconSize: [53, 52],
    iconAnchor: [12, 41],
    popupAnchor: [15, 0], // Shift the popup to the right (x=15) and keep it vertically centered (y=0)

    shadowSize: [41, 41]
});


// Gender and Age distribution
const genderFrequency = { male: 0, female: 0 };

// Aggregate Gender and Age data
data.members.forEach(member => {
    // Gender aggregation
    const gender = member.gender?.toLowerCase();
    
    // Only count Male and Female, ignore "Other" or any other values
    if (gender === 'male' || gender === 'female') {
        genderFrequency[gender]++;
    }
});

// Function to calculate the average age
function calculateAverageAge(members) {
    const totalAge = members.reduce((sum, member) => sum + (parseInt(member.age, 10) || 0), 0);
    return (totalAge / members.length).toFixed(2); // Average age rounded to 2 decimal places
}

const averageAge = calculateAverageAge(data.members);

// Helper function to update frequencies
const updateFrequency = (category, count, frequencyObject) => {
    frequencyObject[category] += parseInt(count) || 0;
};

// Initialize frequency objects for fishing gear and vessels
const subcategoryFrequency = {
    simple_hand_line: 0, multiple_hand_line: 0, bottom_set_long_line: 0, drift_long_line: 0, troll_line: 0,
    jig: 0, fish_pots: 0, crab_pots: 0, squid_pots: 0, fish_corrals: 0, set_net: 0, barrier_net: 0,
    man_push_nets: 0, scoop_nets: 0, surface_set_gill_net: 0, drift_gill_net: 0, bottom_set_gill_net: 0,
    trammel_net: 0, encircling_gill_net: 0, crab_lift_nets: 0, fish_lift_nets: 0, new_look_zapra: 0,
    shrimp_lift_nets: 0, lever_net: 0, beach_seine: 0, fry_dozer: 0, spear: 0, squid_luring_devices: 0,
    gaff_hook: 0, cast_net: 0
};

const vesselFrequency = {
    reg_length: {}, reg_breadth: {}, reg_depth: {}, tonnage_length: {}, tonnage_breadth: {},
    tonnage_depth: {}, gross_tonnage: {}, net_tonnage: {}
};

// Process data for fishing gear and vessel attributes
data.members.forEach(member => {
    // Update fishing gear frequencies
    Object.keys(subcategoryFrequency).forEach(gear => {
        updateFrequency(gear, member[`${gear}_count`], subcategoryFrequency);
    });

    // Update vessel frequencies
    ['reg_length', 'reg_breadth', 'reg_depth', 'tonnage_length', 'tonnage_breadth', 'tonnage_depth', 'gross_tonnage', 'net_tonnage']
        .forEach(field => {
            const value = member[field];
            if (value) {
                vesselFrequency[field][value] = (vesselFrequency[field][value] || 0) + 1;
            }
        });
});

// Function to generate chart data
function generateChartData(frequencyData) {
    return {
        labels: Object.keys(frequencyData),
        datasets: [{
            label: 'Count',
            data: Object.values(frequencyData),
            backgroundColor: 'rgba(33, 150, 243, 0.8)', // Blue with slight transparency
            borderColor: 'rgba(33, 150, 243, 1)',
            borderWidth: 1,
            hoverBackgroundColor: 'rgba(33, 150, 243, 1)',
            borderRadius: 6
        }]
    };
}

// Function to render charts
function renderChart(containerId, chartData, title) {
    const ctx = document.getElementById(containerId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: { size: 16, weight: 'bold', family: 'Segoe UI' },
                    color: '#212121'
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: (tooltipItem) => `Count: ${tooltipItem.raw}`,
                    },
                    backgroundColor: '#ffffff',
                    titleColor: '#1976D2',
                    bodyColor: '#333',
                    borderColor: '#1976D2',
                    borderWidth: 1,
                    padding: 10
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Category',
                        font: { size: 14, weight: '600' },
                        color: '#757575'
                    },
                    ticks: { color: '#555' }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Count',
                        font: { size: 14, weight: '600' },
                        color: '#757575'
                    },
                    ticks: { color: '#555' },
                    beginAtZero: true
                }
            }
        }
    });
}

// Function to generate the popup content based on selected filter
function generatePopupContent(filterType) {
    let content = `
        <div style="
            font-family: 'Segoe UI', sans-serif; 
            padding: 15px; 
            background-color: #F9F9F9; 
            border-radius: 12px; 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
            <h4 style="
                margin: 0 0 10px; 
                font-size: 18px; 
                color: #333;">${query} - Total Fisherfolks: ${data.members.length}</h4>
            <div style="
                display: flex; 
                justify-content: space-between; 
                margin-bottom: 15px; 
                font-size: 14px;">
                <span style="color: #2196F3; font-weight: 600;">Male: ${genderFrequency.male}</span>
                <span style="color: #F06292; font-weight: 600;">Female: ${genderFrequency.female}</span>
            </div>
            <div style="overflow-y: auto; max-height: 400px; margin-bottom: 15px;">`; // Increased max height

    if (filterType === 'fishingGear') {
        content += `<canvas id="fishingGearChart" style="height: 300px; width: 100%;"></canvas>`;
    } else if (filterType === 'vesselSize') {
        content += Object.keys(vesselFrequency).map(field => `
            <div style="margin-bottom: 20px;">
                <h5 style="margin: 0 0 10px; font-size: 16px; color: #555;">${field.replace(/_/g, ' ').toUpperCase()}</h5>
                <canvas id="${field}Chart" style="height: 300px; width: 100%;"></canvas>
            </div>
        `).join('');
    }

    content += `</div>
            <button onclick="handleBackClick()" style="
                width: 100%; 
                padding: 12px 18px; 
                background-color: #1976D2; 
                color: #FFFFFF; 
                border: none; 
                border-radius: 8px; 
                font-size: 14px; 
                font-weight: 600; 
                cursor: pointer; 
                transition: background-color 0.3s ease;">
                Back
            </button>
        </div>`;
    return content;
}


// Function to handle filter click
window.handleFilterClick = function (filterType) {
    const popupContent = generatePopupContent(filterType);

    currentMarker.bindPopup(popupContent, {
        offset: L.point(-11, -21)
    }).openPopup();

    setTimeout(() => {
        if (filterType === 'fishingGear') {
            const chartData = generateChartData(subcategoryFrequency);
            renderChart('fishingGearChart', chartData, 'Fishing Gear Usage');
        } else if (filterType === 'vesselSize') {
            Object.keys(vesselFrequency).forEach(field => {
                const chartData = generateChartData(vesselFrequency[field]);
                renderChart(`${field}Chart`, chartData, field.replace(/_/g, ' ').toUpperCase());
            });
        }
    }, 100);
};

// Function to handle back click
window.handleBackClick = function () {
    currentMarker.bindPopup(customPopup, {
        offset: L.point(0, -40)
    }).openPopup();
};


const customPopup = `
    <!-- Header Section -->
    <div style="background-color: #5C6BC0; padding: 12px 16px; text-align: center; border-radius: 0px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h4 style="color: #fff; font-size: 20px; margin: 0; font-family: 'Arial', sans-serif; font-weight: 600;">
            ${query} - Total Fisherfolks: <span style="font-weight: 400;">${data.members.length}</span>
        </h4>
    </div>

    <!-- Content Section -->
    <div style="padding: 15px; background-color: #f9f9f9;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
            <!-- Male Data -->
            <div style="display: flex; align-items: center; gap: 4px;">
                <img src="../img/male-icon.png" alt="Male Icon" style="width: 20px; height: 20px;">
                <span style="color: #2196f3; font-size: 14px; font-weight: bold;">Male: ${genderFrequency.male}</span>
            </div>
            <!-- Female Data -->
            <div style="display: flex; align-items: center; gap: 4px;">
                <img src="../img/female-icon.png" alt="Female Icon" style="width: 14px; height: 18px;">
                <span style="color: #f06292; font-size: 14px; font-weight: bold;">Female: ${genderFrequency.female}</span>
            </div>
        </div>

        <!-- Average Age -->
        <div style="display: flex; align-items: center; gap: 2px; margin-top: -8px; margin-bottom: 10px;">
            <span style="font-size: 14px;"><strong>Average Age:</strong> ${averageAge}</span>
        </div>

        <!-- Filter Buttons -->
        <div style="display: flex; justify-content: center; gap: 15px;">
            <div onclick="handleFilterClick('fishingGear')" 
                 style="cursor: pointer; display: flex; align-items: center; gap: 8px; padding: 10px 15px; 
                        background-color: #94CEF8FF; border-radius: 5px; font-size: 14px; font-weight: bold; 
                        transition: background-color 0.3s; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <img src="../img/gear-icon.png" alt="Fishing Gear Icon" style="width: 20px; height: 20px;">
                <span>Fishing Gear</span>
            </div>
            <div onclick="handleFilterClick('vesselSize')" 
                 style="cursor: pointer; display: flex; align-items: center; gap: 8px; padding: 10px 15px; 
                        background-color: #94CEF8FF; border-radius: 5px; font-size: 14px; font-weight: bold; 
                        transition: background-color 0.3s; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <img src="../img/vessel-icon.png" alt="Vessel Size Icon" style="width: 28px; height: 28px;">
                <span>Vessel Size</span>
            </div>
        </div>
    </div>

    <!-- Additional Information Section -->
    <div style="text-align: center; margin-top: -20px; font-size: 8px; color: #363839FF;">
        <p style="font-size: 10px; color: #363839FF;">Click the buttons above to see more information about:</p>
    </div>
`;




// Add marker to map with a custom popup
const currentMarker = L.marker([latitude, longitude], { icon: greenIcon })
    .addTo(markers)
    .bindPopup(customPopup, {
        offset: L.point(-11, -21)
    })
    .openPopup();
                            }
                        });
                }
            })
            .catch(err => console.error("Error fetching member data:", err));
    });

    searchInput.addEventListener('input', debounce(function(event) {
    // Automatically format the search query
    let input = event.target.value;

    // Normalize spaces and enforce a single space after commas
    input = input
        .replace(/,+/g, ',') // Remove extra commas
        .replace(/,\s+/g, ', ') // Ensure single space after commas
        .replace(/\s*,/g, ', ') // Remove space before commas and add single space after
        .replace(/\s+/g, ' '); // Replace multiple spaces with a single space

    searchInput.value = input.trim(); // Update the input field with the formatted text

    handleSearch(input.trim()); // Perform the search with formatted input
    }, 500));
});
</script>


     <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.flot.min.js"></script>
    <script src="../js/jquery.flot.resize.min.js"></script>
    <script src="../js/jquery.gritter.min.js"></script>
    <script src="../js/matrix.js"></script>

  
    <script src="../js/jquery.dataTables.min.js"></script>
</body>
</html>
