<!DOCTYPE html>
<html>
<head>
    <title>Landmarks</title>
</head>
<body>

<table id="landmarksTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Owner</th>
            <th>Type</th>
            <th>Landmark Name</th>
            <th>Description</th>
            <th>City</th>
            <th>Area ID</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Have Booking</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
    // Make a GET request to the API endpoint
    fetch('../api/fetch_all_hotel_info.php')
        .then(response => response.json())
        .then(data => {
            // Access the landmarks array
            const landmarks = data;

            // Get the table body element
            const tableBody = document.querySelector('#landmarksTable tbody');

            // Loop through each landmark
            landmarks.forEach(landmark => {
                // Create a new row element
                const row = document.createElement('tr');

                // Loop through each property in the landmark object
                for (const key in landmark) {
                    if (landmark.hasOwnProperty(key)) {
                        // Create a new cell element
                        const cell = document.createElement('td');
                        cell.textContent = landmark[key];
                        row.appendChild(cell);
                    }
                }

                // Append the row to the table body
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>

</body>
</html>
