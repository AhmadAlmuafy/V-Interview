<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Chat;

class Message extends Model {

    use HasFactory;

    protected $guarded = [];

    public function chat() {

        return  $this -> belongsTo(Chat::class, "chat_id", "id");

    }

}
