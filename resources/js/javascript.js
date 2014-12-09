$(document).ready(function() {
    $("#dialog-confirm").dialog({
      autoOpen: false,
      modal: true
    });
});


function update_form(id){
    var urlSend= "";
    var urlAct= document.URL;
    var preUrl= "";
    if(urlAct.indexOf("admin/usuarios/add") != -1 || urlAct.indexOf("admin/usuarios/update") != -1){
        preUrl= "../"
    }
    urlSend= preUrl + 'usuarios/update';
        
    $.ajax({
        type: "GET",
        url: urlSend,
        data: {id:id},
        dataType: "html",
        success: function (msg) {
            $(".add").hide();
            $(".update").html(msg);
            $(".update").show("slow");            
            $('html,body').animate({scrollTop: $(".update").offset().top});
        },
        error: function (msg){
            alert("Error. Vuelva a Intentarlo.");
        }
    });    
}

function add(){
    $(".update").hide();
    $(".add").show("slow");
    $('html,body').animate({scrollTop: $(".add").offset().top});
}

function delete_user(id){
    $("#dialog-confirm").dialog({
        resizable: true,
        height:200,
        width: 600,
        buttons: {
            "Eliminar": function() {
                $( this ).dialog( "close" );
                
                var urlSend= "";
                var urlAct= document.URL;
                var preUrl= "";
                if(urlAct.indexOf("admin/usuarios/add") != -1 || urlAct.indexOf("admin/usuarios/update") != -1){
                    preUrl= "../"
                }
                urlSend= preUrl + 'usuarios/delete';
                
                $.ajax({
                    type: "POST",
                    url: urlSend,
                    data: {id:id},
                    dataType: "html",
                    success: function (msg) {
                        $(".list").html(msg);
                    },
                    error: function (msg){
                        alert("Error. Vuelva a Intentarlo.");
                    }        
                });
            },
             "Cancelar": function() {
                $( this ).dialog( "close" );
            }
        }
    });
    $("#dialog-confirm").dialog("open");   
}

function delete_post(id, page){
    $("#dialog-confirm").dialog({
        resizable: true,
        height:200,
        width: 600,
        buttons: {
            "Eliminar": function() {
                $( this ).dialog( "close" );
                
                
                $.ajax({
                    type: "POST",
                    url: "blog/delete",
                    data: {id:id, page:page},
                    dataType: "html",
                    success: function (msg) {
                        $(".list").html(msg);
                    },
                    error: function (msg){
                        alert("Error. Vuelva a Intentarlo.");
                    }        
                });
            },
            "Cancelar": function() {
                $( this ).dialog( "close" );
            }
        }
    });
    $("#dialog-confirm").dialog("open"); 
}

function cargar_imagen(){
    $("#form-image").find('.informacion').empty();
    $('#modalModelo').modal('show');
}
//$(function () {    
//    $('#form-image button').on('click', function (event) {
//        event.preventDefault();// using this page stop being refreshing 
//
//        $.ajax({
//            type: 'POST',
//            url: url + 'admin/blog/images/add',
//            data: $('#form-image').serialize(),
//            success: function (rta) {
//                alert(rta);
//                $('#modalModelo').modal('hide');
//            },
//            error: function (){
//                alert("Error");
//            }
//        });
//    });    
//});
$( '#form-image' )
  .submit( function( e ) {
    var input= $('#form-image').find('input[name="nombre"]');
    var escapeInput= escape(input.val().replace(" ","_"));
    if(escapeInput.length == input.val().length){
        
    var urlSend= "";
    var urlAct= document.URL;
    var preUrl= "";
    if(urlAct.indexOf("admin/blog/update") != -1){
        preUrl= "../"
    }
    urlSend= preUrl + 'images/add';
        
    $.ajax( {
      url: urlSend,
      type: 'POST',
      data: new FormData( this ),
      processData: false,
      contentType: false,
      success: function (rta) {
          $("#form-image").find('.informacion').html(rta);
      },
      error: function (){
          alert("Error");
      }
    } );
    }
    else{
      alert("No se permiten caracteres acentos, signos de interrogacion y ningun caracter especial.");
    }
    e.preventDefault();
} );

function buscar_imagen(pagina, valueOri){
    var search= $("body");
    var input= search.find('input[name="imagen-find"]');
    var value= encodeURI(input.val());
    value= value.replace("?", "%3F");
    
    var urlSend= "";
    var urlAct= document.URL;
    var preUrl= "";
    if(urlAct.indexOf("admin/blog/update") != -1){
        preUrl= "../"
    }
    if(pagina == null){
        urlSend= preUrl + 'images/search/' + value;
    }
    else{
        urlSend= preUrl + 'images/search/' + valueOri + "/" + pagina;
    }
    
    $.ajax( {
        type: 'GET',
        url: urlSend,
        dataType: "html",
        success: function (rta) {
            $("#imagenes").html(rta);
        },
        error: function (){
        }
    } );
}

function actualizar_tags(){
    $.ajax( {
        type: 'GET',
        url: 'tags/lista_tags',
        dataType: "html",
        success: function (rta) {
            $(".list").html(rta);
        },
        error: function (){
        }
    } );
}

$(function() {
    DialogAddTag = $( "#form-add-tag" ).dialog({
          autoOpen: false,
          width: 700,
          modal: true,
          close: function() {
            $( "#form-add-tag" ).html('');
          }
    });
});

function form_add_tag(){
    $( "#form-add-tag" ).html('');
    DialogAddTag.dialog( "open" );
    $.ajax( {
        type: 'GET',
        url: 'tags/add',
        dataType: "html",
        success: function (rta) {
            $("#form-add-tag").html(rta);
        },
        error: function (){
            alert('Error');
        }
    } );
}

$(function() {
    DialogUpdTag = $( "#form-update-tag" ).dialog({
          autoOpen: false,
          width: 700,
          modal: true,
          close: function() {
            $( "#form-update-tag" ).html('');
          }
    });
});

function form_update_tag(id){
    $( "#form-update-tag" ).html('');
    DialogUpdTag.dialog( "open" );
    $.ajax( {
        type: 'GET',
        url: 'tags/update?id=' + id,
        dataType: "html",
        success: function (rta) {
            $("#form-update-tag").html(rta);
        },
        error: function (){
            alert('Error');
        }
    } );
}

function delete_tag(id){
    $("#dialog-confirm").dialog({
        resizable: true,
        height:200,
        width: 600,
        buttons: {
            "Eliminar": function() {
                $( this ).dialog( "close" );               
                $.ajax({
                    type: "POST",
                    url: "tags/delete",
                    data: {id:id},
                    dataType: "html",
                    success: function (msg) {
                        $(".list").html(msg);
                    },
                    error: function (msg){
                        alert("Error. Vuelva a Intentarlo.");
                    }        
                });
            },
            "Cancelar": function() {
                $( this ).dialog( "close" );
            }
        }
    });
    $("#dialog-confirm").dialog("open");
}