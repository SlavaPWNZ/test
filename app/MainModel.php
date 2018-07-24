<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class MainModel extends Model
{

    public function timeFormat()
    {
        $timestamp = time();
        $date_time_array = getdate($timestamp);
        $hours = $date_time_array['hours'];
        $minutes = $date_time_array['minutes'];
        $seconds = $date_time_array['seconds'];
        $month = $date_time_array['mon'];
        $day = $date_time_array['mday'];
        $year = $date_time_array['year'];
        $timestamp = mktime($hours-1,$minutes,$seconds,$month,$day,$year);
        $result=strftime('%Y-%m-%d %H:%M:%S',$timestamp);
        return $result;
    }

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


    public static function GetAuthModel($login,$password)
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


}
