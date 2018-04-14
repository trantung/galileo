
<!DOCTYPE html>
<html id="html" lang="vi" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Đăng ký Kiểm tra đánh giá lực vào 6 và thi thử vào 10</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" itemprop="inLanguage" content="vi"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ HTML::style('landing_page/css/style.css') }}
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  -->
        {{ HTML::script('landing_page/js/jquery.min.js') }}
    </head>
    <body>
        {{-- @if(Session::has('message')) --}}
            <div id="pupup"  class="pupup">
                <div  class="pupup_con">
                    <span id="close">X</span>
                </div>
            </div>
        {{-- @endif --}}

        <div class="container_body">
                <header>
                    <div class="header">
                        <div class="logo"></div>
                        <div class="host_line impact float_right">
                            <p>Hotline:<span>090.211.0033</span></p>
                        </div>
                        <!-- open header -->
                        <div class="header_register">
                            <a href="#"><img class="div" src="/image_landing/thong bao.png" > </a>
                            <img  class="div notebook"  src="/image_landing/sach1.png" >

                            <div class="vao">
                                <span>v</span>
                                <span>à</span>
                                <span>o</span>
                                <span class="six">6</span>
                            </div>
                            <div class="header_ten">
                                <img class="div"  src="/image_landing/thi_thu.png" >
                                <span  class="impact ten">10</span>
                            </div>
                        </div>
                                                                                    <!-- end header_register -->
                        <div class="thanh"><!--  hai thanh ngang nhỏ  -->
                            <img src="/image_landing/thanh1.png" >
                            <img src="/image_landing/thanh2.png" >
                        </div>
                    </div>
                </header>
                <?php
                    $pattern = '^([01][0-9][0-9]|2[0-4][0-9]|9999999999[0-9])$';
                ?>
                <!-- open sidebar -->
                                                                                    <!-- end sidebar -->
                <content>
                    {{ Form::open(array('action' => 'LandingPageController@store')) }}
                        {{ Form::hidden('utm_source', $utmSource) }}
                        {{ Form::hidden('utm_medium', $utmMedium) }}
                        {{ Form::hidden('utm_campaign', $utmCampaign) }}
                        {{ Form::hidden('utm_term', $utmTerm) }}
                        {{ Form::hidden('landing_id', 1) }}
                        <div class="container">
                            <h3 class="text-chanform margin text-center personal">thông tin cá nhân</h3>
                            <div class="mation">
                                <div class="thongtin float_left">
                                    <label>Họ và tên bố/mẹ :<input type="text" name="parent_name" ></label><br><br>
                                    <label>Họ và tên con : <input type="text" name="fullname" ></label><br><br>

                                    <label>Số điện thoại :
                                    @if($errors->any())
                                        {{$errors->first()}}
                                    @endif
                                        <input type="text" name="phone" id="phone">
                                    </label>
                                </div>
                                <div class="thongtin float_right">
                                    <label> Email :<input type="email" name="email" ></label><br><br>
                                    <label> Con học lớp :</label>
                                    {{ Form::select('class', [ '' => 'Chọn lớp', 5 => 'LỚP 5', 9 => 'LỚP 9'], '') }}
                                </div>
                            </div><!--  hêt phần thông tin cá nhân -->

                            <h3 class=" margin clear-both text-center tilecheck"> <!-- chon đợt thi muốn tham gia--> </h3>
                            <div  class="#">
                                <div class="checkbox float_left">
                                    <div class="check">
                                        <input type="checkbox" name="period_1" class="checkbox" checked="checked">
                                        <label for="checkbox" ><span></span><b>{{ CommonLanding::getPeriod('period_1') }}</b></label>
                                    </div>
                                    <div class="check">
                                        <input type="checkbox" name="period_2" class="checkbox">
                                        <label for="checkbox" ><span></span><b> {{ CommonLanding::getPeriod('period_2') }}</b></label>
                                    </div>
                                </div>

                                <div class="checkbox float_right">
                                    <div class="check">
                                        <input type="checkbox" name="period_3" class="checkbox">
                                        <label for="checkbox"> <span></span><b> {{ CommonLanding::getPeriod('period_3') }}</b></label>
                                    </div>
                                    <div class="check">
                                        <input type="checkbox" name="period_4" class="checkbox">
                                        <label for="checkbox"><span></span><b>{{ CommonLanding::getPeriod('period_4') }}</b></label>
                                    </div>
                                </div>
                            </div> <!-- hêt phần chọn đợt thi muôn tham gia -->

                            <h3 class=" margin clear-both text-center contest"> <!-- chọn diềm đăng ký dự thi --></h3>
                            <div class="center" >
                                <div class="checkradio">
                                    <input type="radio" name="address" value="1" class="radio" checked="=checked">
                                    <label for="radio"  class="radio"><span class="checkmark"></span><b>Cơ sở 1: Tòa nhà 25T2 Nguyễn Thị Thập, Trung Hòa, Cầu Giấy, Hà Nội;</b></label>
                                </div>
                                <div class="checkradio">
                                    <input type="radio" name="address" value="2" class="radio">
                                    <label for="radio" class="radio"><span class="checkmark"></span><b>Cơ sở 2: 79 Văn Phúc, Văn Quán, Hà Đông, Hà Nội;</b></label>

                                </div>

                                <div class="checkradio">
                                    <input type="radio" name="address" value="3" class="radio">
                                     <label for="radio"  class="radio"><span class="checkmark"></span><b>Cơ sở 3: 19D TT5 Khu đô thị Tây Nam Linh Đàm, Hoàng Liệt, Hoàng Mai, Hà Nội;</b></label>

                                </div>

                                <div class="checkradio">
                                    <input type="radio" name="address" value="4" class="radio">
                                    <label for="radio"  class="radio"><span class="checkmark"></span><b>Cơ sở 4: T11SO02 chung cư T11 Times City, 458 Minh Khai, Hai Bà Trưng, Hà Nội.</b></label>

                                </div>
                            </div><!-- hết phần chọn điểm đăng ký dự thi -->
                        </div> <!-- hết container trên -->

                        <article>   <!-- //lựa chọn môn thi -->
                            <div class="check_subject_name" >
                                <div class="check_subject_right float_right">
                                    <div class="subject">
                                        <div class="check_subject">
                                            <input id="subject" type='radio' name="check_subject" value="1" checked="checked" > 
                                            <label for="subject">Toán (Toán &amp; KHTN đối với lớp 5) </label>
                                        </div>
                                        <div class="check_subject">
                                            <input id="subject1"  type='radio' name="check_subject" value="2">
                                            <label for="subject1">Văn (Tiếng Việt và KHXH đối với lớp 5 ) </label>
                                        </div>
                                        <div class="check_subject">
                                            <input  id="subject2" type='radio' name="check_subject" value="3">
                                            <label for="subject2" >Cả hai môn </label>

                                        </div>

                                    </div>
                                </div>
                            </div> <!--bên phải -->

                            <div class="select float_left">
                                <div class="check_subject_left float_left">
                                    <div class="book">
                                        <img src="/image_landing/i_notebook.png">
                                        <h2 class="text-chanform">lựa chọn</h2>
                                        <h2 class="text-chanform">môn thi</h2>
                                    </div>
                                </div>
                            </div> <!-- bên trái -->
                        </article><!--  hêt phần lựa chọn môn thi    -->

                        <div class="thanh1 clear-both"><!--  hai thanh ngang nhỏ  -->
                            <img src="/image_landing/thanh1.png" >
                            <img src="/image_landing/thanh2.png" >
                        </div>
                        <div><!--  câu hỏi có hay không -->
                            <div class="cau_hoi margin">

                                <h2 class="text-chanform blue" > bạn có đang học tại</h2>
                                <h2 class="text-chanform yellow"> trung tâm học chủ động galileo không ?</h2>
                                <div class="question">

                                        <div class="radio_click">
                                            <label class="check_radio">Có
                                              <input type="radio" checked="checked" name="status" value="1">
                                              <span class="checkmark"></span>
                                            </label>
                                            <label class="check_radio">Không
                                              <input type="radio" name="status" value="2">
                                              <span class="checkmark"></span>
                                            </label>
                                        </div>
                                </div>
                            </div>
                        </div><!--  hết câu hỏi -->
                        <article>
                            <div  class="article_left">             <!-- bên trái  -->
                                <h3 class=" text-chanform"> bạn có nguyện vọng</h3>
                                <h1 class="impact"><i>cho con</i></h1>
                                <h2><!--  <i>thi vào trường nào ?</i> --></h2>
                            </div>
                            <div  class="article_right float_right"> <!-- bên phải -->
                                {{ Form::textarea('comment', '', array('cols' => 30, 'rows' => 5)) }}
                            </div>
                        </article>
                        <div class="back_gound">
                        </div>
                        <div  class="regiter" >
                            {{ Form::submit('ĐĂNG KÝ', ['class'=>'button', 'id' => 'myBtn', 'onclick' => "phonenumber(Input::get('phone'))"]) }}
                        </div>
                    {{ Form::close() }}
                    <div class ="report">
                        <div class="dem_so">
                           
                            <span><h3> nguyễn tiến dũng </h3></span>
                            <span class="text-center"> <b class="text-chanform ">vừa đăng ký </b> </span>
                        </div>

                    </div>
                </content>

                










                @if(Session::has('message'))
               
                @endif
            <div class=" thanh1 clear-both" ></div>
            <footer class="footer text-chanform">
                <p>hệ thống giáo dục hocmai - trung tâm học chủ động galieo - hotline: 090.211.0033</p>
            </footer>
        </div>
    </body>
</html>

<?php
    $timeCustom = 1523167000;
    $numberTime = 1000;
    $now = time();
    $so1 =500;
    $count = ceil(($now-$timeCustom)/$numberTime);
    $so = $so1 + $count;
?>
<script>
    $(document).ready(function () {
        $('#close').click(function(){
            $('#pupup').hide();
        })
        $('#myBtn').click(function(){
            $('#pupup').show();
        })
    })
</script>
<script>
    var numberTime =  <?php print($numberTime); ?>;
    var so = <?php print($so); ?>;
    var count = <?php print($count); ?>;
    var now = <?php print($now); ?>;
    var timeCustom = <?php print($timeCustom); ?>;
    function cong(){
        so++;
        if(so <10000000){
            document.getElementById('number').innerHTML = so;
            setTimeout('cong()', 5000  );

        }else{
             document.getElementById('munber').innerHTML =" het thoi gian";

        }
    }

    cong();

</script>
<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function phonenumber(inputtxt)
    {
        console.log(11);
        var phoneno = /^\d{10}$/;
        if(inputtxt.value.match(phoneno))
        {
          return true;
        }else{
            alert("Not a valid Phone Number");
            return false;
        }
    }
</script>
