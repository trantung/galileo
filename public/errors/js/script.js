var slider;
var images = [
"/errors/images/balloon.png",
"/errors/images/clouds.png",
"/errors/images/grass.png",
"/errors/images/owl.png",
"/errors/images/sun.png"
];
if($('.night').length){
    images = [
    "/errors/images/balloon_night.png",
    "/errors/images/stars.png",
    "/errors/images/grass_night.png",
    "/errors/images/owl_night.png",
    "/errors/images/moon.png"
    ]; 
}

var index = 0;
var transitionSpeed = 500;
var imageIntervals = 5000;

var startIntervals;
var intervalSetTime;
var contentOpen = false;

$(document).ready(function() {
    
  
    function balloon(){
        var el=$('.balloon');
        if(el.hasClass('show')){
            el.removeClass('show').addClass('hide').removeClass('fadeInUp');
            el.addClass('animated fadeOutUp');
        }else{
            el.removeClass('hide').addClass('show').removeClass('fadeOutUp');
            el.addClass('animated fadeInUp');
        }
   
        setTimeout(balloon,4000);
    };            
    balloon();
           
                                         
	
    $(function() {

		
        $.preload(images, {
            init: function(loaded, total) {
                $("#indicator").html("<img src='/errors/images/load.gif' />");			
            },
			
            loaded_all: function(loaded, total) { 
                $('body').height($(window).height());
                            
                $('#indicator').fadeOut('slow', function() {
                    $('body').addClass('gradient');

                    if($('.night').length){
                        $('.stars').pan({
                            fps: 30, 
                            speed: 1, 
                            dir: 'left', 
                            depth: 70
                        });
                    } else{
                        $('.clouds').pan({
                            fps: 30, 
                            speed: 1, 
                            dir: 'left', 
                            depth: 70
                        });
                    }
                                
                    $('.init').fadeIn(function(){
                        $(this).removeClass('init');
                        if($('.night').length){
                            $('.moon').addClass('animated bounceInDown');
                        } else{
                            $('.sun').addClass('animated bounceInDown');
                        }
                                      
                        setTimeout(function(){
                            $('.owl').plaxify({"xRange":10,"yRange":0}) 
                            $('.grass').plaxify({"xRange":100})   
                            $.plax.enable(); 
                        },1000)    
                    })
                                         
                });
            }
        });
    });
 

})

$(window).resize(function() {
    $('body').height($(window).height());
});