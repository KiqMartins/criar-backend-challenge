<?php

namespace App\Domain\Cluster\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\City\Models\City;

class Cluster extends Model
{
    /** @use HasFactory<\Database\Factories\Domain\City\Models\ClusterFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
