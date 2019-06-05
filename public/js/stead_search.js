var last_value;
var count_delete = 0;
$( document ).ready(function(){

    /*$('#search_user').keydown(function(){
        $('#search_user').change();
    });*/
    last_value = $('#search_stead').val();
    setInterval(function() {
        if(last_value != $('#search_stead').val()){
            last_value = $('#search_stead').val();
            searchStead();
        }

    }, 1000);
});

function searchStead() {
    $.ajax({
        url: '/admin/steads/search/' + $('#search_stead').val(),
    }).done(function (data) {
        for (var i = steads.length; i > count_delete; i--) {
            steads.removeChild(steads.children[count_delete]);
        }
        data.forEach(function (value) {
            div = document.createElement('option');
            div.innerHTML = value.number + ' - ' + value.surname + ' ' + value.name + ' ' + value.patronymic;
            div.setAttribute('value', value.id);
            document.getElementById('steads').appendChild(div);
        });

    });
}