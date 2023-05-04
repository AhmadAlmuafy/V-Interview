<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Message;
use App\Models\Developer;

class Chat extends Model {
    use HasFactory;

    protected $guarded = [];

    public function messages() {

        return $this -> hasMany(Message::class, "chat_id", "id");

    }

    public function chat_last_message() {

        return $this -> hasMany(Message::class, "chat_id", "id") -> orderBy("created_at", "DESC") -> limit(1);

    }

    public function developer() {

        return $this -> belongsTo(Developer::class, "developer_id", "id");

    }

}
