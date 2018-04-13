<!DOCTYPE html>
<html id="html" lang="vi" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>m.mobile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" itemprop="inLanguage" content="vi"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ HTML::script('landing_page/js/jquery.min.js') }}
        {{ HTML::style('landing_page/css/style_m.css') }}
        {{ HTML::style('landing_page/css/reset.css') }}
        <link rel="stylesheet" media="mediatype and|not|only (media feature)" href="url('/landing_page/css/reset.css')">
    </head>
    <body>
     
            
        <div class="container ">
            <header><!-- open header -->
                <div class="logo"></div>  
                <div class="host_line impact float_right">
                    <p>Hotline:<span>090.211.0033</span></p>
                </div>
                <div class="header_register"> 
                    <a href="#"><img class="div" src="/image_landing/image_mobile/dang_ky_thi.png" > </a>
                    <div class="vao">
                        <b>v</b>
                        <b>à</b>
                        <b>o</b>
                        <b class="six">6</b>
                    </div>
                    <div class="header_ten float_right">
                        <span  class="impact ten">10</span>
                    </div>
                </div><

            </header><!-- end header -->

            <form  action="" method="POST"> 
                <content>                
                    <div class="content">
                       
                        <h3 class="personal white">thông tin cá nhân</h3>
                        <div class="thong_tin auto">
                            <label class="in_bl">Họ và tên bố/mẹ :</label>
                            <input type="text" name="parent_name" required ><br>

                            <label>Họ và tên con : </label>
                            <input type="text" name="fullname" required ><br>

                            <label>Số điện thoại :</label>
                            <input type="text" name="phone" required ><br>
                            <span class=""></span>

                            <label> email :</label>
                            <input type="email" name="email" ><br>

                            <label> Con học lớp :</label>
                            <select>
                                <option value="5">LỚP 5</option>
                                <option value="9">LỚP 9</option>
                            </select>
                        </div><!--  hêt phần thông tin cá nhân -->

                        <h3 class="tilecheck white"> bạn có muốn đăng ký đợt thi</h3>
                        <div class="check_class">
                            <div  class="float_left">                               
                                <div class="check">
                                    <input  id= "checkbox" type="checkbox" name="period[0]"  checked="checked">
                                    <label for="checkbox"><span></span>Đợt 1 ( Lớp 5: 08/04/2018, Lớp 9: 15/04 )</label>
                                </div>
                                <div class="check">
                                    <input  id= "checkbox1" type="checkbox" name="period[1]" >
                                    <label for="checkbox1"><span></span> Đợt 2 ( Lớp 5: 22/04/2018, Lớp 9: 13/05 )</label>
                                </div>
                            </div>
                            <div  class="float_left"> 
                                <div class="check" >
                                    <input  id= "checkbox2"type="checkbox" name="period[2]" >
                                    <label for="checkbox2"> <span></span> Đợt 3 (Lớp 5: 06/05/2018,Lớp 9: 27/05 )</label>
                                </div>
                                <div class="check">
                                    <input id= "checkbox3" type="checkbox" name="period[3]" >
                                    <label for="checkbox3"><span></span>Đợt 4 ( Lớp 5: 20/05/2018) </label>
                                </div>
                            </div>   
                        </div><!-- end dang ký thi -->

                        <h3 class="address">bạn muốn thi tại</h3>


                        <div class=" center">
                            <div  class="float_left">
                                <div class="check_address">
                                    <input  id= "radio" type="radio" name ="address" value="period[0]"  checked="checked">
                                    <label for="radio"><span class="span1"></span> <b>Cơ sở 1: Tòa nhà 25T2 Nguyễn Thị Thập, Trung Hòa, Cầu Giấy, Hà Nội;</b></label>
                                </div>
                                <div class="check_address">
                                    <input  id= "radio1" type="radio" name ="address" value="period[1]" >
                                    <label for="radio1"><span ></span>   <b>Cơ sở 2: 79 Văn Phúc, Văn Quán, Hà Đông, Hà Nội;</b></label>
                                </div>
                            </div>
                        <div class="float_left">
                            <div class="check_address" >
                                <input  id= "radio2"type="radio" name ="address" value="period[2]" >
                                <label for="radio2"> <span></span> <b>Cơ sở 3: 19D TT5 Khu đô thị Tây Nam Linh Đàm, Hoàng Liệt, Hoàng Mai, Hà Nội;</b></label>
                            </div>
                            <div class="check_address">
                                <input id= "radio3" type="radio" name ="address" value="period[3]" >
                                <label for="radio3"><span class="span2"></span>  <b>Cơ sở 4: T11SO02 chung cư T11 Times City, 458 Minh Khai, Hai Bà Trưng, Hà Nội. </b> </label>
                            </div>
                        </div>
                        </div><!-- end dang ký thi -->
                        <div class="check_subject_name" >
                            <div class="check_subject_right float_right">
                                <div class="subject">
                                    <div class="check_subject">
                                        <input id="subject" type='radio' name="subject" value="0" checked="checked" > 
                                        <label for="subject">Toán (Toán &amp; KHTN đối với lớp 5) </label>
                                    </div>
                                    <div class="check_subject">
                                        <input id="subject1"  type='radio' name="subject" value="1">
                                        <label for="subject1">Văn (Tiếng Việt và KHXH đối với lớp 5 ) </label>
                                    </div>
                                    <div class="check_subject">
                                        <input  id="subject2" type='radio' name="subject" value="2">
                                        <label for="subject2" >Cả hai môn </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="select">
                            <div class="check_subject_left ">
                                <div class="book">
                                    <img src="/image_landing/image_mobile/chon_mon_thi.png">
                                </div>
                            </div>
                        </div>
                  <!--   </div> --> <!-- bên trái -->
                    <!--  câu hỏi có hay không -->
                        <div class="question_center">
                            <h2 class="text-chanform blue" > bạn có đang học tại</h2>
                            <h2 class="text-chanform yellow"> trung tâm học chủ động galileo không ?</h2>
                            <div class="question">
                                <div class="radio_click">
                                    <label class="check_radio">có
                                      <input type="radio" checked="checked" name="status" value="1">
                                      <span class="checkmark"></span>
                                    </label>
                                    <label class="check_radio">không
                                      <input type="radio" name="status" value="2">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- hết câu hỏi -->
                        <div  class="article_right"> <!-- bên phải -->
                            <textarea  cols="30"  rows="5" name="comment" form="usrform"></textarea>
                        </div>
                        <div  class="regiter" >
                            <input id="myBtn"  class="button" type="submit" name="submit" value=" ĐĂNG KÝ">
                        </div>
                    </div><!--  end conten  -->
                </content> 
            </form>
        </div>  <!-- end container --> 
        <footer>
            <div class="footter text-chanform">
                 <p class="he_thong">hệ thống giáo dục hocmai</p> 
                 <p>trung tâm học chủ động galieo - hotline: 090.211.0033</p>
            </div>
        </footer>


    </body>
</html>