<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use Exception;

class CategoryHandlerController
{

    public function show(array $params)
    {
        try {
            $pdo = Database::getInstance()->connection();
            $statement = $pdo->prepare('Select * FROM categories WHERE category = :searchName ');
            $statement->execute(['searchName' => $params['name']]);
            $category = $statement->fetch();
            if (!$category) {
                throw new Exception("It seems this category do not exists!");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $makeTree = new CategoryTreeController();
        $categoryTree = $makeTree->generate();

        View::show('category.php', [
            'category' => $category,
            'categoryTree' => $categoryTree
        ]);
    }

    public function delete(array $params)
    {
        try {
            $pdo = Database::getInstance()->connection();
            $statement = $pdo->prepare('Delete FROM categories WHERE category = :searchName ');
            $statement->execute(['searchName' => $params['name']]);
            $deleted = $statement->fetch();
            if ($deleted) {
                throw new Exception("There is no such category");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        header('Location: /home');
    }

    public function create()
    {

        View::show('create.php', [
            'parent_id' => $_GET['parent_id']]);
    }

    public function store()
    {

        $pdo = Database::getInstance()->connection();
        $statement = $pdo->prepare('INSERT INTO categories (parent_id, category, title, description) values (:parent_id, :category, :title, :description)');
        $statement->execute([
            'parent_id' => (int)$_POST['parent_id'],
            'category' => $_POST['category'],
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ]);

        header('Location: ' . $_POST['category']);
    }

    public function edit()
    {

        try {
            $pdo = Database::getInstance()->connection();
            $statement = $pdo->prepare('Select * FROM categories WHERE id = :searchId ');
            $statement->execute(['searchId' => $_GET['id']]);
            $category = $statement->fetch();
            if (!$category) {
                throw new Exception("It seems this category do not exists!");
            }
            View::show('edit.php', [
                'category' => $category
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update()
    {
        if (empty($_POST['category'])) {
            $pdo = Database::getInstance()->connection();
            $statement = $pdo->prepare('SELECT category FROM categories WHERE id = :id');
            $statement->execute([
                'id' => $_POST['id']
            ]);
            $_POST['category'] = $statement->fetch()[0];
            var_dump($_POST['category']);
        }
        $pdo = Database::getInstance()->connection();
        $statement = $pdo->prepare('UPDATE categories SET category = :category, title = :title, description = :description WHERE id = :id ');
        $statement->execute([
            'id' => (int)$_POST['id'],
            'category' => $_POST['category'],
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ]);

        header('Location: ' . $_POST['category']);
    }

    public function createSubcategory()
    {
        View::show('createSubcategory.php', [
            'parent_id' => $_GET['id']]);
    }

    public function storeSubcategory()
    {
        $pdo = Database::getInstance()->connection();
        $statement = $pdo->prepare('INSERT INTO categories (parent_id, category, title, description) values (:parent_id, :category, :title, :description)');
        $statement->execute([
            'parent_id' => (int)$_POST['parent_id'],
            'category' => $_POST['category'],
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ]);

        header('Location: ' . $_POST['category']);
    }

}