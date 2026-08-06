<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Contact Message - Admin Notification</title>
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #F4F6F8; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #F4F6F8;">

    @php
        $userName = is_array($contact) ? ($contact['name'] ?? 'N/A') : ($contact->name ?? 'N/A');
        $userSubject = is_array($contact) ? ($contact['subject'] ?? 'N/A') : ($contact->subject ?? 'N/A');
        $userMessage = is_array($contact) ? ($contact['message'] ?? 'N/A') : ($contact->message ?? 'N/A');
        $userEmail = is_array($contact) ? ($contact['email'] ?? 'N/A') : ($contact->email ?? 'N/A');
        $userPhone = is_array($contact) ? ($contact['phone'] ?? 'N/A') : ($contact->phone ?? 'N/A');
        $dateFormatted = now()->format('M d, Y \a\t h:i A');
    @endphp

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F4F6F8; padding: 40px 0;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="width: 600px; max-width: 600px; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); border: 1px solid #EAEFF2;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 24px 30px; background-color: #264653; color: #ffffff;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td>
                                        <span style="font-size: 20px; font-weight: 800; color: #ffffff;">FoodBox <span style="color: #2A9D8F;">NG</span> Admin</span>
                                    </td>
                                    <td align="right">
                                        <span style="background-color: #E76F51; color: #ffffff; font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 4px 10px; border-radius: 6px;">New Ticket</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="margin: 0 0 10px 0; color: #264653; font-size: 20px;">New Contact Form Message</h2>
                            <p style="margin: 0 0 20px 0; font-size: 14px; color: #6B7280;">You received a new inquiry from the website contact form.</p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F8FAF9; border-radius: 12px; border: 1px solid #EAEFF2; padding: 20px; margin-bottom: 20px;">
                                <tr>
                                    <td style="padding-bottom: 10px; font-size: 14px; color: #264653;"><strong>Name:</strong> {{ $userName }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 10px; font-size: 14px; color: #264653;"><strong>Email:</strong> <a href="mailto:{{ $userEmail }}" style="color: #2A9D8F;">{{ $userEmail }}</a></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 10px; font-size: 14px; color: #264653;"><strong>Phone:</strong> {{ $userPhone }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 10px; font-size: 14px; color: #264653;"><strong>Subject:</strong> {{ $userSubject }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; color: #264653;"><strong>Date:</strong> {{ $dateFormatted }}</td>
                                </tr>
                            </table>

                            <div style="font-size: 14px; font-weight: 700; color: #264653; margin-bottom: 8px;">Message Content:</div>
                            <div style="background-color: #ffffff; border: 1px solid #EAEFF2; border-left: 4px solid #2A9D8F; border-radius: 8px; padding: 16px; font-size: 14px; color: #374151; line-height: 22px;">
                                {{ $userMessage }}
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #F4F6F8; padding: 20px; text-align: center; border-top: 1px solid #EAEFF2; font-size: 12px; color: #94A3B8;">
                            FoodBox NG Automated System • {{ date('Y') }}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
