<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name','notes'];
    public $timestamps = false;
}
