<?php $slide = AdminSlide::where('type', SLIDE_BOTTOM)->get(); ?>
@if(count($slide) > 0)
<div class="homebox partner">
	<div class="container">
		<h2>{{ trans('captions.partners') }}</h2>
		<div class="row">
			<div class="col-sm-12">
				<!-- Swiper -->
				<div class="partner-container">
				    <div class="swiper-wrapper">
				    	@foreach($slide as $image)
				        <div class="partner-slide"><img src="{{ url(UPLOADIMG . UPLOAD_SLIDE . '/' . $image->id . '/' . $image->image_url) }}" /></a></div>
				        @endforeach
				    </div>
				</div>
				<!-- Initialize Swiper -->
			    <script>
			    var swiper1 = new Swiper('.partner-container', {
			    	paginationClickable: true,
			        slidesPerView: 4,
			        slidesPerColumn: 2,
			        // spaceBetween: 5,
			        loop: true,
			        // breakpoints: {
			        //     1024: {
			        //         slidesPerView: 4
			        //     },
			        //     768: {
			        //         slidesPerView: 3,
			        //         slidesPerColumn: 1
			        //     },
			        //     640: {
			        //         slidesPerView: 2,
			        //         slidesPerColumn: 1
			        //     },
			        //     320: {
			        //         slidesPerView: 1,
			        //         slidesPerColumn: 1
			        //     }
			        // }
			    });
			    </script>
			</div>
		</div>
	</div>
</div>
@endif