<?php
require_once __DIR__ . '/../models/categorie.php';

class CategorieController{
    static function get_sup_cat($id){
        
        $ret = array_values(Categorie::get_sup_cat($id));
        return array_column($ret,"id");
    }

    static function get_sub_cat($id){
        $ret = array_values(Categorie::get_sub_cat($id));
        return array_column($ret,"id");
        
    }
    static function get_direct_sub_cat($id){
        $ret = array_values(Categorie::get_direct_sub_cat($id));
        return $ret;
    }
}