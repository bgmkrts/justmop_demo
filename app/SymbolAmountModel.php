<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SymbolAmountModel extends Model
{
    protected $table = "symbol_amount";
    protected $fillable = [
        "symbol_id",
        "value",
        "api_url",
    ];
    public function Symbol(){
        return $this->belongsTo(SymbolModel::class);
    }
}
