<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="/app/View/css/styles.css" rel="stylesheet" type="text/css"/>
    <title>Create</title>
</head>
<body>
<div class="container-middle">
    <h2>Edit <?php echo $category['category'] ?></h2>
    <form method="post" action="/update">

        <label for="category">Category name:</label><br>
        <input type="text" id="category" name="category" placeholder="<?php echo $category['category'] ?>"><br>

        <label for="title">Category title:</label><br>
        <input type="text" id="title" name="title" placeholder="<?php echo $category['title'] ?>"><br>

        <label for="description">Category description:</label><br>
        <input type="text" id="description" name="description" placeholder="<?php echo $category['description'] ?>"><br><br>

        <input type="hidden" value="<?php echo $category['id'] ?>" name="id" />

        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>
