<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'first_name', 'last_name', 'email', 'phone'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
