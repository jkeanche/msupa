<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkizaTune extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'download_instructions',
        'mp3_file_path',
        'is_active',
    ];
    
    protected $casts = [
        'download_instructions' => 'array',
        'is_active' => 'boolean',
    ];
    
    public function getDownloadInstructionsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
    
    public function setDownloadInstructionsAttribute($value)
    {
        $this->attributes['download_instructions'] = $value ? json_encode($value) : null;
    }
}
