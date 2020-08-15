<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="/app/View/css/styles.css" rel="stylesheet" type="text/css"/>
    <title>Homepage</title>
</head>
<body>
<div class="description-container">
    <h4> <?php echo $category['title'] ?></h4>
    <h5> <?php echo $category['description'] ?></h5>
</div>

<div class="main-container">
    <div class="category-container"> <?php echo $categoryTree ?></div>
    <div class="menu-container">

        <form method="get" action="<?php echo $category['category'] ?>/create">
            <input type="hidden" name="parent_id"  value="<?php echo $category['parent_id'] ?>">
            <button type="submit">Create new category</button>
        </form>

        <form method="get" action="<?php echo $category['category'] ?>/createSubcategory">
            <input type="hidden" name="id"  value="<?php echo $category['id'] ?>">
            <button type="submit">Create new sub-category</button>
        </form>

        <form method="get" action="<?php echo $category['category'] ?>/edit">
            <input type="hidden" name="id" value="<?php echo $category['id'] ?>">

            <button type="submit">Edit <?php echo $category['category'] ?> category</button>
        </form>

        <form method="post" action="<?php echo $category['category'] ?>/delete">
            <button type="submit">Delete <?php echo $category['category'] ?> category</button>
        </form>
    </div>
</div>


</body>
</html>