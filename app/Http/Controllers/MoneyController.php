<?php

namespace App\Http\Controllers;

use App\CheapestAmountModel;
use App\SymbolAmountModel;
use App\SymbolModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoneyController extends Controller
{
    public function money(Request $request)
    {

        $response = Http::get('https://run.mocky.io/v3/e4c58892-3eaa-49e8-a2d4-88ffb0f97c27');
        $response2 = Http::get('https://run.mocky.io/v3/cff2fa19-a599-46c7-a83c-c891ba721561');
        $array1 = $response->json()["data"];
        $array2 = $response2->json()["result"];
        $new_array = [];
        foreach ($array1 as $item) {
            foreach ($array2 as $item2) {
                if ($item["symbol"] == mb_strtoupper($item2["from"] . $item2["to"])) {
                    if ($item2["from"] == "usd") {
                        SymbolAmountModel::create(["symbol_id" => 1, "value" => $item["amount"], "api_url" => 'https://run.mocky.io/v3/e4c58892-3eaa-49e8-a2d4-88ffb0f97c27']);
                        SymbolAmountModel::create(["symbol_id" => 1, "value" => $item2["value"], "api_url" => 'https://run.mocky.io/v3/cff2fa19-a599-46c7-a83c-c891ba721561']);
                    }
                    if ($item2["from"] == "eur") {
                        SymbolAmountModel::create(["symbol_id" => 2, "value" => $item["amount"], "api_url" => 'https://run.mocky.io/v3/e4c58892-3eaa-49e8-a2d4-88ffb0f97c27']);
                        SymbolAmountModel::create(["symbol_id" => 2, "value" => $item2["value"], "api_url" => 'https://run.mocky.io/v3/cff2fa19-a599-46c7-a83c-c891ba721561']);
                    }
                    if ($item2["from"] == "gbp") {
                        SymbolAmountModel::create(["symbol_id" => 3, "value" => $item["amount"], "api_url" => 'https://run.mocky.io/v3/e4c58892-3eaa-49e8-a2d4-88ffb0f97c27']);
                        SymbolAmountModel::create(["symbol_id" => 3, "value" => $item2["value"], "api_url" => 'https://run.mocky.io/v3/cff2fa19-a599-46c7-a83c-c891ba721561']);
                    }
                    if ($item2["value"] > $item["amount"]) {
                        array_push($new_array, ["symbol" => $item["symbol"], "value" => $item["amount"]]);
                        if ($item2["from"] == "usd") {
                            CheapestAmountModel::create(["symbol_id" => 1, "value" => $item["amount"], "api_url" => 'https://run.mocky.io/v3/e4c58892-3eaa-49e8-a2d4-88ffb0f97c27']);
                        }
                        if ($item2["from"] == "eur") {
                            CheapestAmountModel::create(["symbol_id" => 2, "value" => $item["amount"], "api_url" => 'https://run.mocky.io/v3/e4c58892-3eaa-49e8-a2d4-88ffb0f97c27']);
                        }
                        if ($item2["from"] == "gbp") {
                            CheapestAmountModel::create(["symbol_id" => 3, "value" => $item["amount"], "api_url" => 'https://run.mocky.io/v3/e4c58892-3eaa-49e8-a2d4-88ffb0f97c27']);
                        }


                    } else {
                        array_push($new_array, ["symbol" => $item["symbol"], "value" => $item2["value"]]);
                        if ($item2["from"] == "usd") {
                            CheapestAmountModel::create(["symbol_id" => 1, "value" => $item2["value"], "api_url" => 'https://run.mocky.io/v3/cff2fa19-a599-46c7-a83c-c891ba721561']);
                        }
                        if ($item2["from"] == "eur") {
                            CheapestAmountModel::create(["symbol_id" => 2, "value" => $item2["value"], "api_url" => 'https://run.mocky.io/v3/cff2fa19-a599-46c7-a83c-c891ba721561']);
                        }
                        if ($item2["from"] == "gbp") {
                            CheapestAmountModel::create(["symbol_id" => 3, "value" => $item2["value"], "api_url" => 'https://run.mocky.io/v3/cff2fa19-a599-46c7-a83c-c891ba721561']);
                        }
                    }
                }
            }
        }

        return response()->json([
            "new_array" => $new_array,
            "data_1" => $response->json(),
            "data_2" => $response2->json()
        ], 200);
    }

    public function stringSml($txt)
    {
        return response()->json([
            "input" => $txt,
            "result" => $this->calculate($txt)
        ]);
    }

    public function calculate($text)
    {
        $length = strlen($text);
        $count = 0;
        for ($i = 0; $i < $length; $i++) {
            $len = $length - $i;
            for ($j = 0; $j < $len; $j++)
                if ($text[$j] != $text[$j + $i]) {
                    break;
                }
            $count += $j;
        }
        return $count;
    }
}
