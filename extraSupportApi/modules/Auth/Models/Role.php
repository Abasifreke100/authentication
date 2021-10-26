<?php

namespace LoanHistory\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Role extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
      "id",
      "name",
      "slug"
    ];

    public function getRole($query,$slug){
        return $query->where("slug", $slug);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

}
