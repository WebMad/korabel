var last_value;
var count_delete = 1;
$( document ).ready(function(){

    /*$('#search_user').keydown(function(){
        $('#search_user').change();
    });*/
    last_value = $('#search_user').val();
    setInterval(function() {
        if(last_value != $('#search_user').val()){
            last_value = $('#search_user').val();
            searchUser();
        }

    }, 1000);
});

function searchUser() {
    $.ajax({
        url: '/admin/users/search/' + $('#search_user').val(),
    }).done(function (data) {

        for (var i = users.length; i > count_delete; i--) {
            users.removeChild(users.children[count_delete]);
        }
        data.forEach(function (value) {
            div = document.createElement('option');
            div.innerHTML = value.surname + ' ' + value.name + ' ' + value.patronymic;
            div.setAttribute('value', value.id);
            document.getElementById('users').appendChild(div);
        });

    });
}