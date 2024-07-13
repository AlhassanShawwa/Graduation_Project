<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{

    use HasFactory;
    use Translatable;


    public $translatedAttributes = ['name'];
    public $fillable= ['price','description','status'];


}
