<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable=[

        'products_name',
        'description',
        'section_id',
    ];

    protected $guarded=[];


    public function section()
    {
        return $this->belongsTo('App\Sections');
    }
}
