<?php $slide = AdminSlide::where('type', SLIDE_TOP)->get(); ?>
@if(count($slide) > 0)
<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        @foreach($slide as $image)
        <div class="swiper-slide"><a href="{{ $image->link }}"><img src="{{ url(UPLOADIMG . UPLOAD_SLIDE . '/' . $image->id . '/' . $image->image_url) }}" /></a></div>
        @endforeach
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

 <!-- Initialize Swiper -->
<script>
var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    paginationClickable: true,
    // spaceBetween: 30,
    centeredSlides: true,
    autoplay: 2500,
    autoplayDisableOnInteraction: false
});
</script>
@endif