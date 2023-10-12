<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .button-grid {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #007BFF;
            font-size: 32px;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="button-grid">
        <h1>Menu</h1>
        <button type="button" onclick="location.href='read.php'">READ</button>
        <button type="button" onclick="location.href='add.php'">SAVE</button>
        <button type="button" onclick="location.href='delete.php'">DELETE</button>
        <button type="button" onclick="location.href='search.php'">SEARCH</button>
    </div>
</body>
</html>
