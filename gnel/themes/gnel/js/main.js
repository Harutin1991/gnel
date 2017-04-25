
$( window ).resize(function() {

    $('.slidesjs-container').css('height', $('.container-left').height() - 80);
    $('.slidesjs-control').css('height', $('.container-left').height() - 90);
    $('#slides').css('height', $('.container-left').height()-10);
});
$(document).ready(function(){
    $('#slides').slidesjs({
        width: 940,
        height: 528,
        play: {
            active: true,
            auto: true,
            interval: 4000,
            swap: true
        }
    });
    $('.regular').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 6
    });
    $('.slidesjs-container').css('height', $('.container-left').height() - 80);
    $('.slidesjs-control').css('height', $('.container-left').height() - 90);
    $('#slides').css('height', $('.container-left').height()-10);
    $('.v-player a').click(function(){
        $('.v-player a').css('display', 'none');
        $('#vid').trigger('click');
    })
    $('#vid').click(function() {
        if(this.paused) {
            this.play();
        } else {
            this.pause();
            $('.v-player a').css('display', 'block');
        }
    });
    $("#playListContainer").audioControls({
        autoPlay : false,
        timer: 'increment',
        onVolumeChange : function(vol){
            var obj = $('.volume');
            if(vol <= 0){
                obj.attr('class','volume mute');
            } else if(vol <= 33){
                obj.attr('class','volume volume1');
            } else if(vol > 33 && vol <= 66){
                obj.attr('class','volume volume2');
            } else if(vol > 66){
                obj.attr('class','volume volume3');
            } else {
                obj.attr('class','volume volume1');
            }
        }
    });
    document.getElementById('vid').addEventListener('ended',myHandler,false);
    function myHandler(e) {
        $('.v-player a').css('display', 'block');
    }
})


