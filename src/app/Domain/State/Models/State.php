<?php

namespace App\Domain\State\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use softDeletes;
    use HasFactory; 
    protected $fillable = ['name', 'state_code'];
}