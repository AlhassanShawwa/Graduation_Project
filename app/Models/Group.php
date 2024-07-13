<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name','notes'];
    public $fillable= ['Total_before_discount','discount_value','Total_after_discount','tax_rate','Total_with_tax'];
    //ازا انا بديش احدد ايش بدي اعملو fillable
    // بحط هاد command
    //public $guarded=[];

    public function service_group()
    {
        return $this->belongsToMany(Service::class,'service_group');
    }
}