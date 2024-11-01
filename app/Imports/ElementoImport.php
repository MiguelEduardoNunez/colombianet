<?php

namespace App\Imports;

use App\Models\Elemento;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ElementoImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
       
            return new Elemento([
                'proyecto_id' => $row['proyecto_id'],
                'stand_id' => $row['stand_id'],
                'item_id' => $row['item_id'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'serial' => $row['serial'],
                'span' => $row['span'],
                'codigo_barras' => $row['codigo_barras'],
                'grosor' => $row['grosor'],
                'peso' => $row['peso'],
                'cantidad' => $row['cantidad'],
                'cantidad_minima' => $row['cantidad_minima'],
                'tipo_cantidad_id' => $row['tipo_cantidad_id'],
            ]);
        }
        public function rules(): array
        {
            return[
            'proyecto_id'=>['required','numeric'],
            'stand_id' => ['required', 'numeric'],
            'item_id'=>['required','numeric'],
            'marca' => ['required', 'string', 'max:50','unique:elementos,marca'],
            'modelo' => ['required', 'string', 'max:50','unique:elementos,marca'],
            'serial' => ['required', 'numeric'],
            'span' => ['required', 'numeric'],
            'codigo_barras' => ['required', 'numeric'],
            'grosor' => ['required', 'numeric'],
            'peso' => ['required', 'numeric'],
            'cantidad' => ['required', 'decimal:2'],
            'cantidad_minima' => ['required', 'decimal:2'],
            'tipo_cantidad_id' => ['required', 'numeric'],
            ];
        }
}
