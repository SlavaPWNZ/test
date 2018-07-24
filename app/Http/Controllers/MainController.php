<?php
namespace App\Http\Controllers;

use App\MainModel;
header('Content-Type: text/html; charset=utf-8');

class MainController extends Controller
{

    public function index()
    {
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getCategories()
    {
        $result = MainModel::GetCategoriesModel();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getItems()
    {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $id     = addslashes($_GET['id']);
            $result = MainModel::GetItemsModel($id);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function auth()
    {
        if (isset($_GET['login']) && $_GET['login'] != '' && isset($_GET['password']) && $_GET['password'] != '') {
            $login    = addslashes($_GET['login']);
            $password = addslashes($_GET['password']);
            $result   = MainModel::AuthModel($login, $password);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function createCategory()
    {
        if (isset($_GET['name_new']) && $_GET['name_new'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
            $name_new = addslashes($_GET['name_new']);
            $token    = addslashes($_GET['token']);
            $result   = MainModel::CreateCategoryModel($name_new, $token);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function changeCategory()
    {
        if (isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['name_new']) && $_GET['name_new'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
            $id       = addslashes($_GET['id']);
            $name_new = addslashes($_GET['name_new']);
            $token    = addslashes($_GET['token']);
            $result   = MainModel::ChangeCategoryModel($id, $name_new, $token);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function deleteCategory()
    {
        if (isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
            $id     = addslashes($_GET['id']);
            $token  = addslashes($_GET['token']);
            $result = MainModel::DeleteCategoryModel($id, $token);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function createItem()
    {
        if (isset($_GET['name_new']) && $_GET['name_new'] != '' && isset($_GET['ids_categories_new']) && $_GET['ids_categories_new'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
            $name_new           = addslashes($_GET['name_new']);
            $ids_categories_new = addslashes($_GET['ids_categories_new']);
            $token              = addslashes($_GET['token']);
            $result             = MainModel::CreateItemModel($name_new, $ids_categories_new, $token);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function changeItem()
    {
        if (isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['name_new']) && $_GET['name_new'] != '' && isset($_GET['ids_categories_new']) && $_GET['ids_categories_new'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
            $id                 = addslashes($_GET['id']);
            $name_new           = addslashes($_GET['name_new']);
            $ids_categories_new = addslashes($_GET['ids_categories_new']);
            $token              = addslashes($_GET['token']);
            $result             = MainModel::ChangeItemModel($id, $name_new, $ids_categories_new, $token);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function deleteItem()
    {
        if (isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
            $id     = addslashes($_GET['id']);
            $token  = addslashes($_GET['token']);
            $result = MainModel::DeleteItemModel($id, $token);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function createUser()
    {
        if (isset($_GET['login']) && $_GET['login'] != '' && isset($_GET['password']) && $_GET['password'] != '') {
            $login    = addslashes($_GET['login']);
            $password = addslashes($_GET['password']);
            $result   = MainModel::CreateUserModel($login, $password);
        }
        if (!isset($result))
            $result['error'] = "invalid args";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

}