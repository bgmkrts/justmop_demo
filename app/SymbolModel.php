<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SymbolModel extends Model
{
    protected $table="symbol";

    public function Cheapest(){
        return $this->hasMany(CheapestAmountModel::class,"symbol_id","id");
    }
    public function SymbolAmount(){
        return $this->hasMany(SymbolAmountModel::class,"symbol_id","id");
    }
}
