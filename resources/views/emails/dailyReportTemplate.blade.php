<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle réponse reçue</title>
    <style>
        /* Reset de base pour la compatibilité */
        body { margin: 0; padding: 0; width: 100%; background-color: #f3f4f6; }
        table { border-collapse: collapse; }
        
        /* Media Query pour mobile */
        @media only screen and (max-width: 600px) {
            .main-container { width: 100% !important; }
            .content-padding { padding: 20px !important; }
        }
    </style>
</head>


<body style="font-family: 'Helvetica', 'Arial', sans-serif; line-height: 1.6; color: #333333; background-color: #f3f4f6;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <table class="main-container" width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
                    
                    <tr>
                        <td align="center" style="background-color: #4f46e5; padding: 20px;">
                            <h1 style="color: #ffffff; font-size: 20px; margin: 0; font-weight: bold;">
                                {{ config('app.name') }}
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td class="content-padding" style="padding: 40px;">
                            <h2 style="margin-top: 0; color: #1f2937; font-size: 22px;">Bravo ! Voici votre récap quotidien. 🚀</h2>
                            
                            <p style="margin-bottom: 20px; color: #4b5563;">
                                Bonjour ,
                            </p>
                            
                            <p style="margin-bottom: 20px; color: #4b5563;">
                                Une nouvelle personne vient de compléter votre sondage : <br>
                                <strong style="color: #111827;">""</strong>.
                            </p>

                            <div style="background-color: #f9fafb; border-left: 4px solid #4f46e5; padding: 15px; margin-bottom: 25px; font-size: 14px; color: #6b7280;">
                                📅 Reçu le : {{ now()->format('d/m/Y à H:i') }}
                            </div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="padding-top: 10px; padding-bottom: 10px;">
                                        <a href="" target="_blank" style="display: inline-block; padding: 12px 30px; background-color: #4f46e5; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">
                                            Voir les résultats
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="margin-top: 30px; font-size: 14px; color: #6b7280;">
                                Continuez comme ça pour obtenir plus d'insights !<br>
                                <em style="font-style: normal;">L'équipe {{ config('app.name') }}</em>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #f9fafb; padding: 20px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0;">
                                Vous recevez cet email car vous êtes l'auteur de ce sondage.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>