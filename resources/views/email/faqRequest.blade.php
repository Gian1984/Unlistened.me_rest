@extends('email.layout')

@section('subject', 'We received your message — Unlistened.me')

@section('preheader', 'Thanks for getting in touch. Our team will review your message and reply shortly.')

@section('body')

<!-- Title -->
<p class="h1" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;font-weight:700;
                     color:#f9fafb;margin:0 0 16px;line-height:1.3;">
    Message received!
</p>

<!-- Greeting + description -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#d1d5db;
          line-height:1.75;margin:0 0 28px;">
    Hi {{ $success->username }}, thanks for getting in touch. Our team will review your message and reply
    as soon as possible &mdash; typically within 24&ndash;48 hours on business days.
</p>

<!-- Label -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:700;
          color:#4f46e5;text-transform:uppercase;letter-spacing:0.1em;margin:0 0 8px;">
    Your message
</p>

<!-- ─── Message preview block ─── -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       style="margin:0 0 28px;">
    <tr>
        <td bgcolor="#1f2937" style="background-color:#1f2937;padding:18px 20px;
                                     border-left:4px solid #4f46e5;">
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:700;
                      color:#e5e7eb;margin:0 0 10px;line-height:1.5;">
                {{ $success->message_obj }}
            </p>
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#9ca3af;
                      margin:0;line-height:1.7;">
                {{ $success->message_desc }}
            </p>
        </td>
    </tr>
</table>

<!-- Closing -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#d1d5db;
          line-height:1.75;margin:0 0 28px;">
    We'll get back to you at the email address associated with your account.
</p>

<!-- Footer note -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#4b5563;
          line-height:1.6;margin:0;border-top:1px solid #1f2937;padding-top:20px;">
    You're receiving this because you submitted a contact form at Unlistened.me.
    If this wasn't you, contact us at
    <a href="mailto:support@unlistened.me" style="color:#818cf8;text-decoration:none;">support@unlistened.me</a>.
</p>

@endsection
