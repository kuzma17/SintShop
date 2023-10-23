<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasRoles;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
        'phone',
        'delivery_id',
        'payment_id',
        'delivery_address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders(){
        return $this->hasMany(Order::class)->sort();
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public static function findUser($phone){
        $phone = cleanPhone($phone);
        return self::where('phone', $phone)->first();
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function setPhoneAttribute($value){
        $this->attributes['phone']  = cleanPhone($value);
    }

    public function createUser($data){

        if ($user =self::findUser($data['phone'])){
            return $user;
        }

//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'phone' => cleanPhone($data['phone']),
//            'password' => Hash::make($data['password']),
//            'delivery_id' => $data['delivery_id'],
//            'payment_id' => $data['payment_id'],
//            'delivery_address' => $data['delivery_address'],
//        ]);

        return self::create($data);

    }
}
