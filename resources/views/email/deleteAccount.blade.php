@extends('email.layout')

@section('subject', 'Your account has been deleted — Unlistened.me')

@section('preheader', 'Your Unlistened.me account has been permanently deleted as requested. All data has been removed.')

@section('body')

<!-- Title -->
<p class="h1" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;font-weight:700;
                     color:#f9fafb;margin:0 0 16px;line-height:1.3;">
    Goodbye, {{ $user->name }}.
</p>

<!-- Main text -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#d1d5db;
          line-height:1.75;margin:0 0 28px;">
    Your account has been permanently deleted as requested. All your data has been removed from our servers.
</p>

<!-- Label -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:700;
          color:#4f46e5;text-transform:uppercase;letter-spacing:0.1em;margin:0 0 8px;">
    Data removed
</p>

<!-- ─── Checklist block ─── -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       style="margin:0 0 32px;">
    <tr>
        <td bgcolor="#1f2937" style="background-color:#1f2937;padding:16px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation">
                <tr>
                    <td style="padding:5px 0;">
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;
                                  color:#d1d5db;margin:0;line-height:1.45;">
                            <span style="color:#4f46e5;font-weight:700;">&#10003;</span>
                            &nbsp;&nbsp;Saved podcasts &amp; favourites
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px 0;">
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;
                                  color:#d1d5db;margin:0;line-height:1.45;">
                            <span style="color:#4f46e5;font-weight:700;">&#10003;</span>
                            &nbsp;&nbsp;Episode bookmarks
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px 0;">
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;
                                  color:#d1d5db;margin:0;line-height:1.45;">
                            <span style="color:#4f46e5;font-weight:700;">&#10003;</span>
                            &nbsp;&nbsp;Music playlists &amp; liked tracks
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:5px 0;">
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;
                                  color:#d1d5db;margin:0;line-height:1.45;">
                            <span style="color:#4f46e5;font-weight:700;">&#10003;</span>
                            &nbsp;&nbsp;Listening history &amp; account data
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- Farewell -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#d1d5db;
          line-height:1.75;margin:0 0 16px;">
    We hope your time with us was enjoyable. If you ever change your mind, you're always welcome back.
</p>
<p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#9ca3af;
          line-height:1.75;margin:0 0 28px;">
    Have feedback on how we can improve?
    <a href="mailto:support@unlistened.me?subject=Feedback"
       style="color:#818cf8;text-decoration:none;">Let us know</a> &mdash; we'd love to hear it.
</p>

<!-- Footer note -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#4b5563;
          line-height:1.6;margin:0;border-top:1px solid #1f2937;padding-top:20px;">
    This is an automated confirmation of your account deletion request at Unlistened.me.
</p>

@endsection
