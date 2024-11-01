<?php

namespace App\Imports;

use App\Models\SubCategoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubcategoriasImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubCategoria([

            'categoria_id'=>$row['categoria_id'],
            'subcategoria'=>$row['subcategoria'],
            'descripcion'=>$row['descripcion']

        ]);
    }

    public function rules(): array
    {
        return [
            'categoria_id' => ['required', 'numeric'],
            'subcategoria' => ['required', 'string', 'max:100', 'unique:subcategorias,subcategoria'],
            'descripcion' => ['nullable', 'string']
        ];
    }
}
