<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'admission_date',
        'gender',
        'dob',
        'email',
        'phone',
        'address',
        'father_name',
        'father_phone',
        'country_id',
        'course',
        'doument_text_1',
        'doument_image_1',
        'doument_text_2',
        'doument_image_2',
        'doument_text_3',
        'doument_image_3',
        'doument_text_4',
        'doument_image_4',
        'student_photo',
        'active',
        'slug',
        'branch_id'
    ];
 
    protected static function boot(){
        parent::boot();
        static::creating(function($student){
            $student->slug = Str::slug($student->first_name.' '.$student->last_name);
        });
       
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class,  'id');
    }
   

    
}
