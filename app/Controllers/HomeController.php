<?php

namespace App\Controllers;

use App\Core\View;

class HomeController
{
    public function show()
    {
        $makeTree = new CategoryTreeController();
        $categoryTree = $makeTree->generate();

        $category['category'] = 'homepage';
        $category['parent_id'] = 0;

        View::show('home.php', [
            'categoryTree' => $categoryTree,
            'category' => $category
            ]);
    }


}