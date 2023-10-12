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

$author = $_POST['author'];
$title = $_POST['title'];
$available = $_POST['available'];
$pages = $_POST['pages'];
$isbn = $_POST['isbn'];

$newBook = [
    'author' => $author,
    'title' => $title,
    'available' => $available,
    'pages' => $pages,
    'isbn' => $isbn
];

function saveData($data, $filePath) {
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $jsonString);
}

$books[] = $newBook;
saveData($books, $filePath);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Added</title>
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
            text-align: left;
            margin-bottom: 10px;
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
        <h1>Book Added Successfully!</h1>
        <p><strong>Added Book Details:</strong></p>
        <p><strong>Title:</strong> <?php echo $newBook['title']; ?></p>
        <p><strong>Author:</strong> <?php echo $newBook['author']; ?></p>
        <p><strong>Available:</strong> <?php echo $newBook['available'] ? 'Yes' : 'No'; ?></p>
        <p><strong>Pages:</strong> <?php echo $newBook['pages']; ?></p>
        <p><strong>ISBN:</strong> <?php echo $newBook['isbn']; ?></p>
        <button type="button" onclick="location.href='index.php'">Return Home</button>
    </div>
</body>
</html>
