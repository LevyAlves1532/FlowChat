<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>{{ $title ?? 'Template E-mail' }}</title>
        <style>
            /* Fonts e reset básico (alguns clientes ignoram) */
            body,table,td,a{ -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
            table,td{ mso-table-lspace:0pt; mso-table-rspace:0pt; }
            img{ -ms-interpolation-mode:bicubic; }
            img{ border:0; height:auto; line-height:100%; outline:none; text-decoration:none; }
            a[x-apple-data-detectors] { color:inherit !important; text-decoration:none !important; }
            /* Responsivo */
            @media screen and (max-width:600px){
                .wrapper { width:100% !important; }
                .mobile-center { text-align:center !important; }
                .stack { display:block !important; width:100% !important; }
                .hero-pad { padding:24px !important; }
                .content { padding: 20px !important; }
                .large-title { font-size:22px !important; line-height:28px !important; }
            }
        </style>
    </head>
    <body style="margin:0; padding:0; background-color:#f7f9fb; font-family: 'Helvetica Neue', Arial, sans-serif; color:#333333;">
        <!-- Container principal -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" style="padding:28px 10px;">
                    <!-- Wrapper -->
                    <table class="wrapper" border="0" cellpadding="0" cellspacing="0" width="600" style="width:600px; max-width:600px; background:#ffffff; border-radius:6px; overflow:hidden;">
                        <!-- Header com logo -->
                        <tr>
                            <td align="center" style="padding:28px 20px 10px;">
                                <p style="color: #00a6ff; font-weight: 600; font-size: 24px;">FlowChat</p>
                            </td>
                        </tr>

                        <!-- Ícone de celebração -->
                        <tr>
                            <td align="center" style="padding:10px 20px 0;">
                                <!-- substitua por SVG inline ou imagem real -->
                                <div style="font-size:36px; line-height:36px; color:#1da1f2;">@yield('icon')</div>
                            </td>
                        </tr>

                        @yield('body')
                    </table>
                    <!-- /Wrapper -->
                </td>
            </tr>
        </table>
    </body>
</html>
