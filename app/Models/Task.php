<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $fillable=['title','description','long_description'];
    // protected $guarded =['password'];\
    public function toggleComplete(){
        $this->completed=!$this->completed;
        $this->save();
    }
}
