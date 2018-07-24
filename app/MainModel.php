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
            $result=DB::table('category')->orderBy('id', 'asc')->get();
            if (!empty($result)) {
                return $result;
            }
            else
            {
                $result=null;
                $result['error']="categories not found";
                return $result;
            }
        } catch(\Illuminate\Database\QueryException $ex){
            $result=null;
            $result['error']="db tables errors";
            return $result;
        }
    }

    public static function GetItemsModel($id)
    {
        try {
            $result1=DB::table('category')->where('id', '=', $id)->get();
            if (!empty($result1)) {
                $result2 = DB::table('ratio_category_items')->where('id_category', '=', $id)->get();
                if (!empty($result2)) {
                    for ($i = 0; $i < count($result2); $i++) {
                        $result3 = DB::table('items')->where('id', '=', $result2[$i]->id_item)->get();
                        if (!empty($result3)) {
                            $result[$i]['id'] = $result3[0]->id;
                            $result[$i]['name'] = $result3[0]->name;
                        }
                        else{
                            $result=null;
                            $result['error']="db tables errors";
                            return $result;
                        }
                    }
                    return $result;
                } else
                {
                    $result=null;
                    $result['error']="items not found";
                    return $result;
                }
            }
            else
            {
                $result=null;
                $result['error']="category not found";
                return $result;
            }
        } catch(\Illuminate\Database\QueryException $ex){
            $result=null;
            $result['error']="db tables errors";
            return $result;
        }
    }


    public static function AuthModel($login,$password)
    {
        try {
            $result1=DB::table('users')->where([['login', '=', $login],['password', '=', $password]])->get();
            if (!empty($result1)) {
                $time = Carbon::now();
                $str=$login.$password.$time;
                $token['token'] = md5($str);
                DB::table('tokens')->insert(
                    ['token' => $token['token'], 'date' => $time]
                );
                return $token;
            }
            else
            {
                $result=null;
                $result['error']="incorrect login or password";
                return $result;
            }
        } catch(\Illuminate\Database\QueryException $ex){
            $result=null;
            $result['error']="db tables errors";
            return $result;
        }
    }

    public static function CreateCategory($name_new,$token)
    {
        try {
            $time = Carbon::now()->subHour();
            $result1=DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $result2 = DB::table('category')->where('name', '=', $name_new)->get();
                if (empty($result2)) {
                    DB::table('category')->insert(
                        ['name' => $name_new]
                    );
                    $result=null;
                    $result['result']="category successfully created";
                    return $result;
                } else
                {
                    $result=null;
                    $result['error']="category with this name already created";
                    return $result;
                }
            }
            else
            {
                $result=null;
                $result['error']="incorrect token or left time (1hour)";
                return $result;
            }
        } catch(\Illuminate\Database\QueryException $ex){
            $result=null;
            $result['error']="db tables errors";
            return $result;
        }
    }

    public static function ChangeCategory($id,$name_new,$token)
    {
        try {
            $time = Carbon::now()->subHour();
            $result1=DB::table('tokens')->where([['token', '=', $token],['date', '>', $time]])->get();
            if (!empty($result1)) {
                $result2 = DB::table('category')->where('id', '=', $id)->get();
                if (!empty($result2)) {
                    $result3 = DB::table('category')->where('name', '=', $name_new)->get();
                    if (empty($result3)) {
                        DB::table('category')
                            ->where('id', '=', $id)
                            ->update(['name' => $name_new]);
                        $result=null;
                        $result['result']="category successfully changed";
                        return $result;
                    } else
                    {
                        $result=null;
                        $result['error']="category with this name already created";
                        return $result;
                    }
                } else
                {
                    $result=null;
                    $result['error']="category with this ID not found";
                    return $result;
                }
            }
            else
            {
                $result=null;
                $result['error']="incorrect token or left time (1hour)";
                return $result;
            }
        } catch(\Illuminate\Database\QueryException $ex){
            $result=null;
            $result['error']="db tables errors";
            return $result;
        }
    }



}
