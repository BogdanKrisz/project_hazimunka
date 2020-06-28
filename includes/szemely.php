<?php

class Szemely
{
    public $szemely_id;
    public $nev;
    public $jo_munka;
    public $rossz_munka;
    public $jo_idopont;


    public static function szemely_mind()
    {
        return self::szemely_to_object_query("SELECT * FROM szemelyek");
    }

    public static function szemely_by_id($id)
    {
        $result_array = self::szemely_to_object_query("SELECT * FROM szemelyek WHERE szemely_id = $id LIMIT 1");

        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function szemely_to_object_query($sql)
    {
        global $adatbazis;

        $result = $adatbazis->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result))
        {
            $the_object_array[] = self::peldanyositas($row);
        }

        return $the_object_array;
    }

    public static function peldanyositas($the_record)
    {
        $the_object = new self;

        foreach ($the_record as $the_attribute => $value)
        {
            if($the_object->has_the_attribute($the_attribute))
            {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($attribute)
    {
        $class_objects = get_object_vars($this);
        return array_key_exists($attribute, $class_objects);
    }
}