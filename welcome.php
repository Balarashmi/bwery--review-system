<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Brewery Search</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-offset-2">
                <h2>Brewery Search</h2>
                <form id="searchForm">
                    <div class="form-group">
                        <label>Search Term</label>
                        <input type="text" id="searchTerm" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Search By</label>
                        <select id="searchBy" class="form-control" required>
                            <option value="by_city">City</option>
                            <option value="by_name">Name</option>
                            <option value="by_type">Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Brewery Type</label>
                        <select id="breweryType" class="form-control">
                            <option value="micro">Micro</option>
                            <option value="nano">Nano</option>
                            <option value="regional">Regional</option>
                            <!-- Add other valid Brewery Type options as needed -->
                        </select>
                    </div>
                    <input type="button" class="btn btn-primary" onclick="searchBreweries()" value="Search">
                </form>
                <br>
                <a href="welcome.php" class="btn btn-default">Back to Home</a>
                <div id="resultContainer"></div>
            </div>
        </div>    
    </div>

    <script>
        function searchBreweries() {
            const searchTerm = document.getElementById('searchTerm').value;
            const searchBy = document.getElementById('searchBy').value;
            const breweryType = document.getElementById('breweryType').value;

            let api_url = `https://api.openbrewerydb.org/breweries?${searchBy}=${searchTerm}`;

            if (breweryType) {
                api_url += `&by_type=${breweryType}`;
            }

            fetch(api_url)
                .then(response => response.json())
                .then(data => {
                    displayBreweryData(data);
                })
                .catch(error => {
                    console.error('Error fetching data from the API:', error);
                });
        }

        function displayBreweryData(data) {
            const resultContainer = document.getElementById('resultContainer');
            resultContainer.innerHTML = ""; // Clear previous results

            if (data.length > 0) {
                data.forEach(brewery => {
                    resultContainer.innerHTML += `
                        <h3>${brewery.name}</h3>
                        <p><b>Address:</b> ${brewery.street}</p>
                        <p><b>Phone:</b> ${brewery.phone}</p>
                        <p><b>Website:</b> ${brewery.website_url}</p>
                        <p><b>State, City:</b> ${brewery.state}, ${brewery.city}</p>
                        <hr>
                    `;
                });
            } else {
                resultContainer.innerHTML = "<p>No results found.</p>";
            }
        }
    </script>
</body>
</html>
