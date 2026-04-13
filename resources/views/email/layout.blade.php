<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>@yield('subject', 'Unlistened.me')</title>
    <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
    <style type="text/css">
        * { box-sizing: border-box; }
        body { margin: 0; padding: 0; background-color: #030712; }
        a[x-apple-data-detectors] { color: inherit !important; text-decoration: inherit !important; }
        #MessageViewBody a { color: inherit; text-decoration: none; }
        p { line-height: inherit; margin: 0; }
        img { border: 0; display: block; }

        @media only screen and (max-width: 620px) {
            .card       { width: 100% !important; border-radius: 0 !important; }
            .pad-outer  { padding: 0 !important; }
            .pad-header { padding: 28px 24px !important; }
            .pad-body   { padding: 28px 24px !important; }
            .pad-footer { padding: 24px !important; }
            .h1         { font-size: 22px !important; }
            .btn-link   { display: block !important; text-align: center !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#030712;">

{{-- Preheader: hidden text shown in inbox preview pane --}}
<div style="display:none;max-height:0;overflow:hidden;mso-hide:all;font-size:1px;color:#030712;line-height:1px;">
    @yield('preheader', 'Unlistened.me &mdash; Your podcast &amp; music home.')
    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
       bgcolor="#030712" style="background-color:#030712;">
    <tr>
        <td class="pad-outer" align="center" style="padding:40px 16px;">

            <!-- ═══ Card ═══ -->
            <table width="600" cellpadding="0" cellspacing="0" border="0" role="presentation" class="card"
                   style="width:600px;max-width:100%;border-radius:16px;overflow:hidden;border:1px solid #1f2937;">

                <!-- Top accent strip (indigo-600) -->
                <tr>
                    <td bgcolor="#4f46e5"
                        style="background-color:#4f46e5;height:4px;font-size:1px;line-height:4px;">&nbsp;</td>
                </tr>

                <!-- ─── Header ─── -->
                <tr>
                    <td class="pad-header" align="center" bgcolor="#0c0a2e"
                        style="background-color:#0c0a2e;padding:36px 48px 28px;">
                        <a href="https://www.unlistened.me/" target="_blank"
                           style="display:inline-block;outline:none;text-decoration:none;">
                            <img src="{{ config('app.url') }}/images/unlistened_transparen_logo_176.png"
                                 alt="Unlistened.me" width="76"
                                 style="display:block;width:76px;height:auto;border:0;margin:0 auto;"/>
                        </a>
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:18px;font-weight:700;
                                  color:#ffffff;letter-spacing:0.08em;text-transform:uppercase;
                                  margin:14px 0 5px;line-height:1.2;">
                            Unlistened<span style="color:#818cf8;">.me</span>
                        </p>
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;
                                  color:#4f46e5;margin:0;letter-spacing:0.05em;">
                            Podcasts &amp; Music &mdash; All in one place
                        </p>
                    </td>
                </tr>

                <!-- ─── Body ─── -->
                <tr>
                    <td class="pad-body" bgcolor="#111827"
                        style="background-color:#111827;padding:40px 48px;">
                        @yield('body')
                    </td>
                </tr>

                <!-- ─── Footer ─── -->
                <tr>
                    <td class="pad-footer" align="center" bgcolor="#0c0a2e"
                        style="background-color:#0c0a2e;padding:28px 48px 32px;border-top:1px solid #1f2937;">
                        <a href="https://www.unlistened.me/" target="_blank"
                           style="display:inline-block;outline:none;text-decoration:none;margin-bottom:14px;">
                            <img src="{{ config('app.url') }}/images/unlistened_transparen_logo_176.png"
                                 alt="Unlistened.me" width="38"
                                 style="display:block;width:38px;height:auto;border:0;margin:0 auto;"/>
                        </a>
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:13px;
                                  color:#6b7280;margin:0 0 10px;line-height:1.5;">
                            <a href="mailto:support@unlistened.me"
                               style="color:#818cf8;text-decoration:none;">support@unlistened.me</a>
                            &nbsp;&middot;&nbsp;
                            <a href="https://www.unlistened.me/"
                               style="color:#818cf8;text-decoration:none;">unlistened.me</a>
                        </p>
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;
                                  color:#374151;margin:0 0 14px;line-height:1.5;">
                            <a href="https://www.instagram.com/unlistened.me/" target="_blank"
                               style="color:#374151;text-decoration:none;">Instagram</a>
                            &nbsp;&middot;&nbsp;
                            <a href="https://www.facebook.com/unlistened.me/" target="_blank"
                               style="color:#374151;text-decoration:none;">Facebook</a>
                            &nbsp;&middot;&nbsp;
                            <a href="https://x.com/unlistened_me" target="_blank"
                               style="color:#374151;text-decoration:none;">X&nbsp;/&nbsp;Twitter</a>
                            &nbsp;&middot;&nbsp;
                            <a href="https://github.com/Gian1984" target="_blank"
                               style="color:#374151;text-decoration:none;">GitHub</a>
                        </p>
                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:11px;
                                  color:#1f2937;margin:0;line-height:1.5;">
                            &copy;{{ date('Y') }} Unlistened.me &mdash; All rights reserved.
                        </p>
                    </td>
                </tr>

            </table>
            <!-- ═══ /Card ═══ -->

        </td>
    </tr>
</table>

</body>
</html>
