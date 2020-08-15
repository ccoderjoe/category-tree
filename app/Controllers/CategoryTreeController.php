<?php

namespace App\Controllers;

use App\Core\Database;
use PDO;

class CategoryTreeController
{
    public function generate(): string
    {
        $pdo = Database::getInstance()->connection();
        $categories = $pdo->query('SELECT id, parent_id, category FROM categories ORDER BY category');
        $rows = $categories->fetchAll(PDO::FETCH_ASSOC);

        return $this->generateTree($rows);

    }

    public function generateTree(array $data, int $parent = 0): string
    {
        {
            $tree = "<ul>\n";
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['parent_id'] == $parent) {
                    $tree .= "<li>\n";
                    $tree .= "<a href='" . $data[$i]['category'] . "'>";
                    $tree .= $data[$i]['category'];
                    $tree .= "</a>";
                    $tree .= $this->generateTree($data, $data[$i]['id']);
                    $tree .= "</li>\n";
                }
            }
            $tree .= "</ul>\n";

            return $tree;
        }
    }
}
