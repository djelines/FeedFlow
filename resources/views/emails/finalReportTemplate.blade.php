<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondage Terminé</title>
    <style>
        /* === RESET ET BASES === */
        body { margin: 0; padding: 0; width: 100%; background-color: #f3f4f6; -webkit-font-smoothing: antialiased; word-break: break-word; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        
        /* === BOUTON HOVER === */
        .btn-primary:hover { background-color: #3730a3 !important; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important; }

        /* === MOBILE RESPONSIVE === */
        @media only screen and (max-width: 600px) {
            .main-container { width: 100% !important; border-radius: 0 !important; }
            .content-padding { padding: 30px 20px !important; }
            .header-padding { padding: 20px !important; }
            .mobile-full-width { width: 100% !important; display: block !important; text-align: center !important; }
            .date-block { display: block !important; margin-bottom: 10px !important; }
        }
    </style>
</head>

<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #374151; background-color: #f3f4f6; margin: 0;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <table class="main-container" width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); overflow: hidden;">
                    
                    <tr>
                        <td class="header-padding" align="center" style="padding: 30px 40px 0 40px;">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-right: 10px;">
                                        <div style="width: 24px; height: 24px; background-color: #4f46e5; border-radius: 50%;"></div>
                                    </td>
                                    <td style="color: #111827; font-size: 20px; font-weight: 700; letter-spacing: -0.5px;">
                                        {{ config('app.name') }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="content-padding" style="padding: 40px;">
                            
                            <div style="text-align: center; margin-bottom: 25px;">
                                <span style="font-size: 48px;">🏆</span>
                            </div>

                            <h1 style="margin-top: 0; margin-bottom: 20px; color: #111827; font-size: 24px; font-weight: 800; text-align: center; line-height: 1.3;">
                                Sondage terminé !
                            </h1>
                            
                            <p style="margin-bottom: 30px; color: #4b5563; font-size: 16px; text-align: center;">
                                Bonjour <strong>{{ $userName }}</strong>,<br>
                                Votre sondage a atteint sa date de fin. Voici le bilan final.
                            </p>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #eef2ff; border-radius: 8px; border: 1px solid #c7d2fe; margin-bottom: 35px;">
                                <tr>
                                    <td style="padding: 30px 25px; text-align: center;">
                                        
                                        <span style="display: block; color: #4338ca; font-size: 18px; font-weight: 700; margin-bottom: 10px;">
                                            {{ $survey->title }}
                                        </span>
                                        
                                        <span style="display: block; color: #111827; font-weight: 800; font-size: 42px; line-height: 1; margin-bottom: 5px;">
                                            {{ $surveyAnswersCount }}
                                        </span>
                                        <span style="display: block; color: #6b7280; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 25px;">
                                            Participants au total
                                        </span>

                                        <div style="height: 1px; background-color: #c7d2fe; width: 80%; margin: 0 auto 20px auto;"></div>

                                        <div style="margin-bottom: 20px;">
                                            <p style="margin: 0 0 10px 0; font-size: 11px; text-transform: uppercase; color: #6b7280; font-weight: 700; letter-spacing: 0.5px;">
                                                Période d'activité
                                            </p>
                                            
                                            <span class="date-block" style="display: inline-block; background-color: #ffffff; padding: 6px 12px; border-radius: 6px; border: 1px solid #c7d2fe; font-size: 14px; color: #374151; font-weight: 500;">
                                                🚀 {{ \Carbon\Carbon::parse($survey->start_date)->format('d/m/Y') }}
                                            </span>
                                            
                                            <span style="color: #6b7280; padding: 0 5px; font-weight: bold;">&rarr;</span>
                                            
                                            <span class="date-block" style="display: inline-block; background-color: #ffffff; padding: 6px 12px; border-radius: 6px; border: 1px solid #c7d2fe; font-size: 14px; color: #374151; font-weight: 500;">
                                                🏁 {{ \Carbon\Carbon::parse($survey->end_date)->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        
                                        <div style="display: inline-block; background-color: #fef2f2; padding: 4px 10px; border-radius: 9999px; font-size: 12px; color: #ef4444; border: 1px solid #fecaca; font-weight: 700;">
                                            Clôturé
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <a href="http://localhost:8000/organizations" class="btn-primary mobile-full-width" style="display: inline-block; padding: 16px 36px; background-color: #4f46e5; color: #ffffff; text-decoration: none; border-radius: 9999px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1); transition: all 0.2s ease-in-out;">
                                            Consulter le rapport final &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="margin-top: 20px; margin-bottom: 0; font-size: 14px; color: #9ca3af; text-align: center;">
                                Merci d'utiliser notre plateforme.<br>
                                <em style="font-style: normal; color: #6b7280;">L'équipe {{ config('app.name') }}</em>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #f9fafb; padding: 25px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; line-height: 1.5; max-width: 400px;">
                                Ce sondage est désormais fermé aux nouvelles réponses.
                                <br><br>
                                © {{ date('Y') }} <strong>{{ config('app.name') }}</strong>. Tous droits réservés.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>