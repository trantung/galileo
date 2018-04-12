
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
                                    <label>Họ và tên con :
                                    @if(Session::has('msg_fullname'))
                                        <font color="red">{{ Session::get('msg_fullname') }}</font>
                                    @endif
                                    <input type="text" name="fullname" ></label>
                                    <br><br>
                                    <label>Số điện thoại :
                                    @if(Session::has('msg_phone'))
                                        <font color="red">{{ Session::get('msg_phone') }}</font>
                                    @endif
                                    @if(Session::has('msg_phone_valid'))
                                        <font color="red">{{ Session::get('msg_phone_valid') }}</font>
                                    @endif
                                        <input type="text" name="phone" id="phone">
                                    </label>
                                </div>
                                <div class="thongtin float_right">
                                    <label> Email :<input type="email" name="email" required></label><br><br>
                                    <label> Con học lớp :</label>
                                    @if(Session::has('msg_class'))
                                        <font color="red">{{ Session::get('msg_class') }}</font>
                                    @endif
                                    <select id="test" name="class" onchange="showDiv(this)">
                                        <option value="1">Chọn lớp</option>
                                        <option value="5">Lớp 5</option>
                                        <option value ="9">Lớp 9</option>
                                    </select>
                                </div>
                            </div><!--  hêt phần thông tin cá nhân -->

                            <h3 class=" margin clear-both text-center tilecheck"> <!-- chon đợt thi muốn tham gia--> </h3>
                            <div  class="#">
                                <div class="#" id="class5" style="display: block;">
                                    <div class="checkbox float_left">
                                        <div class="check">
                                            <input type="checkbox" name="period_1" class="checkbox">
                                            <label for="checkbox" ><span></span><b>{{ CommonLanding::getPeriod(1) }}</b></label>
                                        </div>
                                        <div class="check">
                                            <input type="checkbox" name="period_2" class="checkbox">
                                            <label for="checkbox" ><span></span><b> {{ CommonLanding::getPeriod(2) }}</b></label>
                                        </div>
                                    </div>

                                    <div class="checkbox float_right">
                                        <div class="check">
                                            <input type="checkbox" name="period_3" class="checkbox">
                                            <label for="checkbox"> <span></span><b> {{ CommonLanding::getPeriod(3) }}</b></label>
                                        </div>
                                        <div class="check">
                                            <input type="checkbox" name="period_4" class="checkbox">
                                            <label for="checkbox"><span></span><b>{{ CommonLanding::getPeriod(4) }}</b></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="#" id="class9" style="display: none;">
                                    <div class="checkbox float_left">
                                        <div class="check">
                                            <input type="checkbox" name="period_5" class="checkbox">
                                            <label for="checkbox" ><span></span><b>{{ CommonLanding::getPeriod(5) }}</b></label>
                                        </div>
                                        <div class="check">
                                            <input type="checkbox" name="period_6" class="checkbox">
                                            <label for="checkbox" ><span></span><b> {{ CommonLanding::getPeriod(6) }}</b></label>
                                        </div>
                                    </div>
                                    <div class="checkbox float_right">
                                        <div class="check">
                                            <input type="checkbox" name="period_7" class="checkbox">
                                            <label for="checkbox"> <span></span><b>{{ CommonLanding::getPeriod(7) }}</b></label>
                                        </div>
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
                            @if(Session::has('message'))
                                <span><h3>{{ CommonLanding::getStudentCurrent() }}</h3></span>
                            @else 
                                <span><h3 id="custom_name"></h3></span>
                            @endif
                            <span class="text-center"> <b class="text-chanform ">vừa đăng ký </b> </span>
                        </div>

                    </div>
                </content>
                @if(Session::has('message'))
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">X</span>
                        <h2>"Đăng ký thành công</h2>
                        <p>Vui lòng kiểm tra email xác nhận và diện thoại cá nhân. HOCMAI sẽ gửi thông tin xác nhận và hướng dẫn lấy SBD*</p>
                        <p><!-- <img src="image_landing/thongbao.png"> --></p>
                    </div>
                </div> 
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
    var adArray = [
        'Ta Nguyen Phuong Linh',
        'lê nguyễn khánh linh',
        'Ngô phương linh',
        'Vũ đình duy anh',
        'Vũ Thái Sơn',
        'Nguyễn Trang Minh Hương',
        'Nguyễn Trang Minh Hương',
        'Nguyễn Trang Minh Hương',
        'Trương Minh Trí',
        'Hoàng Tuấn Dũng',
        'Nguyễn Thị Minh Thư',
        'Nguyễn Hữu Minh Thái',
        'Trần mai sương',
        'Vũ Gia Bách',
        'Trần Minh Hiếu',
        'Hà My',
        'Nguyễn Tiến Huy',
        'Nguyễn Thị Minh Hoà ',
        'Trần Cao Khánh Linh',
        'Nguyễn Quang',
        'Le Duc Dung',
        'Nguyễn Trí Dũng',
        'Lê Công Duy',
        'Bùi Hồng Phương Linh',
        'Trần Trọng Minh',
        'Lương Vy Thảo',
        'Nguyễn Bá Trần Khoa',
        'Nguyễn Trung Hiếu',
        'Nguyễn Anh Thư',
        'Nguyễn Tuấn An',
        'Phạm Hồng Minh',
        'Nguyễn Minh Hà',
        'Nguyễn Bảo Long',
        'Phạm Xuân Bách',
        'Phạm Vũ Thái An',
        'Tô nguyễn Thịnh',
        'Ngô khôi nguyên ',
        'Nguyễn Lan Phương',
        'Quách Gia Khoa',
        'Ngô Khôi Nguyên ',
        'Nguyễn công bảo anh',
        'Nguyễn Nhật Mỹ Anh',
        'Nguyễn Minh Hà',
        'Trần Minh Anh',
        'Trần Quang Huy',
        'Nguyễn Ngọc Phương Anh',
        'Chế Hà My',
        'Nguyễn Lê Tường Vy',
        'Nhữ Hà Linh',
        'Bùi Duy Quang',
        'Dang tran nhat minh',
        'Tô Minh Đức',
        'Phạm Lê Minh',
        'Trần thanh huyền',
        'Đặng Trà Mi',
        'Ngô Quang Minh',
        'Giang Đức Huy',
        'Đào Quang Sơn',
        'Nguyễn Kim Ngân',
        'Trần Hà Diệu Anh',
        'Nguyễn Đình Huy',
        'Lê Minh Thảo',
        'Nguyễn Danh Hoàng',
        'Võ Hải Minh',
        'Lương Quang Bình ',
        'Lê Hương Giang',
        'Phạm yến nhi',
        'Nguyễn Nhật Minh',
        'Trần Minh Vũ',
        'Võ tấn sang',
        'Lê Đăng Khôi',
        'nguyen khoi nguyen',
        'Trần Đức Việt Anh',
        'Trịnh Khánh Linh',
        'Nguyễn Trà My',
        'Hoàng Tuấn Minh',
        'Lê Minh Thư',
        'Nguyễn Đỗ Uyên Nhi',
        'Lê Bảo Minh',
        'Nguyễn Lê Nhật Minh',
        'Đỗ Ngọc Diệp',
        'Trần Thu Phương',
        'Hà Trường Anh',
        'Đỗ Ngọc Vân',
        'NGUYỄN KIM HOÀNG VŨ',
        'TRẦN NGÔ KHÁNH VY',
        'Lê Xuân Khánh',
        'ĐỖ VIỆT SƠN',
        'Nguyễn Tiến Duy',
        'Nguyễn công bảo anh',
        'Vũ Minh Hiền',
        'Lê Mạnh Cường',
        'Lưu Gia Huy',
        'Nguyễn Việt Linh',
        'Mào Khang Luân',
        'Đỗ Chi Mai',
        'Lê Nguyên Hạnh Dung',
        'Vũ Minh Hải Phong',
        'VŨ LAM ANH',
        'Vũ Khánh Hà',
        'Bùi Đăng Minh Hiếu',
        'Dương Hoàng Gia Thuỵ',
        'Trần Tuấn Nghĩa',
        'Bùi Đức Huy',
        'Lương Vân Hà',
        'Nguyễn An Phu',
        'nguyen an phuc',
        'Khương Tuấn Nam',
        'Nguyễn Cảnh Thắng',
        'Nguyễn Hải Anh',
        'Trần Phương Thảo',
        'nguyễn Minh Ngọc ',
        'Nguyễn Quang Huy',
        'Nguyễn Quang Huy',
        'Nguyễn Quang Huy',
        'Thé Sơn',
        'Nguyễn Mai Tuấn Khôi',
        'Lê Nhật Duy',
        'Đào khánh chi',
        'Nguyen Pham Minh Phuong',
        'Hà trịnh anh đức',
        'Nguyễn Ngọc Dung',
        'Phạm Nguyễn Hồng Ngọc',
        'Vũ Ngọc Ninh',
        'nguyễn thủy tiên',
        'Trần Hà My',
        'Lê Duy Anh',
        'Nguyễn Thủy Tiên',
        'Trần Hà My',
        'Lê Hoàng Linh Chi',
        'Nguyễn Thị Hoàng Tâm',
        'Phạm Yến Trang',
        'Hoàng Hương Giang',
        'Trần nguyễn quang minh',
        'Phan Trường Sơn',
        'Bùi Đỗ Minh Hải',
        'Thắng  Tiến Khang',
        'Lê Công Tùng',
        'Nguyễn Thị Hoàng Tâm',
        'Phạm Khôi Nguyên',
        'Nhữ Hà Linh',
        'Lê Diệu Anh',
        'Phạm Đặng Nam Sơn',
        'Nguyễn Khánh Chi',
        'Đàm Hải Đăng',
        'Nghiêm Phú Thành',
        'Nguyễn Minh Sơn',
        'Tgghh',
        'Bùi Long Nhật',
        'Đoàn minh tuấn',
        'Đào Đức Bảo Tuyên',
        'Nguyen hien anh',
        'Trần công hiếu',
        'Tạ Ngọc Hiển',
        'Nguyen Le Phong',
        'Trần Đức Nghĩa',
        'Phạm Ngọc Hải',
        'Nguyễn Thị Minh Hằng',
        'Nguyễn Đỗ Hoàng Giang'
    ];
    (function iterator() {
        var now = <?php print($now); ?>;
        var timeCustom = <?php print($timeCustom); ?>;
        var now = new Date().getTime();
        var a = Math.floor(now/1000) - timeCustom;
        var b = 9; 
        var c = a % b;
        // console.log(timeCustom);
        // if (c == 0) {
        //     document.getElementById('number').innerHTML = adArray[c];
        //     setTimeout(iterator, 1000);
        // };
        // if (c == 1) {
        //     document.getElementById('number').innerHTML = adArray[c];
        //     setTimeout(iterator, 1000);
        // };
        // if (c == 2) {
        //     document.getElementById('number').innerHTML = adArray[c];
        //     setTimeout(iterator, 1000);
        // };
        // if (c == 3) {
            document.getElementById('custom_name').innerHTML = adArray[c];
            setTimeout(iterator, 4000);
        // };

        console.log(adArray[i]);

    })();
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
    function showDiv(elem){
        if(elem.value == 5) {
            console.log(1133);
            document.getElementById('class5').style.display = "block";
            document.getElementById('class9').style.display = "none";
        }
        if(elem.value == 9) {
            document.getElementById('class9').style.display = "block";
            document.getElementById('class5').style.display = "none";
        }
        if(elem.value == 1) {
            document.getElementById('class5').style.display = "block";
            document.getElementById('class9').style.display = "none";
        }

    }
    // function phonenumber(inputtxt)
    // {
    //     console.log(11);
    //     var phoneno = /^\d{10}$/;
    //     if(inputtxt.value.match(phoneno))
    //     {
    //       return true;
    //     }else{
    //         alert("Not a valid Phone Number");
    //         return false;
    //     }
    // }
</script>
