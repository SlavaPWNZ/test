<?php
namespace App\Http\Controllers;

use App\MainModel;
//header('Content-Type: text/html; charset=utf-8');

class MainController extends Controller
{
    public $id = null;
    public $login = null;
    public $password = null;
    public $token = null;
    public $name_new = null;
    public $ids_categories_new = null;

    public function index()
    {
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getCategories()
    {
        $result = MainModel::GetCategoriesModel();
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getItems()
    {

        if (isset($_GET['id']))
            $this->id = addslashes($_GET['id']);
        $result = MainModel::GetItemsModel($this->id);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function auth()
    {
        if (isset($_GET['login']) && isset($_GET['password'])) {
            $this->login    = addslashes($_GET['login']);
            $this->password = addslashes($_GET['password']);
        }
        $result = MainModel::AuthModel($this->login, $this->password);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function createCategory()
    {
        if (isset($_GET['name_new']) && isset($_GET['token'])) {
            $this->name_new = addslashes($_GET['name_new']);
            $this->token    = addslashes($_GET['token']);
        }
        $result = MainModel::CreateCategoryModel($this->name_new, $this->token);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function changeCategory()
    {
        if (isset($_GET['id']) && isset($_GET['name_new']) && isset($_GET['token'])) {
            $this->id       = addslashes($_GET['id']);
            $this->name_new = addslashes($_GET['name_new']);
            $this->token    = addslashes($_GET['token']);
        }
        $result = MainModel::ChangeCategoryModel($this->id, $this->name_new, $this->token);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function deleteCategory()
    {
        if (isset($_GET['id']) && isset($_GET['token'])) {
            $this->id    = addslashes($_GET['id']);
            $this->token = addslashes($_GET['token']);
        }
        $result = MainModel::DeleteCategoryModel($this->id, $this->token);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function createItem()
    {
        if (isset($_GET['name_new']) && isset($_GET['ids_categories_new']) && isset($_GET['token'])) {
            $this->name_new           = addslashes($_GET['name_new']);
            $this->ids_categories_new = addslashes($_GET['ids_categories_new']);
            $this->token              = addslashes($_GET['token']);
        }
        $result = MainModel::CreateItemModel($this->name_new, $this->ids_categories_new, $this->token);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function changeItem()
    {
        if (isset($_GET['id']) && isset($_GET['name_new']) && isset($_GET['ids_categories_new']) && isset($_GET['token'])) {
            $this->id                 = addslashes($_GET['id']);
            $this->name_new           = addslashes($_GET['name_new']);
            $this->ids_categories_new = addslashes($_GET['ids_categories_new']);
            $this->token              = addslashes($_GET['token']);
        }
        $result = MainModel::ChangeItemModel($this->id, $this->name_new, $this->ids_categories_new, $this->token);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function deleteItem()
    {
        if (isset($_GET['id']) && isset($_GET['token'])) {
            $this->id    = addslashes($_GET['id']);
            $this->token = addslashes($_GET['token']);
        }
        $result = MainModel::DeleteItemModel($this->id, $this->token);
        if (!isset($result))
            $result['error'] = "invalid args";
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

}