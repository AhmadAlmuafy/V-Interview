<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Events\SendMessage;

// Models
use App\Models\Chat;
use App\Models\Message;

class MessageController extends Controller{

    public function store(Request $request) {

        $rules = [
            "sender" => "required|string",
            "message" => "required|string",
            "chat_id" => "required|exists:chats,id"
        ];

        $valid = Validator::make($request -> all(), $rules);

        if (!$valid -> fails()) {

            $chat = Chat::where("id", request("chat_id"))
                            -> where("company_id", Auth::guard("CompanyApi") -> user() -> id);
            $exist = $chat -> get();

            if (count($exist) > 0) {

                $message = Message::create([
                    'sender' => request("sender"),
                    'message' => request("message"),
                    'is_read' => 0,
                    'chat_id' => request("chat_id"),
                ]);

                $message -> load(["chat" => function($query) {

                    $query -> select("id", "company_id", "developer_id");

                }]);

                $chat -> update([
                    "last_message" => now()
                ]);

                event(new SendMessage($message));

                return response() -> json([
                    "status" => "success",
                    "message" => "Message sent successfully",
                    "message" => $message
                ], 200);

            }

        } else {

            return response() -> json([
                "status" => "error",
                "messages" => $valid -> errors()
            ]);

        }

    }

}
