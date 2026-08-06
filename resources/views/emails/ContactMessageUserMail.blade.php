<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>We Received Your Message - FoodBox NG</title>
    <style>
        /* Mobile & Client Reset Styles */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #F4F6F8; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        
        /* Mobile Responsive Styles */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
            .content-card {
                padding: 24px 20px !important;
            }
            .hero-title {
                font-size: 22px !important;
                line-height: 28px !important;
            }
            .mobile-stack {
                display: block !important;
                width: 100% !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #F4F6F8; -webkit-font-smoothing: antialiased;">

    @php
        $userName = is_array($contact) ? ($contact['name'] ?? 'Valued Customer') : ($contact->name ?? $name ?? 'Valued Customer');
        $userSubject = is_array($contact) ? ($contact['subject'] ?? 'General Inquiry') : ($contact->subject ?? $subject ?? 'General Inquiry');
        $userMessage = is_array($contact) ? ($contact['message'] ?? '') : ($contact->message ?? $message ?? '');
        $userEmail = is_array($contact) ? ($contact['email'] ?? '') : ($contact->email ?? $email ?? '');
        $userPhone = is_array($contact) ? ($contact['phone'] ?? '') : ($contact->phone ?? $phone ?? '');
        
        $dateFormatted = now()->format('M d, Y \a\t h:i A');
        if (isset($contact)) {
            $rawDate = is_array($contact) ? ($contact['created_at'] ?? null) : ($contact->created_at ?? null);
            if ($rawDate) {
                try {
                    $dateFormatted = \Carbon\Carbon::parse($rawDate)->format('M d, Y \a\t h:i A');
                } catch (\Exception $e) {
                    $dateFormatted = now()->format('M d, Y \a\t h:i A');
                }
            }
        }
    @endphp

    <!-- Outer Wrapper -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F4F6F8; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <!-- Container Card (600px Max) -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="email-container" style="width: 600px; max-width: 600px; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); border: 1px solid #EAEFF2;">
                    
                    <!-- BRAND HEADER -->
                    <tr>
                        <td align="center" style="padding: 32px 30px 24px 30px; background-color: #ffffff; border-bottom: 1px solid #F0F4F6;">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" valign="middle">
                                        <!-- Leaf Badge Logo -->
                                        <table border="0" cellpadding="0" cellspacing="0" style="display: inline-block;">
                                            <tr>
                                                <td style="width: 42px; height: 42px; background-color: #2A9D8F; border-radius: 12px; text-align: center; vertical-align: middle; color: #ffffff; font-size: 20px; font-weight: bold; line-height: 42px;">
                                                    🍃
                                                </td>
                                                <td style="padding-left: 12px; text-align: left;">
                                                    <span style="font-size: 26px; font-weight: 800; color: #264653; letter-spacing: -0.5px; font-family: 'Plus Jakarta Sans', sans-serif;">
                                                        FoodBox <span style="color: #2A9D8F;">NG</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- HERO BANNER -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #264653 0%, #2A9D8F 100%); padding: 40px 30px; text-align: center;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <!-- Icon Badge -->
                                        <div style="display: inline-block; background-color: rgba(255, 255, 255, 0.15); width: 64px; height: 64px; border-radius: 50%; line-height: 64px; text-align: center; margin-bottom: 16px; border: 1px solid rgba(255, 255, 255, 0.25);">
                                            <span style="font-size: 30px; line-height: 64px;">📩</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <h1 class="hero-title" style="margin: 0 0 10px 0; color: #ffffff; font-size: 26px; font-weight: 700; line-height: 34px; tracking-tight;">
                                            We Received Your Message!
                                        </h1>
                                        <p style="margin: 0; color: #E6F4F1; font-size: 15px; line-height: 22px; font-weight: 400; max-width: 440px;">
                                            Thank you for reaching out to FoodBox NG. Our support team is already reviewing your inquiry.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- BODY CONTENT -->
                    <tr>
                        <td class="content-card" style="padding: 36px 36px 28px 36px;">
                            
                            <!-- Personal Greeting -->
                            <p style="margin: 0 0 16px 0; font-size: 17px; font-weight: 700; color: #264653; line-height: 24px;">
                                Hello {{ $userName }},
                            </p>

                            <p style="margin: 0 0 24px 0; font-size: 15px; color: #4B5563; line-height: 24px;">
                                Thanks for contacting us! We wanted to confirm that we’ve received your submission. One of our dedicated team members will review your message and get back to you within <strong style="color: #264653;">24 business hours</strong>.
                            </p>

                            <!-- MESSAGE SUMMARY BOX -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F8FAF9; border-radius: 16px; border-left: 4px solid #2A9D8F; border-top: 1px solid #EAEFF2; border-right: 1px solid #EAEFF2; border-bottom: 1px solid #EAEFF2; margin-bottom: 30px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 24px;">
                                        
                                        <!-- Header line -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 16px;">
                                            <tr>
                                                <td align="left">
                                                    <span style="display: inline-block; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #2A9D8F; background-color: #E6F4F1; padding: 4px 10px; border-radius: 6px;">
                                                        Submission Summary
                                                    </span>
                                                </td>
                                                <td align="right" style="font-size: 12px; color: #8898AA;">
                                                    {{ $dateFormatted }}
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Subject Field -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
                                            <tr>
                                                <td style="font-size: 13px; font-weight: 700; color: #264653; width: 80px;" valign="top">
                                                    Subject:
                                                </td>
                                                <td style="font-size: 14px; font-weight: 600; color: #2A9D8F;">
                                                    {{ $userSubject }}
                                                </td>
                                            </tr>
                                        </table>

                                        @if($userEmail)
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
                                            <tr>
                                                <td style="font-size: 13px; font-weight: 700; color: #264653; width: 80px;" valign="top">
                                                    Email:
                                                </td>
                                                <td style="font-size: 14px; color: #4B5563;">
                                                    {{ $userEmail }}
                                                </td>
                                            </tr>
                                        </table>
                                        @endif

                                        @if($userPhone)
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
                                            <tr>
                                                <td style="font-size: 13px; font-weight: 700; color: #264653; width: 80px;" valign="top">
                                                    Phone:
                                                </td>
                                                <td style="font-size: 14px; color: #4B5563;">
                                                    {{ $userPhone }}
                                                </td>
                                            </tr>
                                        </table>
                                        @endif

                                        <!-- Divider -->
                                        <div style="border-top: 1px dashed #E2E8F0; margin: 14px 0 16px 0;"></div>

                                        <!-- Message content quote -->
                                        <div style="font-size: 13px; font-weight: 700; color: #264653; margin-bottom: 6px;">
                                            Your Message:
                                        </div>
                                        <div style="font-size: 14px; color: #374151; line-height: 22px; font-style: italic; background-color: #ffffff; padding: 14px 16px; border-radius: 10px; border: 1px solid #EAEFF2;">
                                            "{{ $userMessage }}"
                                        </div>

                                    </td>
                                </tr>
                            </table>

                            <!-- CTA BUTTON SECTION -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 32px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/packages') }}" target="_blank" style="display: inline-block; background-color: #2A9D8F; color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 50px; box-shadow: 0 6px 18px rgba(42, 157, 143, 0.25); transition: all 0.3s ease;">
                                            Explore Our Packages &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- HELPFUL INFO / SUPPORT CARDS -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F4F6F8; border-radius: 14px; padding: 20px;">
                                <tr>
                                    <td>
                                        <p style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #264653;">
                                            Need Immediate Assistance?
                                        </p>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td class="mobile-stack" style="padding-bottom: 6px;" valign="middle">
                                                    <span style="font-size: 13px; color: #4B5563;">
                                                        📞 <strong>Phone Support:</strong> +234 800 FOOD BOX
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mobile-stack" style="padding-bottom: 6px;" valign="middle">
                                                    <span style="font-size: 13px; color: #4B5563;">
                                                        ✉️ <strong>Email:</strong> support@foodbox.ng
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mobile-stack" valign="middle">
                                                    <span style="font-size: 13px; color: #4B5563;">
                                                        ⏰ <strong>Support Hours:</strong> Mon - Sat, 8:00 AM - 6:00 PM
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Sign Off -->
                            <div style="margin-top: 32px; padding-top: 20px; border-top: 1px solid #F0F4F6;">
                                <p style="margin: 0; font-size: 14px; color: #4B5563; line-height: 20px;">
                                    Warm regards,<br>
                                    <strong style="color: #264653; font-size: 15px;">The FoodBox NG Team</strong>
                                </p>
                            </div>

                        </td>
                    </tr>

                    <!-- FOOTER SECTION -->
                    <tr>
                        <td style="background-color: #264653; padding: 30px; border-top: 3px solid #E9C46A; text-align: center;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                
                                <!-- Brand Name Footer -->
                                <tr>
                                    <td align="center" style="padding-bottom: 12px;">
                                        <span style="font-size: 20px; font-weight: 800; color: #ffffff; letter-spacing: -0.3px;">
                                            FoodBox <span style="color: #E9C46A;">NG</span>
                                        </span>
                                    </td>
                                </tr>

                                <!-- Slogan -->
                                <tr>
                                    <td align="center" style="padding-bottom: 16px;">
                                        <p style="margin: 0; font-size: 13px; color: #B0C4DE; font-style: italic;">
                                            Fresh produce and curated food packages delivered directly to your doorstep.
                                        </p>
                                    </td>
                                </tr>

                                <!-- Quick Links -->
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <a href="{{ url('/') }}" style="color: #E6F4F1; font-size: 12px; text-decoration: none; margin: 0 10px; font-weight: 600;">Home</a>
                                        <span style="color: #4A6B7C;">•</span>
                                        <a href="{{ url('/packages') }}" style="color: #E6F4F1; font-size: 12px; text-decoration: none; margin: 0 10px; font-weight: 600;">Packages</a>
                                        <span style="color: #4A6B7C;">•</span>
                                        <a href="{{ url('/contact_us') }}" style="color: #E6F4F1; font-size: 12px; text-decoration: none; margin: 0 10px; font-weight: 600;">Contact Us</a>
                                    </td>
                                </tr>

                                <!-- Address & Copyright -->
                                <tr>
                                    <td align="center" style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 16px;">
                                        <p style="margin: 0 0 6px 0; font-size: 12px; color: #94A3B8;">
                                            📍 12 Guzape hills, Abuja, FCT, Nigeria
                                        </p>
                                        <p style="margin: 0; font-size: 12px; color: #94A3B8;">
                                            &copy; {{ date('Y') }} FoodBox NG. All rights reserved.
                                        </p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>
                
                <!-- Sub-footer note -->
                <p style="margin-top: 20px; font-size: 11px; color: #94A3B8; text-align: center;">
                    This is an automated notification. Please do not reply directly to this email address.
                </p>

            </td>
        </tr>
    </table>

</body>
</html>