{{-- resources/views/emails/admin_reply.blade.php (PC Forge Style) --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reply: {{ $originalMessage->subject }}</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); overflow: hidden; }
        .header { background-color: #dc3545; color: white; padding: 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; line-height: 1.6; color: #333; }
        .quote { margin: 20px 0; padding: 15px; border-left: 5px solid #007bff; background-color: #e9f5ff; }
        .footer { background-color: #f4f4f4; color: #777; padding: 20px; text-align: center; font-size: 12px; border-top: 1px solid #eee; }
        .btn-reply { display: inline-block; padding: 10px 20px; margin-top: 15px; background-color: #007bff; color: white !important; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }} Support Team</h1>
        </div>
        <div class="content">
            <p>Dear **{{ $originalMessage->name }}**, </p>
            
            <p>Salamat sa pagkontak sa amin. Narito ang tugon sa iyong katanungan:</p>

            <div class="quote">
                {{-- Ang Reply Content mo --}}
                <p style="white-space: pre-line;">{!! nl2br(e($replyData['reply_message'])) !!}</p>
            </div>
            
            <p>Kung kailangan mo pa ng anumang tulong, huwag mag-atubiling tumugon sa email na ito.</p>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 25px 0;">

            <p style="font-size: 14px; color: #555;">**Original Message Details:**</p>
            <blockquote style="margin: 0 0 10px 0; padding-left: 15px; border-left: 3px solid #ccc; font-size: 13px; color: #666;">
                **Subject:** {{ $originalMessage->subject }} <br>
                **Received:** {{ $originalMessage->created_at->format('M d, Y h:i A') }} <br>
                **Message:** {{ Str::limit($originalMessage->message, 150) }}
            </blockquote>

        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved. <br>
            *Please do not reply directly to this automated notification.*
        </div>
    </div>
</body>
</html>