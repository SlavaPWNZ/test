<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class MainModel extends Model
{
    public static function GetCategoriesModel()
    {
        try {
            $result = DB::table('category')->orderBy('id', 'asc')->get();
            if (!empty($result)) {
                return $result;
            } else {
                $result          = null;
                $result['error'] = "categories not found";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function GetItemsModel($id)
    {
        try {
            if ($id==null) {
                $result['error'] = "invalid args";
                return $result;
            }
            $result1 = DB::table('category')->where('id', '=', $id)->get();
            if (!empty($result1)) {
                $result2 = DB::table('ratio_category_items')->where('id_category', '=', $id)->get();
                if (!empty($result2)) {
                    $result = null;
                    for ($i = 0; $i < count($result2); $i++) {
                        $result3 = DB::table('items')->where('id', '=', $result2[$i]->id_item)->get();
                        if (!empty($result3)) {
                            $result[$i]['id']   = $result3[0]->id;
                            $result[$i]['name'] = $result3[0]->name;
                        } else {
                            $result          = null;
                            $result['error'] = "db tables errors";
                            return $result;
                        }
                    }
                    return $result;
                } else {
                    $result          = null;
                    $result['error'] = "items not found";
                    return $result;
                }
            } else {
                $result          = null;
                $result['error'] = "category not found";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function AuthModel($login, $password)
    {
        try {
            if ($login==null || $password==null) {
                $result['error'] = "invalid args";
                return $result;
            }
            $result1 = DB::table('users')->where([['login', '=', $login],['password', '=', $password]])->get();
            if (!empty($result1)) {
                $time           = Carbon::now();
                $str            = $login . $password . $time;
                $token['token'] = md5($str);
                DB::table('tokens')->insert(['token' => $token['token'], 'date' => $time]);
                return $token;
            } else {
                $result          = null;
                $result['error'] = "incorrect login or password";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function CreateCategoryModel($name_new, $token)
    {
        try {
            if ($name_new==null || $token==null || strlen($name_new)>50) {
                $result['error'] = "invalid args";
                return $result;
            }
            $time = Carbon::now()->subHour();
            $result1 = DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $result2 = DB::table('category')->where('name', '=', $name_new)->get();
                if (empty($result2)) {
                    DB::table('category')->insert(['name' => $name_new]);
                    $result           = null;
                    $result['result'] = "category successfully created";
                    return $result;
                } else {
                    $result          = null;
                    $result['error'] = "category with this name already created";
                    return $result;
                }
            } else {
                $result          = null;
                $result['error'] = "incorrect token or left time (1hour)";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function ChangeCategoryModel($id, $name_new, $token)
    {
        try {
            if ($id==null || $name_new==null || $token==null) {
                $result['error'] = "invalid args";
                return $result;
            }
            $time = Carbon::now()->subHour();
            $result1 = DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $result2 = DB::table('category')->where('id', '=', $id)->get();
                if (!empty($result2)) {
                    $result3 = DB::table('category')->where('name', '=', $name_new)->get();
                    if (empty($result3)) {
                        DB::table('category')->where('id', '=', $id)->update(['name' => $name_new]);
                        $result           = null;
                        $result['result'] = "category successfully changed";
                        return $result;
                    } else {
                        $result          = null;
                        $result['error'] = "category with this name already created";
                        return $result;
                    }
                } else {
                    $result          = null;
                    $result['error'] = "category with this ID not found";
                    return $result;
                }
            } else {
                $result          = null;
                $result['error'] = "incorrect token or left time (1hour)";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function DeleteCategoryModel($id, $token)
    {
        try {
            if ($id==null || $token==null) {
                $result['error'] = "invalid args";
                return $result;
            }
            $time = Carbon::now()->subHour();
            $result1 = DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $result2 = DB::table('items')->where('id', '=', $id)->get();
                if (!empty($result2)) {
                    DB::table('category')->where('id', '=', $id)->delete();
                    DB::table('ratio_category_items')->where('id_category', '=', $id)->delete();
                    $result           = null;
                    $result['result'] = "category successfully deleted and ratio with items";
                    return $result;
                }
                $result          = null;
                $result['error'] = "category with this ID not found";
                return $result;
            } else {
                $result          = null;
                $result['error'] = "incorrect token or left time (1hour)";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function CreateItemModel($name_new, $ids_categories_new, $token)
    {
        try {
            if ($name_new==null || $ids_categories_new==null || $token==null || strlen($name_new)>50) {
                $result['error'] = "invalid args";
                return $result;
            }
            $ids_categories_new = preg_split("/,/", $ids_categories_new);
            $size               = count($ids_categories_new);
            $time               = Carbon::now()->subHour();
            $result1 = DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $id = DB::table('items')->insertGetId(['name' => $name_new]);
                for ($i = 0; $i < $size; $i++) {
                    $result2 = DB::table('category')->where('id', '=', $ids_categories_new[$i])->get();
                    if (!empty($result2)) {
                        DB::table('ratio_category_items')->insert(['id_item' => $id, 'id_category' => $ids_categories_new[$i]]);
                    }
                }
                $result           = null;
                $result['result'] = "item successfully created and ratio with categories";
                return $result;
            } else {
                $result          = null;
                $result['error'] = "incorrect token or left time (1hour)";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function ChangeItemModel($id, $name_new, $ids_categories_new, $token)
    {
        try {
            if ($id==null || $name_new==null || $ids_categories_new==null || $token==null) {
                $result['error'] = "invalid args";
                return $result;
            }
            $ids_categories_new = preg_split("/,/", $ids_categories_new);
            $size               = count($ids_categories_new);
            $time               = Carbon::now()->subHour();
            $result1 = DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $result2 = DB::table('items')->where('id', '=', $id)->get();
                if (!empty($result2)) {
                     DB::table('items')->where('id', '=', $id)->update(['name' => $name_new]);
                     DB::table('ratio_category_items')->where('id_item', '=', $id)->delete();
                    for ($i = 0; $i < $size; $i++) {
                        $result3 = DB::table('category')->where('id', '=', $ids_categories_new[$i])->get();
                        if (!empty($result3)) {
                             DB::table('ratio_category_items')->insert(['id_item' => $id, 'id_category' => $ids_categories_new[$i]]);
                        }
                    }
                    $result           = null;
                    $result['result'] = "item successfully changed and ratio with categories";
                    return $result;
                }
                $result          = null;
                $result['error'] = "item with this ID not found";
                return $result;
            } else {
                $result          = null;
                $result['error'] = "incorrect token or left time (1hour)";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function DeleteItemModel($id, $token)
    {
        try {
            if ($id==null || $token==null) {
                $result['error'] = "invalid args";
                return $result;
            }
            $time = Carbon::now()->subHour();
            $result1 = DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $result2 = DB::table('items')->where('id', '=', $id)->get();
                if (!empty($result2)) {
                    DB::table('items')->where('id', '=', $id)->delete();
                    DB::table('ratio_category_items')->where('id_item', '=', $id)->delete();
                    $result           = null;
                    $result['result'] = "item successfully deleted and ratio with categories";
                    return $result;
                }
                $result          = null;
                $result['error'] = "item with this ID not found";
                return $result;
            } else {
                $result          = null;
                $result['error'] = "incorrect token or left time (1hour)";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result          = null;
            $result['error'] = "db tables errors";
            return $result;
        }
    }

    public static function CreateUserModel($login, $password)
    {
        try {
            if ($login==null || $password==null || strlen($login)>20 || strlen($password)>20) {
                $result['error'] = "invalid args";
                return $result;
            }
            $result1 = DB::table('users')->where('login', '=', $login)->get();
            if (empty($result1)) {
                DB::table('users')->insert(['login' => $login, 'password' => $password]);
                $result = null;
                $result = "user successfully created";
                return $result;
            } else {
                $result = null;
                $result = "user with this login already created";
                return $result;
            }
        }
        catch (\Illuminate\Database\QueryException $ex) {
            $result = null;
            $result = "db tables errors";
            return $result;
        }
    }

}