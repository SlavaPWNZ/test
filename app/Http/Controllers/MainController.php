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
        if (isset($_GET['login']) && $_GET['login']!='' && isset($_GET['password']) && $_GET['password']!='') {
            $login=addslashes($_GET['login']); $password=addslashes($_GET['password']); $result = MainModel::AuthModel($login,$password);
        }
        if (!isset($result)) $result['error']="invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function createCategory()
    {
        if (isset($_GET['name_new']) && $_GET['name_new']!='' && isset($_GET['token']) && $_GET['token']!='') {
            $name_new=addslashes($_GET['name_new']); $token=addslashes($_GET['token']); $result = MainModel::CreateCategory($name_new,$token);
        }
        if (!isset($result)) $result['error']="invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
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
