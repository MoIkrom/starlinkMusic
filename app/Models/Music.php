<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $table = 'artist';
    protected $fillable = [
        'PackageName',
        'ArtistName',
        'price',
        'ReleaseDate',
        'SampleURL',
        'ImageURL',
    ];

    public static function rules()
    {
        return [
            'PackageName' => 'required|string|max:100',
            'ArtistName' => 'required|string|max:100',
            'price' => 'required|numeric|max:100',
            'ReleaseDate' => 'required|date',
            'SampleURL' => 'nullable|string|max:255',
            'ImageURL' => 'nullable|string|max:255',
        ];
    }
}
