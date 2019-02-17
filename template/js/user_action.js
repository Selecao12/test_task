function addUser() {

    let lastname = $('#id_form_lastname').val();
    let firstname = $('#id_form_firstname').val();
    let patronymic = $('#id_form_patronymic').val();


    $.post(
        '/user/add',
        {
            'lastname': lastname,
            'firstname': firstname,
            'patronymic': patronymic,
        },
        onAdd
    )
}

// удалить пользователя
function deleteUser(id) {
    $.post(
        '/user/delete',
        {
            'id': id
        },
        onDelete
    )
};

// при успешном удалении пользователя
function onDelete(data) {
    data = JSON.parse(data);
    if (data.result == 'ok') {
        let id = '#' + data.id;
        console.log(id);
        $(id).remove();
    } else {
        alert('Ошибка');
    }
}

function onAdd(data) {
    data = JSON.parse(data);

    if (data.result == 'ok') {
        console.log('add user');
        let id = data.id;
        let lastname = data.lastname;
        let firstname = data.firstname;
        let patronymic = data.patronymic;

        let html = '<div class="table_row" id="' + id + '">';
        html += '<div class="table_ceil table_ceil_id"><div>' + id +'</div></div>';
        html += '<div class="table_ceil table_ceil_lastname"><div>' + lastname + '</div></div>';
        html += '<div class="table_ceil table_ceil_firstname"><div>' + firstname + '</div></div>';
        html += '<div class="table_ceil table_ceil_patronymic"><div>' + patronymic + '</div></div>';
        html += '<div class="table_ceil table_ceil_delete_button" onclick="deleteUser('+ id +')"><i class="fa fa-minus" style="color: red"></i></div></div>';

        $('.table_content').prepend(html);
    } else {
        alert('Ошибка');
    }
}