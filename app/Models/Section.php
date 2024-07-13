<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    protected $fillable=['name','description'];
    use HasFactory;
    use Translatable;

    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name','description'];

    public function doctors(){
        return $this->hasmany(Doctor::class); 
    }


}
