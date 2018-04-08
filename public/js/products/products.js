var selector = document.getElementsByClassName('eliminar');
    for(var i=0; i<selector.length; i++){
        selector[i].addEventListener('click', eliminar);
    }
    
function eliminar(evt){
    evt.preventDefault();
    var url = this.getAttribute('href');
    var form = document.getElementById('delete');
    
    form.setAttribute('action', url);
    form.submit();
}