// получаем значения из формы логина и отправляем на сервер
$('#submit_login').click(function () {

    console.log('submit_login');

    login = $('#login').val();
    password = $('#password').val();

    doLogin(login, password);
});

// получаем значения из формы регистрации и отправляем на сервер
$('#submit_register').click(function () {

    console.log('submit_register');
    
    firstname = $('#firstname').val();
    lastname = $('#lastname').val();
    login = $('#login').val();
    chat_id = $('#chat_id').val();
    password = $('#password').val();

    console.log(firstname);
    console.log(lastname);
    console.log(login);
    console.log(chat_id);
    console.log(password);

    doRegister(firstname, lastname, login, chat_id, password);
});

$('#submit_code').click(function () {

    telegram_code = $('#telegram_code').val();

    doSubmit(telegram_code);
});

function doLogin(login, password) {
    $.post(
        '/user/login/',
        {
            'login': login,
            'password': password,
            'submit': 'submit'
        },
        onSubmit
    )
}

function doRegister(firstname, lastname, login, chat_id, password) {
    $.post(
        '/user/register/',
        {
            'firstname': firstname,
            'lastname': lastname,
            'chat_id': chat_id,
            'login': login,
            'password': password,
            'submit': 'submit'
        },
        onSubmit
    )
}

function doSubmit(telegram_code) {
    $.post(
        '/user/submit/',
        {
            'telegram_code':telegram_code,
            'submit':'submit'
        },
        successfullSubmit
    )
}

// редирект на окно подтверждения
function onSubmit(data) {
    result = JSON.parse(data);
    console.log(result['success']);
    if (result['success'] == true) {
        window.location.replace('/user/submit')
    }
}

// редирект на главную страницу при вводе верного телеграм-кода
function successfullSubmit(data) {
    result = JSON.parse(data);
    if (result['success']) {
        window.location.replace('/');
    }
}