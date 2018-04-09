
<!DOCTYPE html>
<html id="html" lang="vi" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>regiter</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" itemprop="inLanguage" content="vi"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ HTML::style('landing_page/css/style.css') }}
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="jquery-3.3.1.min.js"></script>
    </head>
    <body>
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
        <!-- open sidebar -->
                                                                            <!-- end sidebar -->
        <content>
            {{ Form::open(array('action' => 'LandingPageController@store')) }}
                {{ Form::hidden('utm_source', $utmSource) }}
                {{ Form::hidden('utm_medium', $utmMedium) }}
                {{ Form::hidden('utm_campaign', $utmCampaign) }}
                {{ Form::hidden('utm_term', $utmTerm) }}
                <div class="container">
                    <h3 class="text-chanform margin text-center personal">thông tin cá nhân</h3>
                    <div  class="#">
                        <div class="thongtin float_left">
                            <label>Họ và tên bố/mẹ :<input type="text" name="parent_name" required ></label><br><br>
                            <label>Họ và tên con : <input type="text" name="fullname" required ></label><br><br>
                            <label>Số điện thoại :<input type="text" name="phone" required ></label>
                        </div>
                        <div class="thongtin float_right">
                            <label> email :<input type="email" name="email" ></label><br><br>
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
                    <div class="" >
                        <div class="checkradio">
                            <input type="radio" name="address" value="1" class="radio">
                            <label for="radio"  class="radio"><span class="checkmark"></span>Cơ sở 1: Tòa nhà 25T2 Nguyễn Thị Thập, Trung Hòa, Cầu Giấy, Hà Nội;</label>
                        </div>
                        <div class="checkradio">
                            <input type="radio" name="address" value="2" class="radio">
                            <label for="radio" class="radio"><span class="checkmark"></span>Cơ sở 2: 79 Văn Phúc, Văn Quán, Hà Đông, Hà Nội;</label>
                        </div>

                        <div class="checkradio">
                            <input type="radio" name="address" value="3" class="radio">
                             <label for="radio"  class="radio"><span class="checkmark"></span>Cơ sở 3: 19D TT5 Khu đô thị Tây Nam Linh Đàm, Hoàng Liệt, Hoàng Mai, Hà Nội;</label>
                        </div>

                        <div class="checkradio">
                            <input type="radio" name="address" value="4" class="radio">
                            <label for="radio"  class="radio"><span class="checkmark"></span>Cơ sở 4: T11SO02 chung cư T11 Times City, 458 Minh Khai, Hai Bà Trưng, Hà Nội.</label>
                        </div>
                    </div><!-- hết phần chọn điểm đăng ký dự thi -->
                </div> <!-- hết container trên -->

                <article>   <!-- //lựa chọn môn thi -->
                    <div class="check_subject_name" >
                        <div class="check_subject_right float_right">
                            <div class="subject">
                                <div class="check_subject">
                                    <input type="radio" name="check_subject" value="1"  class="radio" checked="checked">
                                    <label for="radio"><span class="checkmark"></span> Toán (Toán &amp; KHTN đối với lớp 5)</label>
                                </div>
                                <div class="check_subject">
                                    <input type="radio" name="check_subject" value="1" class="radio">
                                    <label for="radio"> <span class="checkmark"></span>Văn (Tiếng Việt và KHXH đối với lớp 5 )</label>
                                </div>
                                <div class="check_subject">
                                    <input type="radio" name="check_subject" value="1" class="radio">
                                    <label for="radio"><span class="checkmark"></span>Cả hai môn</label>
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
                <div  class="regiter" >
                    {{ Form::submit('ĐĂNG KÝ', ['class'=>'button']) }}
                </div>
            {{ Form::close() }}
            <div class ="report">
                <h2 class="impact text-chanform white">đã có</h2>
                <span id="number"><h1>890</h1></span>
                <span> <b class="text-chanform">nguyễn tiến dũng </b> vừa đăng ký</span>
            </div>
        </content>
    <div class=" thanh1 clear-both" ></div>
    <footer class="footer text-chanform">
        <p>hệ thống giáo dục họcmai-trung tâm học chủ động galieo-hotline: 090.211.0033</p>
    </footer>
    </body>
</html>