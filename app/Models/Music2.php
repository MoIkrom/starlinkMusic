<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $table = 'artist';
    protected $fillable = ['ArtistName', 'PackageName', 'ImageURL', 'price', 'SampleURL', 'ReleaseDate'];

}
