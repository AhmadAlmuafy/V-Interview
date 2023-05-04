<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Chat;

class ChatController extends Controller {

    public function index() {

        $chats = Chat::with(["developer" => function($query) {
            $query -> select("id", "full_name", "photo", "active");
        }])
        -> withCount(["messages" => function($query) {
            $query -> where("is_read", 0);
        }])
        -> where("company_id", Auth::guard("CompanyApi") -> user() -> id)
        -> orderBy("last_message", "DESC")
        -> get();

        foreach($chats as $chat) {
            $chat -> load("chat_last_message");
        }

        return response() -> json([
            "status" => "success",
            "chats" => $chats
        ], 200);

    }

    public function show($id) {

        $chat = Chat::with(["messages" => function($query) {
                        $query -> orderBy("created_at", "ASC");
                    }])
                    -> where("id", $id)
                    -> where("company_id", Auth::guard("CompanyApi") -> user() -> id)
                    -> get();

        return response() -> json([
            "status" => "success",
            "chat" => $chat
        ], 200);

    }

    public function destroy($id) {



    }

}
