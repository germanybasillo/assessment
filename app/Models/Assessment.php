<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assessment_date',
        'qualification',
        'no_of_pax',
	'training_status',
        'type_of_scholar',
	'status',
	'update_awareness',
        'eltt',
        'rfftp',
        'oropfafns',
        'sopcctvr',
    ];

    /**
     * Get the user who created the assessment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}