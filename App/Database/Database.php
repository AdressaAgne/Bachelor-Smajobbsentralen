<?php

namespace App\Database;
use Config;
use PDO;

class Database extends DBhelpers{
    /**
     * Select * from class
     * @param  array  [$rows                  = ['*']]
     * @return object Table[Row object] Object
     */
    public static function all($table, array $rows = ['*']){
        return self::query('SELECT '.implode(', ', $rows).' FROM '.$table)->fetchAll();
    }
    
    public static function select($table, array $rows = ['*'], $data = null, $join = 'AND', $class = null){
        
        if($join == 'AND' || $join == 'OR'){
        
        } else {
            $class = $join;
        }
        
        $args = null;
        if($data != null){
            $arg = [];
            $args = $data;
            foreach($data as $key => $value){
                $arg[] = "$key = :$key";
            }
            $where = " WHERE ".implode(" $join ", $arg);
        } else {
            $where = "";
        }

        return self::query('SELECT '.implode(', ', $rows).' FROM '.$table.$where, $args, $class);
    }

    /**
     * Delete a row from a table
     * @param  string       [$col = 'id']   col name
     * @param  string       [$val = 0]      Value of col to delete
     * @param  string       [$table = null] Table name
     * @return object/false
     */
    public static function deleteWhere($table, $col = 'id', $val = 0){
        return self::query("DELETE FROM {$table} WHERE {$col} = :val", ['val' => $val]);
    }



    /**
     * insert many rows to table
     * @param  array  array $data
     * @param  string [$table = null] MySQL table
     * @return boo
     */
    public static function insert($table, array $data){
        $trows = [];
        $placeholder = [];
        $values = [];
        $insertData = [];
        foreach($data[0] as $key => $value){
            $trows[] = $key;
        }

        foreach($data as $nr => $rows){
            $p = [];
            foreach($rows as $key => $row){
                $p[] = ":".$key.$nr;
                $insertData[$key.$nr] = $row;
            }
            $placeholder[] = '('.implode(", ", $p).')';
        }

        $trows = implode(", ", $trows);
        $placeholder = implode(", ", $placeholder);

        $sql = "INSERT INTO {$table} ({$trows}) VALUES {$placeholder}";
        $q = self::query($sql, $insertData);
        $id = self::$db->lastInsertId('id');
        if($id == 0){
          return $q;
        }
        return $id;
    }
    
    /**
     * Update one row in a table
     * @author Agne *degaard
     * @param array $rows       
     * @param string $table      
     * @param array $where      
     * @param string $join = '=' 
     */
    public static function updateWhere($table, array $rows, array $where, $join = '=', $wherejoin = 'AND'){
        $data = [];
        $trows = [];
        $twhere = [];
        foreach($rows as $key => $row){
            $trows[] = "$key $join :key_$key";
            $data["key_$key"] = $row;
        }
        
        foreach($where as $key => $value){
            $twhere[] = "$key $join :where_$key";
            $data["where_$key"] = $value;
        }
        
        $trows = implode(', ', $trows);
        $twhere = implode(" $wherejoin ", $twhere);
        $sql = "UPDATE {$table} SET {$trows} WHERE {$twhere}";
        return self::query($sql, $data);
    }
    
    /**
     * update or insert a new setting value
     * @author Agne *degaard
     * @param string $name  
     * @param string $value
     */
    public static function setSetting($name, $value){
        self::updateWhere('settings', ['value' => $value], ['name' => $name]);
    }
    
    /**
     * featch a settings value
     * @author Agne *degaard
     * @param  string $name 
     * @return string
     */
    public static function getSetting($name){
        return self::select('settings', ['value'], ['name' => $name])->fetch()['value'];
    }
    
}
