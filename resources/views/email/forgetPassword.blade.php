@extends('email.layout')

@section('subject', 'Reset your password — Unlistened.me')

@section('preheader', 'A password reset has been requested for your account. Click to set a new password.')

@section('body')

<!-- Title -->
<p class="h1" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;font-weight:700;
                     color:#f9fafb;margin:0 0 16px;line-height:1.3;">
    Reset your password
</p>

<!-- Description -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#d1d5db;
          line-height:1.75;margin:0 0 28px;">
    We received a request to reset the password for your Unlistened.me account.
    Click the button below to choose a new one.
</p>

<!-- ─── CTA Button ─── -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       style="margin:0 0 24px;">
    <tr>
        <td align="center">
            <!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                href="{{ env('FRONTEND_URL', 'https://unlistened.me') }}/reset_password/{{ $token }}"
                style="height:52px;v-text-anchor:middle;width:220px;"
                arcsize="14%" fillcolor="#4f46e5" strokecolor="#4f46e5">
            <w:anchorlock/>
            <center style="color:#ffffff;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;">Reset Password</center>
            </v:roundrect>
            <![endif]-->
            <!--[if !mso]><!-->
            <a href="{{ env('FRONTEND_URL', 'https://unlistened.me') }}/reset_password/{{ $token }}"
               target="_blank" class="btn-link"
               style="display:inline-block;background-color:#4f46e5;color:#ffffff;
                      font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:700;
                      text-decoration:none;padding:15px 44px;border-radius:8px;
                      letter-spacing:0.02em;mso-hide:all;">
                Reset Password
            </a>
            <!--<![endif]-->
        </td>
    </tr>
</table>

<!-- ─── Security info box ─── -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       style="margin:0 0 24px;">
    <tr>
        <td bgcolor="#1f2937" style="background-color:#1f2937;padding:14px 18px;
                                     border-left:3px solid #6366f1;">
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#9ca3af;
                      margin:0;line-height:1.65;">
                This link expires in
                <span style="color:#e5e7eb;font-weight:700;">60 minutes</span>.
                If you did not request a password reset, you can safely ignore this email &mdash;
                your account remains secure and no changes have been made.
            </p>
        </td>
    </tr>
</table>

<!-- Fallback URL label -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#4b5563;
          line-height:1.6;margin:0 0 4px;">
    If the button does not work, copy and paste this link into your browser:
</p>
<!-- Fallback URL -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:1.6;
          margin:0 0 24px;word-break:break-all;">
    <a href="{{ env('FRONTEND_URL', 'https://unlistened.me') }}/reset_password/{{ $token }}"
       style="color:#818cf8;text-decoration:none;">
        {{ env('FRONTEND_URL', 'https://unlistened.me') }}/reset_password/{{ $token }}
    </a>
</p>

<!-- Footer note -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#4b5563;
          line-height:1.6;margin:0;border-top:1px solid #1f2937;padding-top:20px;">
    You're receiving this because a password reset was requested for this email address at Unlistened.me.
    Questions? Write to
    <a href="mailto:support@unlistened.me" style="color:#818cf8;text-decoration:none;">support@unlistened.me</a>.
</p>

@endsection
