<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MainModel;
header('Content-Type: text/html; charset=utf-8');

class MainController extends Controller
{

    public function index()
    {
        if (!isset($result)) $result['error']="invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getCategories()
    {
        $result = MainModel::GetCategoriesModel();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getItems()
    {
        if (isset($_GET['id']) && $_GET['id']!='') { $id=addslashes($_GET['id']); $result = MainModel::GetItemsModel($id); }
        if (!isset($result)) $result['error']="invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function auth()
    {
        echo 'auth';
    }

    public function createCategory()
    {
        echo 'createCategory';
    }

    public function changeCategory()
    {
        echo 'changeCategory';
    }

    public function deleteCategory()
    {
        echo 'deleteCategory';
    }

    public function createItem()
    {
        echo 'createItem';
    }

    public function changeItem()
    {
        echo 'changeItem';
    }

    public function deleteItem()
    {
        echo 'deleteItem';
    }

}
