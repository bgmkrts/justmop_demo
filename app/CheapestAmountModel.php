<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheapestAmountModel extends Model
{
    protected $table="cheapest_amount";
    protected $fillable = [
        "symbol_id",
        "value",
        "api_url",
    ];
    public function Symbol(){
        return $this->belongsTo(SymbolModel::class);
    }
}
