<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsType;
use App\Category;

class AjaxController extends Controller
{
    public function getNewsTypes(Category $category)
    {
        $newsTypes = $category->newsTypes;
        foreach ($newsTypes as $newsType) {
            echo "<option value='" . $newsType->id . "'>" . $newsType->name . "</option>";
        }
    }
}
