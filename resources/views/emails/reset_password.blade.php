<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Your Password - FoodBox NG</title>
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
            .cta-button {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #F4F6F8; -webkit-font-smoothing: antialiased;">

    @php
        $resetUrl = url('/resetpassword?token='.$token.'&email='.$email);
        $userEmail = $email ?? '';
        $userName = 'Valued Customer';
        if (isset($user)) {
            $userName = is_array($user) ? ($user['name'] ?? 'Valued Customer') : ($user->name ?? 'Valued Customer');
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
                                            <span style="font-size: 30px; line-height: 64px;">🔑</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <h1 class="hero-title" style="margin: 0 0 10px 0; color: #ffffff; font-size: 26px; font-weight: 700; line-height: 34px; tracking-tight;">
                                            Reset Your Password
                                        </h1>
                                        <p style="margin: 0; color: #E6F4F1; font-size: 15px; line-height: 22px; font-weight: 400; max-width: 440px;">
                                            We received a request to reset the password for your FoodBox NG account.
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
                                You recently requested to reset your password for your account associated with <strong style="color: #264653;">{{ $userEmail }}</strong>. Click the button below to set up a new password:
                            </p>

                            <!-- CTA BUTTON -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetUrl }}" target="_blank" class="cta-button" style="display: inline-block; background-color: #2A9D8F; color: #ffffff; font-size: 16px; font-weight: 700; text-decoration: none; padding: 16px 36px; border-radius: 50px; box-shadow: 0 6px 18px rgba(42, 157, 143, 0.3); transition: all 0.3s ease; text-align: center;">
                                            Reset Password &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 24px 0; font-size: 13px; color: #6B7280; text-align: center;">
                                ⏱️ This link is valid for <strong>60 minutes</strong>.
                            </p>

                            <!-- SECURITY NOTICE CARD -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #FFF9F2; border-radius: 14px; border-left: 4px solid #F4A261; border-top: 1px solid #FBE9D7; border-right: 1px solid #FBE9D7; border-bottom: 1px solid #FBE9D7; padding: 18px 20px; margin-bottom: 28px;">
                                <tr>
                                    <td valign="top" style="width: 28px; padding-right: 10px;">
                                        <span style="font-size: 18px;">🔒</span>
                                    </td>
                                    <td valign="top">
                                        <p style="margin: 0 0 4px 0; font-size: 13px; font-weight: 700; color: #264653;">
                                            Didn't request a password reset?
                                        </p>
                                        <p style="margin: 0; font-size: 13px; color: #6B7280; line-height: 18px;">
                                            If you didn't create this account or request a password reset, you can safely ignore this email. Your password will remain unchanged and secure.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- RAW URL FALLBACK -->
                            <div style="background-color: #F8FAF9; border-radius: 12px; padding: 16px; border: 1px solid #EAEFF2; margin-bottom: 24px;">
                                <p style="margin: 0 0 8px 0; font-size: 12px; color: #6B7280; font-weight: 600;">
                                    Having trouble with the button above? Copy and paste this URL into your browser:
                                </p>
                                <p style="margin: 0; font-size: 12px; color: #2A9D8F; word-break: break-all; font-family: monospace;">
                                    <a href="{{ $resetUrl }}" style="color: #2A9D8F; text-decoration: underline;">{{ $resetUrl }}</a>
                                </p>
                            </div>

                            <!-- Sign Off -->
                            <div style="padding-top: 20px; border-top: 1px solid #F0F4F6;">
                                <p style="margin: 0; font-size: 14px; color: #4B5563; line-height: 20px;">
                                    Thank you,<br>
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
                    This is an automated security notification. Please do not reply directly to this email address.
                </p>

            </td>
        </tr>
    </table>

</body>
</html>