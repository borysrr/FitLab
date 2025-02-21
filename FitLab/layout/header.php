<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLab.com</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: dodgerblue;
border-color: darkblue; border-width: 4px; border-style: solid;">

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            </button>
            <a class="navbar-brand" href="/index.php" style="color: black">FitLab</a>
        </div>

        <ul class="nav navbar-nav" style="display: flex; justify-content: center; width: 60%;">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/products.php">Supplements</a></li>
            <li><a href="/clothing.php">Clothing</a></li>
            <li><a href="/contact.php">Contact</a></li>
        </ul>

        <!-- Search Form -->
        <form class="navbar-form navbar-right" action="search.php" method="GET">
            <div class="form-group">
                <input type="text" name="query" class="form-control" placeholder="Search Item">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
        </form>

    </div>
</nav>

</body>
</html>
