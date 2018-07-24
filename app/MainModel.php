<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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


}
