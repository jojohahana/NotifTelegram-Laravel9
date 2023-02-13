<?php

namespace App\Http\Controllers;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;

use Illuminate\Http\Request;

class TelegramBotController extends Controller
{
    public function updatedActivity() {
        $activity = Telegram::getUpdates();
        dd($activity);
    }

    public function sendMessage() {
        return view('message');
    }

    public function storeMessage(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $text = "New Permit Submmited !!\n"
            . "<b>Email Address: </b>\n"
            . "$request->email\n"
            . "<b>Message: </b>\n"
            . $request->message;

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001883164282'),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return redirect()->back();
    }

    public function sendPhoto() {
        return view('photo');
    }

    public function storePhoto(Request $request) {
        $request->validate([
            'file' => 'file|mimes:jpeg,png,gif'
        ]);

        $photo = $request->file('file');

        Telegram::sendPhoto([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001883164282'),
            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), str_random(10) . '.' . $photo->getClientOriginalExtension())
        ]);

        return redirect()->back();
    }
}
