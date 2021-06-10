<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataImportController extends Controller
{
    public function importUnits()
    {
        $unite = [
            "BAG" => "Bag",
            "BKT" => "Bucket",
            "BND" => "Bundle",
            "BOWL" => "Bowl",
            "BX" => "Box",
            "CRD" => "Card",
            "CM" => "Centimeters",
            "CS" => "Case",
            "CTN" => "Carton",
            "DZ" => "Dozen",
            "EA" => "Each",
            "FT" => "Foot",
            "GAL" => "Gallon",
            "GROSS" => "Gross",
            "IN" => "Inches",
            "KIT" => "Kit",
            "LOT" => "Lot",
            "M" => "Meter",
            "MM" => "Millimeter",
            "PC" => "Piece",
            "PK" => "Pack",
            "PK100" => "Pack 100",
            "PK50" => "Pack 50",
            "PR" => "Pair",
            "RACK" => "Rack",
            "RL" => "Roll",
            "SET" => "Set",
            "SET3" => "Set of 3",
            "SET4" => "Set of 4",
            "SET5" => "Set of 5",
            "SGL" => "Single",
            "SHT" => "Sheet",
            "SOFT" => "Square ft",
            "TUBE" => "Tube",
            "YD" => "Yard",


        ];

        foreach ($unite as $key => $value) {
            echo $key .'====='.$value.'<br>';
           DB::table('units')->insert([
                'unit_code' => $key,
                'unit_name' => $value,
                'created_at' => now(),
                'updated_at' => now(),

            ]);
        }
        }}
