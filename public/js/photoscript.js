/**
 * Created by Stavros1 on 15-07-19.
 */
$(function(){
    $(".fa fa-refresh fa-spin").hide();
    ajaxLoadImages();
    $(window).scroll(function(){

        if($(window).scrollTop() == $(document).height() - $(window).height()){
            ajaxLoadImages();
        }
    });

});




function ajaxLoadImages(){

    $.ajax({
        type: "GET",
        url: 'popular',
        dataType:'json',
        beforeSend:function(){
            $(".fa fa-refresh fa-spin").show();
        },
        complete: function(){
            $('.fa fa-refresh fa-spin').hide();
        },
        success: function(data){
            $.each(data.data,function(key,value){
                $("#theData").append(
                    "<div class='col-xs-6 col-md-3'>"+
                    "<div class='thumbnail'>" +
                    "<a target='_blank' href='" + value.link + "'> " +
                    "<img id='images'  src='" + value.images.low_resolution.url +"'></img>"+"</a>"+
                    "<p>Posted by: " + value.user.username + "</p>"+
                    "<p>Likes: " + value.likes.count + "</p>"+
                    "</div>"+
                    "</div>"
                );

            });

        }
    });
}

