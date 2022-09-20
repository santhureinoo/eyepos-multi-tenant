<?php

namespace App\Imports;

use App\Models\Inventory;
use App\Models\Inventory\Supplier;
use App\Models\Inventory\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class InventoriesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $supplier = Supplier::where('name', '=', $row[2])->firstOrFail();
        $brand = Brand::where('name', '=', $row[3])->firstOrFail();
        Log::info($row);
        return new Inventory([
            'category' => $row[0],
            'type' => $row[1],
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'description' => $row[4],
            'prescription' => $row[5],
            'base_curve' => $row[6],
            'diameter' => $row[7],
            'quantity' => $row[8],
            'color_lens' => $row[9],
            'price_cost' => $row[10],
            'price_selling' => $row[11],
            'consignment' =>$row[12],
            'purchase_at' =>$row[13],
            'soldout_at' =>$row[14],
        ]);
    }
}
