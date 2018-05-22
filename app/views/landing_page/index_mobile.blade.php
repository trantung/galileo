<!DOCTYPE html>
<html id="html" lang="vi" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Đăng ký Kiểm tra đánh giá năng lực vào 6 và thi thử vào 10</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" itemprop="inLanguage" content="vi"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=768; height=device-height" />


        {{ HTML::script('landing_page/js/jquery.min.js') }}
        {{ HTML::style('landing_page/css/style_m.css') }}
        {{ HTML::style('landing_page/css/reset.css') }}
        <script type="text/javascript">
            document.documentElement.addEventListener('touchstart', function(event) {
             if (event.touches.length > 1) {
               event.preventDefault();
             }
           }, false);
        </script>
        <link rel="stylesheet" media="mediatype and|not|only (media feature)" href="{{url('/landing_page/css/reset.css')}}">
    </head>
    <body>
    @if(Session::has('message'))
        <div id="popup" class="popup">
            <div  class="popup_con">
                <span id="close">X</span>
            </div>
        </div>
    @endif
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
                </div>

            </header><!-- end header -->

            {{ Form::open(array('action' => 'LandingPageController@store')) }}
            {{ Form::hidden('utm_source', $utmSource) }}
            {{ Form::hidden('utm_medium', $utmMedium) }}
            {{ Form::hidden('utm_campaign', $utmCampaign) }}
            {{ Form::hidden('utm_term', $utmTerm) }}
            {{ Form::hidden('landing_id', 1) }}
                <content>                
                    <div class="content">
                       
                        <h3 class="personal white">thông tin cá nhân</h3>
                        <div class="thong_tin auto">
                            <label class="in_bl">Họ và tên bố/mẹ :</label>
                            <input type="text" name="parent_name" ><br>

                            <label>Họ và tên con : </label>
                            <input type="text" name="fullname" required ><br>

                            <label>Số điện thoại :</label>
                            <input type="text" name="phone" required ><br>
                            <span class=""></span>

                            <label> email :</label>
                            <input type="email" name="email" required><br>

                            <label> Con học lớp :</label>
                            <select required id="test" name="class" onchange="showDiv(this)">
                                <option value="">Chọn lớp</option>
                                <option value="5">LỚP 5</option>
                                <option value="9">LỚP 9</option>
                            </select>
                        </div><!--  hêt phần thông tin cá nhân -->

                        <h3 class="tilecheck white"> bạn có muốn đăng ký đợt thi</h3>
                        <div class="check_class">

                            <div class="#" id="class5" style="display: block;">
                                <div  class="float_left">                               
                                    <div class="check">
                                        <input  id= "checkbox" type="checkbox" name="period_1">
                                        <label for="checkbox"><span></span>{{ CommonLanding::getPeriod(1) }}</label>
                                    </div>
                                    <div class="check">
                                        <input  id= "checkbox1" type="checkbox" name="period_2" >
                                        <label for="checkbox1"><span></span>{{ CommonLanding::getPeriod(2) }}</label>
                                    </div>
                                </div>
                                <div  class="float_left"> 
                                    <div class="check" >
                                        <input  id= "checkbox2"type="checkbox" name="period_3" >
                                        <label for="checkbox2"> <span></span>{{ CommonLanding::getPeriod(3) }})</label>
                                    </div>
                                    <div class="check">
                                        <input id= "checkbox3" type="checkbox" name="period_4" >
                                        <label for="checkbox3"><span></span>{{ CommonLanding::getPeriod(4) }}</label>
                                    </div>
                                </div> 
                            </div>

                            <div class="#" id="class9" style="display: none;">
                                <div  class="float_left">                               
                                    <div class="check">
                                        <input  id= "checkbox4" type="checkbox" name="period_5">
                                        <label for="checkbox4"><span></span>{{ CommonLanding::getPeriod(5) }}</label>
                                    </div>
                                    <div class="check">
                                        <input  id= "checkbox5" type="checkbox" name="period_6" >
                                        <label for="checkbox5"><span></span>{{ CommonLanding::getPeriod(6) }}</label>
                                    </div>
                                </div>
                                <div  class="float_left"> 
                                    <div class="check" >
                                        <input  id= "checkbox6"type="checkbox" name="period_7" >
                                        <label for="checkbox6"> <span></span>{{ CommonLanding::getPeriod(7) }})</label>
                                    </div>
                                </div> 
                            </div>

                        </div><!-- end dang ký thi -->

                        <h3 class="address">bạn muốn thi tại</h3>


                        <div class=" center">
                            <div  class="float_left">
                                <div class="check_address">
                                    <input  id= "radio" type="radio" name ="address" value="1" required>
                                    <label for="radio"><span class="span1"></span> <b>Cơ sở 1: Tòa nhà 25T2 Nguyễn Thị Thập, Trung Hòa, Cầu Giấy, Hà Nội;</b></label>
                                </div>
                                <div class="check_address">
                                    <input  id= "radio1" type="radio" name ="address" value="2" >
                                    <label for="radio1"><span ></span>   <b>Cơ sở 2: 79 Văn Phúc, Văn Quán, Hà Đông, Hà Nội;</b></label>
                                </div>
                            </div>
                        <div class="float_left">
                            <div class="check_address" >
                                <input  id= "radio2"type="radio" name ="address" value="3" >
                                <label for="radio2"> <span></span> <b>Cơ sở 3: 19D TT5 Khu đô thị Tây Nam Linh Đàm, Hoàng Liệt, Hoàng Mai, Hà Nội;</b></label>
                            </div>
                            <div class="check_address">
                                <input id= "radio3" type="radio" name ="address" value="4" >
                                <label for="radio3"><span class="span2"></span>  <b>Cơ sở 4: T11SO02 chung cư T11 Times City, 458 Minh Khai, Hai Bà Trưng, Hà Nội. </b> </label>
                            </div>
                        </div>
                        </div><!-- end dang ký thi -->
                        <div class="check_subject_name" >
                            <div class="check_subject_right float_right">
                                <div class="subject">
                                    <div class="check_subject">
                                        <input id="subject" type='radio' name="check_subject" value="1" required> 
                                        <label for="subject">Toán (Toán &amp; KHTN đối với lớp 5) </label>
                                    </div>
                                    <div class="check_subject">
                                        <input id="subject1"  type='radio' name="check_subject" value="2">
                                        <label for="subject1">Văn (Tiếng Việt &amp; KHXH &amp; Tiếng Anh đối với lớp 5 ) </label>
                                    </div>
                                    <div class="check_subject">
                                        <input  id="subject2" type='radio' name="check_subject" value="3">
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
                                    <label class="check_radio">Có
                                      <input type="radio" checked="checked" name="status" value="1" required>
                                      <span class="checkmark"></span>
                                    </label>
                                    <label class="check_radio">Không
                                      <input type="radio" name="status" value="2">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- hết câu hỏi -->
                        <div  class="article_right"> <!-- bên phải -->
                            {{ Form::textarea('comment', '', array('cols' => 30, 'rows' => 5)) }}
                        </div>
                        <div  class="regiter" >
                            {{ Form::submit('ĐĂNG KÝ', ['class'=>'button', 'id' => 'myBtn']) }}
                        </div>
                    </div><!--  end conten  -->
                </content> 
            {{ Form::close() }}
        </div>  <!-- end container --> 
        <footer>
            <div class="footter text-chanform">
                 <p class="he_thong">hệ thống giáo dục hocmai</p> 
                 <p>trung tâm học tập chủ động galileo - hotline: 090.211.0033</p>
            </div>
        </footer>
    </body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var elements = document.getElementsByTagName("INPUT");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("Thông tin bắt buộc phải có");
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("");
            };
        }
    })
    $(document).ready(function () {
        $('#close').click(function(){
            $('#popup').hide();
        })
        $('#myBtn').click(function(){
            $('#popup').show();
        })
    })
    function showDiv(elem){
        if(elem.value == 5) {
            document.getElementById('radio3').parentElement.style.display = "block";
            document.getElementById('class5').style.display = "block";
            document.getElementById('class9').style.display = "none";
        }
        if(elem.value == 9) {
            document.getElementById('radio3').parentElement.style.display = "none";
            document.getElementById('class9').style.display = "block";
            document.getElementById('class5' ).style.display = "none";
        }
        if(elem.value == 1) {
            document.getElementById('class5').style.display = "block";
            document.getElementById('class9').style.display = "none";
        }
    }
</script>