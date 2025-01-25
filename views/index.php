<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <h1>Home Page</h1>
        <h2>Upload transactions, supported csv format: date, check #, description, amount</h2>
        <form action="/transactions/upload" method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple>
            <button>Upload</button>
        </form>
        <hr>
        <h3><a href="/transactions/">See all uploaded transactions</a></h3>
    </body>
</html>
