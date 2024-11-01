<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ItemImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            'subcategoria_id' => $row['subcategoria'],
            'item' => $row['item'],
            'descripcion' => $row['descripcion']
        ]);
    }

    public function rules(): array
    {
        return [
            'subcategoria' => ['required', 'numeric',],
            'item' => ['required', 'string', 'max:100', 'unique:items,item'],
            'descripcion' => ['nullable', 'string']
        ];
    }
}
