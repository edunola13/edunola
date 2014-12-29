var url= "http://localhost/edunola/";
//var url= "http://www.edunola.com.ar/";

function buscar_post(){
    var search= $(".well");
    var input= search.find('input[name="post-find"]');
    var value= encodeURI(input.val());
    value= value.replace("?", "%3F");
    window.location.href= url + "blog/search/" + value;
}

function comentarios(id){
    $.ajax({
        type: "GET",
        url: url + 'enola-widgets/comments-blog/' + id,
        dataType: "html",
        success: function (msg) {
            $("#list-comentarios").html(msg);
        },
        error: function (msg){
            alert("Error. Vuelva a Intentarlo.");
        }        
    });
}

//Evento de alta de Venta
$( "body" ).on( "submit","#form-comentario form", function( event ) {
	document.body.style.cursor = 'wait';
    	$.ajax( {
    	    url: "../add_comentario",
    	    type: 'POST',
    	    data: new FormData( this ),
    	    processData: false,
    	    contentType: false,            
    	    success: function (rta) {
                var obj = jQuery.parseJSON(rta);
                if(obj.rta === true){
                    var idPost= $('#post_id').val();
                    comentarios(idPost);
                    $('#form-comentario input').val('');
                    $('#form-comentario textarea').val('');
                    $('#post_id').val(idPost);
                }
                else{
                    var mensaje= '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">×</button><strong></strong>' + obj.errores + '</div>';
                    $('#form-comentario').prepend(mensaje);
                }
    	    	document.body.style.cursor = 'auto';	
    	    },
    	    error: function (){
    	    	document.body.style.cursor = 'auto';
    	        alert("Error");
    	    }
    	} );
    	event.preventDefault();
});

function eliminar_comentario(id, idPost){
    var r = confirm("Esta seguro que desea eliminar el Post?");
    if (r == true) {
        $.ajax({
            type: "GET",
            url: '../delete_comentario/' + id,
            dataType: "html",
            success: function (msg) {
                var obj = jQuery.parseJSON(msg);
                if(obj.rta === true){
                    comentarios(idPost);
                }
                else{
                    alert('Hubo un Error, vuelva a intentarlo');
                }
            },
            error: function (msg){
                alert("Error. Vuelva a Intentarlo.");
            }        
        });
    }
}