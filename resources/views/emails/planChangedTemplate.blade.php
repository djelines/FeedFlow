<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de Forfait</title>
    <style>
        body { margin: 0; padding: 0; width: 100%; background-color: #f3f4f6; -webkit-font-smoothing: antialiased; word-break: break-word; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }

        .main-container { border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); overflow: hidden; }
        .footer-padding { padding: 25px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; background-color: #f9fafb; }
        .logo-color { background-color: #4f46e5; }

        @media only screen and (max-width: 600px) {
            .main-container { width: 100% !important; border-radius: 0 !important; }
            .content-padding { padding: 30px 20px !important; }
            .header-padding { padding: 20px !important; }
            .mobile-full-width { width: 100% !important; display: block !important; text-align: center !important; }
        }
    </style>
</head>

<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #374151; background-color: #f3f4f6; margin: 0;">

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6; padding: 40px 0;">
    <tr>
        <td align="center">
            <table class="main-container" width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff;">

                <tr>
                    <td class="header-padding" align="center" style="padding: 30px 40px 0 40px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="padding-right: 10px;">
                                    <div class="logo-color" style="width: 24px; height: 24px; border-radius: 50%;"></div>
                                </td>
                                <td style="color: #111827; font-size: 20px; font-weight: 700; letter-spacing: -0.5px;">
                                    Sonde Urinaire
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td class="content-padding" style="padding: 40px;">

                        <div style="text-align: center; margin-bottom: 25px;">
                            <span style="font-size: 48px;">💳</span>
                        </div>

                        <h1 style="margin-top: 0; margin-bottom: 20px; color: #111827; font-size: 24px; font-weight: 800; text-align: center; line-height: 1.3;">
                            Changement de forfait
                        </h1>

                        <p style="margin-bottom: 20px; color: #4b5563; font-size: 16px; text-align: left;">
                            Bonjour,
                        </p>

                        <p style="margin-bottom: 30px; color: #4b5563; font-size: 16px; text-align: left;">
                            Le forfait de votre organisation <strong style="color: #111827;">{{ $organization->name }}</strong> a été modifié.
                        </p>

                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #eef2ff; border-radius: 8px; border: 1px solid #c7d2fe; margin-bottom: 35px;">
                            <tr>
                                <td style="padding: 30px 25px;">
                                    <p style="margin: 0; color: #4b5563; font-size: 16px; line-height: 1.8;">
                                        Ancien forfait : <strong style="color: #4f46e5;">{{ $oldPlan }}</strong><br>
                                        Nouveau forfait : <strong style="color: #4f46e5;">{{ $newPlan }}</strong>
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <p style="margin-top: 0; margin-bottom: 30px; color: #4b5563; font-size: 16px; text-align: left;">
                            Merci de votre confiance.
                        </p>

                        <p style="margin-top: 20px; margin-bottom: 0; font-size: 14px; color: #9ca3af; text-align: center;">
                            <em style="font-style: normal; color: #6b7280;">L'équipe Sonde Urinaire</em>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td class="footer-padding" align="center">
                        <p style="margin: 0; line-height: 1.5; max-width: 400px;">
                            Vous recevez cet email car il concerne une modification de votre abonnement.
                            <br><br>
                            © {{ date('Y') }} <strong>Sonde Urinaire</strong>. Tous droits réservés.
                        </p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
