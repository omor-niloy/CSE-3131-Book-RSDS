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

function saveData($data, $filePath) {
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $jsonString);
}

$books = readData($filePath);
$isbnToDelete = $_POST['isbn'];

$found = false;
$deletedBook = null;

foreach ($books as $key => $book) {
    if ($book['isbn'] === $isbnToDelete) {
        $deletedBook = $book;
        unset($books[$key]);
        $found = true;
        break;
    }
}

if ($found) {
    $books = array_values($books); // Re-index the array
    saveData($books, $filePath);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Deletion</title>
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
            color: <?php echo $found ? 'green' : 'red'; ?>;
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
        <h1>Book Deletion</h1>
        <p><?php echo $found ? 'Book deleted successfully.' : 'Book not found.'; ?></p>
        <?php if ($found): ?>
        <p><strong>Deleted Book Details:</strong></p>
        <p><strong>Title:</strong> <?php echo $deletedBook['title']; ?></p>
        <p><strong>Author:</strong> <?php echo $deletedBook['author']; ?></p>
        <p><strong>Available:</strong> <?php echo $deletedBook['available'] ? 'Yes' : 'No'; ?></p>
        <p><strong>Pages:</strong> <?php echo $deletedBook['pages']; ?></p>
        <p><strong>ISBN:</strong> <?php echo $deletedBook['isbn']; ?></p>
        <?php endif; ?>
        <button type="button" onclick="location.href='index.php'">Return Home</button>
    </div>
</body>
</html>
