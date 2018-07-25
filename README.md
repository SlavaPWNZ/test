# API для каталога товаров Laravel<br />

**Описание задачи**<br />
Необходимо написать простейшее API для каталога товаров. <br />
*Приложение должно содержать:*<br />
• Категории товаров<br />
• Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)<br />
• Пользователей, которые могут авторизоваться <br />
*Возможные действия:*<br />
• Авторизация пользователей<br />
• Получение списка всех категорий<br />
• Получение списка товаров в конкретной категории<br />
• Добавление/Редактирование/Удаление категории (для авторизованных пользователей)<br />
• Добавление/Редактирование/Удаление товара (для авторизованных пользователей)<br />
**Так же необходимо написать консольную команду для регистрации пользователя.**<br />
<br />
Инструкция по запуску проекта:<br />
**Список команд API**<br />
<br />
Получение списка всех категорий<br />
getCategories<br />
GET: null<br />
<br />
Получение списка товаров в конкретной категории. Аргументы: id категории.<br />
getItems<br />
GET: id<br />
<br />
Авторизация. Аргументы: логин и пароль пользователя. Возвращается токен.<br />
auth<br />
GET: login, password<br />
<br />
Добавление категории (для авторизованных пользователей). Аргументы: название категории и токен.<br />
createCategory<br />
GET: name_new, token<br />
<br />
Редактирование категории (для авторизованных пользователей). Аргументы: id категории, новое название категории и токен.<br />
changeCategory<br />
GET: id, name_new, token<br />
<br />
Удаление категории (для авторизованных пользователей). Аргументы: id категории и токен.<br />
deleteCategory <br />
GET: id, token<br />
<br />
Добавление товара (для авторизованных пользователей). Аргументы: название товара, id категорий через запятую и токен.<br />
createItem<br />
GET: name_new, ids_categories_new, token<br />
<br />
Редактирование товара (для авторизованных пользователей). Аргументы: id товара, новое название товара, новые id категорий через запятую и токен.<br />
changeItem<br />
GET: id, name_new, ids_categories_new, token<br />
<br />
Удаление товара (для авторизованных пользователей). Аргументы: id товара и токен.<br />
deleteItem<br />
GET: id, token<br />
<br />
**Консольная команда для регистрации пользователя**<br />
php artisan createUser --l mylogin --p mypassword<br />
Возвращает "user successfully created" в случае успеха.<br />
<br />
**Примеры запросов для использования приложения.** <br />
1) http://lavarel/public/getCategories<br />
Результат:<br />
[{"id":1,"name":"Новинки"},{"id":2,"name":"Спорт"},{"id":3,"name":"Для дома"},{"id":4,"name":"Отдых"}]<br />
<br />
2) http://lavarel/public/getItems?id=1<br />
Результат:<br />
[{"id":4,"name":"Мяч"}]<br />
<br />
3) http://lavarel/public/auth?login=admin&password=123<br />
Результат:<br />
{"token":"75e96f5543eedecf93db5830224e10b9"}<br />
<br />
4) http://lavarel/public/createCategory?name_new=test&token=75e96f5543eedecf93db5830224e10b9<br />
Результат:<br />
{"result":"category successfully created"}<br />
<br />
5) http://lavarel/public/changeCategory?id=4&name_new=ОТДЫХ2&token=75e96f5543eedecf93db5830224e10b9<br />
Результат:<br />
{"result":"category successfully changed"}<br />
<br />
6) http://lavarel/public/deleteCategory?id=2&token=75e96f5543eedecf93db5830224e10b9<br />
Результат:<br />
{"result":"category successfully deleted and ratio with items"}<br />
<br />
7) http://lavarel/public/createItem?name_new=test2&ids_categories_new=1,2,3&token=75e96f5543eedecf93db5830224e10b9<br />
Результат:<br />
{"result":"item successfully created and ratio with categories"}<br />
<br />
8) http://lavarel/public/changeItem?id=1&name_new=testtest&ids_categories_new=5,4&token=75e96f5543eedecf93db5830224e10b9<br />
Результат:<br />
{"result":"item successfully changed and ratio with categories"}<br />
<br />
9) http://lavarel/public/deleteItem?id=5&token=75e96f5543eedecf93db5830224e10b9<br />
Результат:<br />
{"result":"item successfully deleted and ratio with categories"}<br />
<br />
**Сколько на каждую часть проекта ушло времени**<br />
1) Написание API на нативном PHP. (~3 часа)<br />
2) Первый опыт с Laravel. Первый успешный api запрос. (~3часа)<br />
3) Реализация всех остальных методов. (~1 час)<br />
4) Создание консольной команды. (~2 часа)<br />
5) Первый опыт с тестами в Laravel и phpunit. (~3 часа)<br />
6) База данных. (~30 минут)<br />
7) Git. (~30 минут)<br />
<br />
P.S. В связи с нехваткой времени, тестами я покрыть код не успел... По логике, нужно сделать тесты на все возможные ситуации, для которых я делал обработчики. У меня был опыт тестирования на джаве, и я там так делал... Во время выполнения задания получил опыт в некоторых штуках :-)<br />
P.S.S. Дамб базы данных так же лежит в проекте. (dump.sql)<br />
