<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            width: 100%;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 10px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: center;
        }
        th, td {
            padding: 5px 0;
        }
        th {
            text-align: left;
            background-color: #eeee ; /* Warna abu-abu untuk header */
        }
        .subtotal {
            text-align: right;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .image {
            height: 15rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Data Buku</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>Author</th>
                <th>Title</th>
                <th>Publisher</th>
                <th>Year Publish</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td><img class="image" src="C:\Users\HP\Documents\ukk\12108279-Adrian-Fathir-Paket-1\public\assets\img\bumi.jpg" alt=""></td>
                <td>{{ $book['author']}}</td>
                <td>{{ $book['title']}}</td>
                <td>{{ $book['publisher']}}</td>
                <td>{{ $book['year_publish']}}</td>
                <td>{{ $book['category']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- @foreach($books as $book)
    <table>
        <tr>
            <th>Cover</th>
            <td><img class="image" src="C:\Users\HP\Documents\ukk\12108279-Adrian-Fathir-Paket-1\public\assets\img\bumi.jpg" alt=""></td> 
        </tr>
        <tr>
            <th>Author</th>
            <td>{{ $book['author']}}</td> 
        </tr>
        <tr>
            <th>Title</th>
            <td>{{ $book['title']}}</td>
        </tr>
        <tr>
            <th>Publisher</th>
            <td>{{ $book['publisher']}}</td>
        </tr>
        <tr>
            <th>Year Publish</th>
            <td>{{ $book['year_publish']}}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $book['category']}}</td>
        </tr>
    </table>
    @endforeach -->
</div>
</div>
</body>
</html>