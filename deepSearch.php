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

function searchBooks($books, $searchTerm) {
    $foundBooks = [];

    foreach ($books as $book) {
        $titleMatches = stripos($book['title'], $searchTerm) !== false;
        $authorMatches = stripos($book['author'], $searchTerm) !== false;
        $isbnMatches = stripos($book['isbn'], $searchTerm) !== false;

        if ($titleMatches || $authorMatches || $isbnMatches) {
            $foundBooks[] = $book;
        }
    }

    usort($foundBooks, function ($a, $b) use ($searchTerm) {
        $matchesA = countMatches($a, $searchTerm);
        $matchesB = countMatches($b, $searchTerm);
        return $matchesA - $matchesB;
    });

    return $foundBooks;
}

function countMatches($book, $searchTerm) {
    $matches = 0;

    $titleMatches = substr_count($book['title'], $searchTerm);
    $authorMatches = substr_count($book['author'], $searchTerm);
    $isbnMatches = substr_count($book['isbn'], $searchTerm);

    return $titleMatches + $authorMatches;
}

function highlightMatches($text, $searchTerm) {
    return str_ireplace($searchTerm, '<mark>' . $searchTerm . '</mark>', $text);
}

$searchTerm = $_POST['search'];

$foundBooks = searchBooks($books, $searchTerm);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
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
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        mark {
            background-color: yellow;
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
        <h1>Search Results for: <?= $searchTerm ?></h1>
        <?php
        if (!empty($foundBooks)) {
            echo "<p>Books found:</p>";
            foreach ($foundBooks as $book) {
                echo "<p>Title: " . highlightMatches($book['title'], $searchTerm) . "</p>";
                echo "<p>Author: " . highlightMatches($book['author'], $searchTerm) . "</p>";
                echo "<p>Available: " . ($book['available'] ? 'Yes' : 'No') . "</p>";
                echo "<p>Pages: " . $book['pages'] . "</p>";
                echo "<p>ISBN: " . $book['isbn'] . "</p>";
                echo "<br>";
            }
        } else {
            echo "<p>No books found for the search term '$searchTerm'.</p>";
        }
        ?>
        <button type="button" onclick="location.href='index.php'">Return Home</button>
    </div>
</body>
</html>
