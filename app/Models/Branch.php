<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'email', 'image', 'slug', 'password'];

    // public function student()
    // {
    //     return $this->hasMany(Student::class, 'branch_id', 'branch_id')->where('branch_id', $this->branch_id);
    // }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($branch) {
            if ($branch->user) {
                $branch->user->delete();
            }
        });

        static::creating(function ($branch) {
            $branch->slug = Str::slug($branch->name);
        });
    }
    public function students()
{
    return $this->hasMany(Student::class, 'branch_id', 'id');
}

}
