<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;

class ProductImport implements ToModel , WithHeadingRow ,WithValidation
{
    private int $row_number=0;

    /**
     * @param array $row
     *
     * @return Model|Product|null
     * @throws ValidationException
     */
    public function model(array $row): Model|Product|null
    {
        $this->row_number++;
        if ($row['name'] == 'computer'){
            $error =['name' =>'invalid name'];
            return $this->fail('name' , $error  , $row);
        }

        return new Product([
            'name'     => $row['name'],
            'price'    => $row['price'],
            'stock'    => $row['stock'],
        ]);
    }

    public function rules(): array
    {
        return Product::rules();
    }

    /**
     * @throws ValidationException
     */
    public function fail($key , $error , $row){
        $failures[] =new Failure($this->row_number, $key , $error ,$row);
        throw new ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
    }
}
