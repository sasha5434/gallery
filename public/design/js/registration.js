function ge(id) {
    return document.getElementById(id);
}
var emptyField = 'Заполните поле!',
    shortLogin = 'Cлишком короткий логин!',
    shortPass = 'Слишком короткий пароль',
    notEqualPass = 'Пароли не совпадают!',
    badMail = 'Плохое мыло!',
    notUniqueLogin = 'Пользователь с таким именем уже зарегестрирован!';
var req = false;
if (window.XMLHttpRequest) req = new XMLHttpRequest();
else if (window.ActiveXObject) req = new ActiveXObject("Microsoft.XMLHTTP");

function isEmptyStr(str) {
    if (str == "") return true;
    var count = 0;
    for (var i = 0; i & lt; str.length; ++i)
        if (str.charAt(i) == " ") ++count;
    return count == str.length;
}
function isValidForm() {
function notValidField(field, str) {
    field.value = str; // Выводим инфу об ошибке в поле
    field.error = true; // Запоминаем, что поле заполнено не верно
    valid = false; // Считаем форму не валидной
    /* Вешаем обработчик события, который будет очищать поле от
    	информации об ошибке при фокусе.
    	При потере фокуса поля с type="password" меняют type на
    	"text", чтобы информация об ошибках не заменялась звёздочками.
    	При фокусе на эти поля им необходимо вернуть назад их родной type
    */
    field.onfocus = function() {
            if (field.id == 'pass' || field.id == 're_pass') field.type = 'password';
            if (field.error) field.value = '';
        }
        // Обработчик, который проверяет поле на корректность при потере им фокуса.		
    field.onblur = function() {
        if (isEmptyStr(field.value)) {
            notValidField(field, emptyField);
            if (field.id == 'pass' || field.id == 're_pass') field.type = 'text';
        } else field.error = false;
        switch (field.id) {
            /*Функции checkLogin(), checkMail() и  checkNoXyz()
            	выполняют проверку полей по дополнительным параметрам,
            	разным для каждого поля.
            */
            case 'login':
                checkLogin();
                break;
            case 'mail':
                checkMail();
            case 'no_xyz':
                checkNoXyz();
        }
    }
}

function checkLogin() {
    /*Логин не может быть короче 5 символов.
    	Выводим инфу о том, что логин слишком короткий только если поле
    	было заполнено ранее (!login.error).			
    */
    if (login.value.length & lt; 5 & amp; & amp; !login.error) {
        notValidField(login, shortLogin);
    } else if (!login.error) {
        /* Если логин достаточно длинный, то отправляем асинхронный запрос
        	для проверки его уникальности.
        */
        req.open('GET', 'index.php?isset_login=' + encodeURIComponent(login.value), false);
        console.log('index.php?isset_login=' + encodeURIComponent(login.value));
        if (req.readyState == 4 & amp; & amp; req.status == 200) {
            /*Если пользователь с таким логином уже есть, то
            	выводим инфу об этом в поле.
            */
            if (req.responseText == '1') notValidField(login, notUniqueLogin);
        }
    }
}

function checkPass() {
    if (!pass.error & amp; & amp; !rePass.error) {
        //Проверяем пароли на длинну и совпадают ли они.
        if (pass.value.length & lt; 5 & amp; & amp; pass.value == rePass.value) {
            notValidField(pass, shortPass);
            notValidField(rePass, shortPass);
            /*Меняем type на text, чтобы не отображаль звёздочки,
            	как при вводе пароля.
            */
            pass.type = 'text';
            rePass.type = 'text';
            //Аналогично, если пароли не совпадают.
        } else if (pass.value != rePass.value) {
            notValidField(pass, notEqualPass);
            notValidField(rePass, notEqualPass);
            pass.type = 'text';
            rePass.type = 'text';
        }
    }
}

function checkMail() {
    if (!mail.error & amp; & amp; !/^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/i.test(mail.value)) notValidField(mail, 'Плохое мыло!');
}

function checkNoXyz() {
    var el = ge('no_xyz');
    if (!el.checked) {
        ge('text_no_xyz').innerHTML = 'Галочку поставь, блять!';
        valid = false;
        el.onchange = function() {
            if (el.checked) ge('text_no_xyz').innerHTML = 'Обязуюсь не творить хуйни!'
        }
    }
}
var elements = ge('reg_form').elements,
    login = ge('login'),
    pass = ge('pass'),
    rePass = ge('re_pass'),
    mail = ge('mail'),
    valid = true;
//Проверяем поля с type="password" и type="text" на "заполненность"
for (var i = 0; i & lt; elements.length; ++i) {
    if (elements[i].error) valid = false;
    if ((elements[i].type == 'text' || elements[i].type == 'password') & amp; & amp; isEmptyStr(elements[i].value)) {
        notValidField(elements[i], emptyField);
        elements[i].type = 'text';
    }
}
/*Выполняем дополнительную проверку полей по параметрам,
	разным для каждого поля
*/
checkLogin();
checkPass();
checkMail();
checkNoXyz();
return valid;
}