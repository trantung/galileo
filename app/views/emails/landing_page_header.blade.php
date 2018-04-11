<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
</head>
<body style="margin: 0; padding: 0; background: #f0f0ef;">
<?php 
    $urlBorderLeft = url('/image_landing/email/border-hotline-left.png');
    $urlBorderRight = url('/image_landing/email/border-hotline-right.png');
    $urlBgTop = url('/image_landing/email/border-top-email.png');
    $urlBg = url('/image_landing/email/bgemail.jpg');
    $urlLogo = "/image_landing/email/logo2.png";
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top: 40px;padding-bottom: 35px;background:"{{ $urlBg }}" ">
    <tbody>
    <tr><td><div  style="margin:0 auto;max-width:670px;width:100%;background-image:{{url($urlBgTop)}} no-repeat #fff;height:10px;"></div></td></tr>
        <tr>
            <td>
                <table align="center" style="width:100%;max-width:670px;text-align: center;padding-top:15px;background:#fff">                           
                    <tr>
                        <td>
                            <table style="width:100%;max-width:390px;margin:0 auto">
                                <tr>
                                    <td width="20%">
                                         <img src="{{ url($urlLogo) }}">
                                    </td>
                                    <td width="80%" style="text-align: center;font-family: Arial, sans-serif;vertical-align:bottom;">
                                        <div style="color: #0072bc;font-size: 20px;font-weight: bold">HỆ THỐNG GIÁO DỤC HOCMAI</div>
                                        <div style="color:#000000;font-size:18px">Học chủ động - Sống tích cực</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        
        <tr>
            <td>
                <table style="width:100%;max-width:713px;border-collapse:collapse;margin:0 auto;text-align: center;line-height: 32px;font-family: Arial, sans-serif;font-weight: bold">
                  
                    <tr>
                        <td width="22" style="padding:0"><div style="width:22px;height:62px;background:'$urlBorderLeft' "></div></td>
                        <td style="width:100%;max-width:760px;padding:0;vertical-align:bottom;background:#fff">
                            <table style="width:100%;border-collapse:collapse">
                               
                                <tr><td style="font-size:18px;color:#fff;background:#f49321;padding:0;text-align: center;height:46px">Hotline:  <a style="color:#fff" href="tel:19006933">090.211.0033</a> </td>
                            </table>
                        </td>                  
                        <td width="22" style="padding:0"><div style="width:22px;height:62px;background:'$urlBorderRight' "></div></td>
                    </tr>
                </table>
            </td>                  
        </tr>
        
        <tr>
            <td>
                <table align="center" style="width:100%;max-width:670px;background:#ffffff;padding-top:40px;padding-left:40px;padding-right:40px;padding-bottom:40px">
                    <tbody>
                        <tr>
                            <td style="color: #0a73b7; font-family: Arial, sans-serif; font-size: 24px; text-align: center; font-weight: bold;">
                            {{ $title }}
                           </td>
                        </tr>
                        <td style="padding-bottom:30px;color: #f7a51c; font-family: Arial, sans-serif; font-size: 18px; text-align: center; font-weight: bold;font-style: italic;">{{ $content }}</td>
                        <tr>
                            <td style="padding: 0 10px 20px 10px; color: #373636; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">