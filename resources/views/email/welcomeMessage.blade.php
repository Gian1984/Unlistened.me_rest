@extends('email.layout')

@section('subject', 'Welcome to Unlistened.me!')

@section('preheader', 'Your podcast &amp; music journey starts here. Explore, discover, and never miss a beat.')

@section('body')

<!-- Greeting -->
<p class="h1" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;font-weight:700;
                     color:#f9fafb;margin:0 0 18px;line-height:1.3;">
    Welcome, {{ $user->name }}!
</p>

<!-- Intro -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#d1d5db;
          line-height:1.75;margin:0 0 28px;">
    We're thrilled to have you on Unlistened.me &mdash; your new home for discovering podcasts
    and music from around the globe. Here's what's waiting for you:
</p>

<!-- ─── Feature list ─── -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       style="margin:0 0 32px;">
    <tr>
        <td bgcolor="#1f2937" style="background-color:#1f2937;padding:14px 18px;
                                     border-left:3px solid #4f46e5;">
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:700;
                      color:#e5e7eb;margin:0 0 4px;">
                Discover Podcasts
            </p>
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#9ca3af;
                      margin:0;line-height:1.55;">
                Browse thousands of shows across every category &mdash; trending, curated, and personalised for you.
            </p>
        </td>
    </tr>
    <tr><td bgcolor="#111827" style="background-color:#111827;height:8px;font-size:1px;line-height:1px;">&nbsp;</td></tr>
    <tr>
        <td bgcolor="#1f2937" style="background-color:#1f2937;padding:14px 18px;
                                     border-left:3px solid #4f46e5;">
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:700;
                      color:#e5e7eb;margin:0 0 4px;">
                Explore Music
            </p>
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#9ca3af;
                      margin:0;line-height:1.55;">
                Stream Creative Commons tracks from Jamendo. Filter by genre, save favourites, build playlists.
            </p>
        </td>
    </tr>
    <tr><td bgcolor="#111827" style="background-color:#111827;height:8px;font-size:1px;line-height:1px;">&nbsp;</td></tr>
    <tr>
        <td bgcolor="#1f2937" style="background-color:#1f2937;padding:14px 18px;
                                     border-left:3px solid #4f46e5;">
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:700;
                      color:#e5e7eb;margin:0 0 4px;">
                Pick Up Where You Left Off
            </p>
            <p style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#9ca3af;
                      margin:0;line-height:1.55;">
                Bookmarks and listening history sync across sessions &mdash; never lose your place.
            </p>
        </td>
    </tr>
</table>

<!-- ─── CTA Button ─── -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       style="margin:0 0 32px;">
    <tr>
        <td align="center">
            <!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                href="https://www.unlistened.me/"
                style="height:52px;v-text-anchor:middle;width:200px;"
                arcsize="14%" fillcolor="#4f46e5" strokecolor="#4f46e5">
            <w:anchorlock/>
            <center style="color:#ffffff;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;">Start Listening</center>
            </v:roundrect>
            <![endif]-->
            <!--[if !mso]><!-->
            <a href="https://www.unlistened.me/" target="_blank" class="btn-link"
               style="display:inline-block;background-color:#4f46e5;color:#ffffff;
                      font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:700;
                      text-decoration:none;padding:15px 44px;border-radius:8px;
                      letter-spacing:0.02em;mso-hide:all;">
                Start Listening
            </a>
            <!--<![endif]-->
        </td>
    </tr>
</table>

<!-- Footer note -->
<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#4b5563;
          line-height:1.6;margin:0;border-top:1px solid #1f2937;padding-top:20px;">
    You're receiving this because you created an account at Unlistened.me.
    Questions? Write to us at
    <a href="mailto:support@unlistened.me" style="color:#818cf8;text-decoration:none;">support@unlistened.me</a>.
</p>

@endsection
