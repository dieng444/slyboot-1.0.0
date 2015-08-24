$(document).ready(function(){
	
    //alert("OK");
	$("#contenu").ckeditor();
	
	$('.img-thumb').each(function(){
		$(this).click(function(){
			$('#image-display-layout').attr('src',$(this).attr('src'));
		});
	});
    $('.btn-action').each(function(){
		$(this).click(function(event){
			if($(this).attr('id')=="rm-image-link")
				str = confirm('Voulez-vous vraiment supprimer cette image ?');
			else
				str = confirm('Voulez-vous vraiment supprimer cet article ?');
			
            if(str==false)
            {
                event.preventDefault();
            }
		});
	});
    function showPosition(position) {
            window.location.href = 'index.php?bundle=appWs&action=locationevents&long='+position.coords.longitude+'&lat='+position.coords.latitude;
        }
        
    $("#geoevents").click(function(ev){
        
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        
        ev.preventDefault();
    });
    function parsePhotos(data)
    {
        content = "";
        data = data.photos.photo;
        
        for(i in data)
        {
            var src = 'https://farm' + data[i].farm + '.staticflickr.com/' + data[i].server + '/'+ data[i].id +'_'+ data[i].secret + '_q.jpg';
            content += '<img src="'+src+'" alt="' + data[i].title + '"/>';
        }
        $('#photo-container').append(content);
    }
    $("#flickr-search").on('click', function(ev){
    
            var tag = $("#tag").val();
            
            var parameters = {
                    api_key:"b61984c8f8b83c6d90789912ae83737b",
                    tags : tag, 
                    format: "json",
                    privacy_filter : 1
                }
            $.ajax({
                url: "https://api.flickr.com/services/rest/?method=flickr.photos.search",
                jsonp: "jsoncallback",
                dataType: "jsonp",
                data: parameters
            }).done(parsePhotos);
            
             ev.preventDefault();
        });
	$('#photo-container').on('click', function(ev){
		alert("ok");
	});
});
