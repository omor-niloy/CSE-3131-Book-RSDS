<!DOCTYPE html>
<html>
<head>
    <title>Books Table</title>
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

        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        caption {
            text-align: center;
            font-size: 24px;
            color: #007BFF;
            padding: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e5e5e5;
        }
    </style>
</head>
<body>
    <?php
    // Given array
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
    ?>

    <table>
        <caption>Books Table</caption>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Available</th>
                <th>Pages</th>
                <th>ISBN</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['available'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $book['pages']; ?></td>
                    <td><?php echo $book['isbn']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
