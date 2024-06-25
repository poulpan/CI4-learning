<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsListModel extends Model
{
    protected $table = 'cars_list';
    protected $primaryKey = 'cl_id';  // needed this to work the find() method in CarsList Controller

    protected $allowedFields = ['cl_brand', 'cl_model', 'cl_color', 'cl_year'];  // you need to specify witch fields are allowed to be inserted in the db

    protected $returnType = \App\Entities\CarsListEntity::class;

    protected $validationRules = [
        'cl_brand' => 'required|max_length[128]',
        'cl_model' => 'required|max_length[128]',
        'cl_color' => 'max_length[128]',
        'cl_year' => 'required|integer|exact_length[4]'
    ];

    protected $validationMessages = [
        'cl_brand' => [
            'required' => 'Brand field is required!',
            'max_length' => 'Brand field allows maximum {param} characters.'
        ],
        'cl_model' => [
            'required' => 'Model field is required!',
            'max_length' => 'Model field allows maximum {param} characters.'
        ],
        'cl_color' => [
            'max_length' => 'Color field allows maximum {param} characters.'
        ],
        'cl_year' => [
            'required' => 'Year field is required!',
            'integer' => 'Year field must contain an integer.',
            'exact_length' => 'Year field must contain exactly {param} numbers.'
        ]
    ];
}