<?php

namespace LoanHistory\Modules\Auth\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use LoanHistory\Modules\DateFilters;
use LoanHistory\Modules\Project\Models\Loan;
use LoanHistory\Modules\Auth\Models\Role;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, DateFilters;

    public $incrementing = false;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'status',
        'email',
        'password',
        'reference',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function loan(){
        return $this->hasMany(Loan::class,'user_id');
    }


    public function firstName(){
        return $this->first_name ;
    }

    public function fullName(){
        return $this->first_name. " " . $this->last_name;
    }

    public function scopeOfUser($query){

        if (auth()->user()->role->slug == "super_admin") {
            return $query;
        }

        return $query->where("user_id", auth()->user()->id);
    }


    public function scopeOfFirstName($query,$firstName){
        return $query->where('first_name', 'LIKE', '%' . $firstName . '%');
    }

    public function scopeOfLastName($query,$lastName){
        return $query->where('last_name', 'LIKE', '%' . $lastName . '%');
    }

    public function scopeOfMiddleName($query,$middleName){
        return $query->where('middle_name', 'LIKE', '%' . $middleName . '%');
    }

    public function scopeOfEmail($query,$email){
        return $query->where('email', 'LIKE', '%' . $email . '%');
    }

    public function scopeOfRole($query,$role){
        return $query->whereIn('role_id', function ($query) use ($role){
            return $query->select('id')->from('roles')->where('slug', 'LIKE', '%' . $role . '%');
        });
    }





}
