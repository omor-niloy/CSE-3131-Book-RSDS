<?php
$filePath = 'Omor Niloy - books.json';

function readData($filePath) {
    if (file_exists($filePath)) {
        $jsonString = file_get_contents($filePath);
        return json_decode($jsonString, true);
    } else {
        return [];
    }
}

$books = readData($filePath);

function searchBookByISBN($books, $isbn) {
    foreach ($books as $book) {
        if ($book['isbn'] == $isbn) {
            return $book;
        }
    }
    return null; // Return null if book is not found
}

$isbnToSearch = $_POST['isbn'];
$foundBook = searchBookByISBN($books, $isbnToSearch);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            width: 80%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book Search</h1>
        <?php
        if ($foundBook) {
            echo "<p>Book found:</p>";
            echo "<p>Title: " . $foundBook['title'] . "</p>";
            echo "<p>Author: " . $foundBook['author'] . "</p>";
            echo "<p>Available: " . ($foundBook['available'] ? 'Yes' : 'No') . "</p>";
            echo "<p>Pages: " . $foundBook['pages'] . "</p>";
            echo "<p>ISBN: " . $foundBook['isbn'] . "</p>";
        } else {
            echo "<p>Book with ISBN $isbnToSearch not found.</p>";
        }
        ?>
        <button type="button" onclick="location.href='index.php'">Return Home</button>
    </div>
</body>
</html>
