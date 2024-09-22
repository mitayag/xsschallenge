<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOM XSS Challenge</title>
</head>
<body>
    <h2>Search for Something:</h2>
    <input type="text" id="search" placeholder="Search...">
    <button onclick="search()">Search</button>

    <h2>Search Results:</h2>
    <div id="result"></div>

    <script>
        function search() {
            var query = document.getElementById('search').value;
            document.getElementById('result').innerHTML = "You searched for: " + query;

            // Hidden flag revealed if a script tag is detected in the query
            if (query.includes('<script>')) {
                document.getElementById('result').innerHTML += "<div style='display:none;'>FLAG{Th1nk_0uts1d3_th3_B0x}</div>";
            }
        }

        // Parse query parameters and perform search
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('q')) {
            var query = urlParams.get('q');
            document.getElementById('search').value = query;
            search();
        }
    </script>
</body>
</html>
