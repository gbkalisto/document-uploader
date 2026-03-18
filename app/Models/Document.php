<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['user_id ', 'user_id', 'title', 'file_path', 'file_type', 'file_size', 'status', 'admin_remarks'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
