var url= "http://localhost/edunola/";
//var url= "http://www.edunola.com.ar/";

function buscar_post(){
    var search= $(".well");
    var input= search.find('input[name="post-find"]');
    var value= encodeURI(input.val());
    value= value.replace("?", "%3F");
    window.location.href= url + "blog/search/" + value;
}