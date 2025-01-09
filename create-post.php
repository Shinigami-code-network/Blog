<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "blogdb"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image = $_FILES['image'];
    $targetDir = "uploads/"; 
    $targetFile = $targetDir . basename($image["name"]);
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($image["tmp_name"], $targetFile)) {
        // Inserting into database
        $sql = "INSERT INTO blog_posts (title, content, image) VALUES ('$title', '$content', '" . $image['name'] . "')";
        if ($conn->query($sql) === TRUE) {
            echo "New blog post created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No image uploaded or there was an upload error.";
}

    }



$conn->close();
?>
