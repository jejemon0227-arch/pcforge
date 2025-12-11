<?php

namespace App\Http\Controllers;
// app/Http/Controllers/ContactMessageController.php

// Tiyakin na naka-import ang mga ito sa itaas:
use App\Models\ContactMessage;
use App\Mail\UserReplyMail; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Validator; 

class ContactMessageController extends Controller
{
    // ... Iba pang methods tulad ng index()...

    public function sendReply(Request $request, $id)
    {
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'reply_message' => 'required|string|min:10',
            'reply_subject' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Session::flash('error_message', 'Invalid reply: Hindi pwedeng walang laman ang reply.');
            return redirect()->back();
        }

        // 2. Hanapin ang Original Message
        $message = ContactMessage::findOrFail($id);

        try {
            // 3. Ipadala ang Email
            Mail::to($message->email)->send(new UserReplyMail($request->all(), $message));

            // 4. Success Feedback
            Session::flash('success_message', 'Reply successfully sent to ' . $message->email);
            return redirect()->back();

        } catch (\Exception $e) {
            // 5. Error Feedback (Napakahalaga nito!)
            Session::flash('error_message', 'Failed to send reply. Check your mail configuration (.env file): ' . $e->getMessage());
            return redirect()->back();
        }
    }
}