</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
            <?php 
                $urlFacebook = 'https://www.facebook.com/THCS.Tieuhoc/';
                $contentUnsub = '';
                $urlYoutube = 'https://www.youtube.com/c/HOCMAITHCS';
                $urlBgBottom = '/image_landing/email/border-bottom-email.png';   

            ?>
                <td>
                {{ $contentUnsub }}
                </td>
                <td>
                    <tr>
                        <td>
                            <table align="center" style="width:100%;max-width:670px;background: #0072bc;padding-top:11px;padding-bottom:10px;border-bottom:1px solid #bbd9ed;border-top:1px solid #bbd9ed;">
                                <tr>
                                    <td width="105"></td>
                                    <td width="60" style="color:#fff;font-size:14px;font-family: Arial, sans-serif;">Theo dõi:</td>
                                    <td width="40" style="text-align: center;">
                                        <a href="{{ $urlFacebook }}" target="_blank">
                                            <img src="{{ url('/image_landing/email/social-facebook.png') }}" alt="Facebook" style="display: inline-block;" border="0" />
                                        </a>
                                    </td>
                                    <td width="40" style="text-align: center;">
                                    <a href="{{ $urlYoutube }}" target="_blank">
                                        <img src="{{ url('/image_landing/email/social-youtube.png') }}" alt="Youtube" style="display: inline-block;" border="0" />
                                    </a>
                                    </td>
                                    <td width="94"></td>
                                    <td width="50" style="color:#fff;font-size:14px;font-family: Arial, sans-serif;">Hỗ trợ:</td>
                                    <td width="40" style="text-align: center;">
                                        <a href="https://hocmai.vn/ho-tro/" target="_blank">
                                            <img src="{{ url('/image_landing/email/help2.png') }}" alt="Help" style="display: inline-block;" border="0" />
                                        </a>
                                    </td>
                                    <td width="140"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width:100%;max-width:670px;border-collapse: collapse;background:url('http://cloud.galileo.edu.vn/image_landing/email/border-bottom-email.png') #0072bc;margin:0 auto;">
                                <tr>
                                    <td style="padding-top:15px">
                                        <div style="bottom:0;left:2px;width:100%;height:10px; no-repeat;"></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </td>               
            </tr>
        </tbody>
    </table>
    </body>
</html>