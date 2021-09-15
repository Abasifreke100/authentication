<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_name",
        "phone",
        "state",
        "gender",
        "amount",
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeOfFullName($query,$fullName){
        return $query->where('first_name', 'LIKE', '%' . $fullName . '%');
    }

    public function scopeOfUser($query){

        if(auth()->user()->role->name == "Super Admin")
            return $query;
        return $query->where("user_id", auth()->user()->id);
    }

}
