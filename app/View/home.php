<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="/app/View/css/styles.css" rel="stylesheet" type="text/css"/>
    <title>Homepage</title>
</head>
<body>


<div class="description-container">
    <h4> Welcome to homepage! </h4>
    <h5> Have a nice day building your category tree</h5>
</div>


<div class="main-container">
    <div class="category-container"> <?php echo $categoryTree ?></div>
    <div class="menu-container">

        <form method="get" action="<?php echo $category['category'] ?>/create">
            <input type="hidden" name="parent_id" value="<?php echo $category['parent_id'] ?>">
            <button type="submit">Create new category</button>
        </form>

    </div>

</div>
</body>
</html>