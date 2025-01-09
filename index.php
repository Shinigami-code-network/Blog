<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .card {
            margin-top: 50px;
        }
        .container {
            margin-top: 50px;
        }
        .card-title {
            font-size: 2rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">My Demo Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.html">Create Post</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Blog Post Section -->
    <div class="container">
        
        <?php
        // Database connection
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "blogdb";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch posts
        $sql = "SELECT title, content, image FROM blog_posts ORDER BY id DESC"; // Adjust table name as necessary
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-12">
                        <div class="card">
                            <img src="uploads/' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                                <p class="card-text">' . htmlspecialchars($row['content']) . '</p>
                            </div>
                        </div>
                      </div>';
            }
        } else {
            echo '<p>No blog posts found.</p>';
        }

        // Close the connection
        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
