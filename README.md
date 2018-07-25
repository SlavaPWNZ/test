# API для каталога товаров Laravel

**Описание задачи**
Необходимо написать простейшее API для каталога товаров. 
*Приложение должно содержать:*
• Категории товаров
• Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)
• Пользователей, которые могут авторизоваться 
*Возможные действия:*
• Авторизация пользователей
• Получение списка всех категорий
• Получение списка товаров в конкретной категории
• Добавление/Редактирование/Удаление категории (для авторизованных пользователей)
• Добавление/Редактирование/Удаление товара (для авторизованных пользователей)
**Так же необходимо написать консольную команду для регистрации пользователя.**

Инструкция по запуску проекта:
**Список команд API**

Получение списка всех категорий
getCategories
GET: null

Получение списка товаров в конкретной категории. Аргументы: id категории.
getItems
GET: id

Авторизация. Аргументы: логин и пароль пользователя. Возвращается токен.
auth
GET: login, password

Добавление категории (для авторизованных пользователей). Аргументы: название категории и токен.
createCategory
GET: name_new, token

Редактирование категории (для авторизованных пользователей). Аргументы: id категории, новое название категории и токен.
changeCategory
GET: id, name_new, token

Удаление категории (для авторизованных пользователей). Аргументы: id категории и токен.
deleteCategory 
GET: id, token

Добавление товара (для авторизованных пользователей). Аргументы: название товара, id категорий через запятую и токен.
createItem
GET: name_new, ids_categories_new, token

Редактирование товара (для авторизованных пользователей). Аргументы: id товара, новое название товара, новые id категорий через запятую и токен.
changeItem
GET: id, name_new, ids_categories_new, token

Удаление товара (для авторизованных пользователей). Аргументы: id товара и токен.
deleteItem
GET: id, token

**Консольная команда для регистрации пользователя**
php artisan createUser --l mylogin --p mypassword
Возвращает "user successfully created" в случае успеха.

**Примеры запросов для использования приложения.** 
1) http://lavarel/public/getCategories
Результат:
[{"id":1,"name":"Новинки"},{"id":2,"name":"Спорт"},{"id":3,"name":"Для дома"},{"id":4,"name":"Отдых"}]

2) http://lavarel/public/getItems?id=1
Результат:
[{"id":4,"name":"Мяч"}]

3) http://lavarel/public/auth?login=admin&password=123
Результат:
{"token":"75e96f5543eedecf93db5830224e10b9"}

4) http://lavarel/public/createCategory?name_new=test&token=75e96f5543eedecf93db5830224e10b9
Результат:
{"result":"category successfully created"}

5) http://lavarel/public/changeCategory?id=4&name_new=ОТДЫХ2&token=75e96f5543eedecf93db5830224e10b9
Результат:
{"result":"category successfully changed"}

6) http://lavarel/public/deleteCategory?id=2&token=75e96f5543eedecf93db5830224e10b9
Результат:
{"result":"category successfully deleted and ratio with items"}

7) http://lavarel/public/createItem?name_new=test2&ids_categories_new=1,2,3&token=75e96f5543eedecf93db5830224e10b9
Результат:
{"result":"item successfully created and ratio with categories"}

8) http://lavarel/public/changeItem?id=1&name_new=testtest&ids_categories_new=5,4&token=75e96f5543eedecf93db5830224e10b9
Результат:
{"result":"item successfully changed and ratio with categories"}

9) http://lavarel/public/deleteItem?id=5&token=75e96f5543eedecf93db5830224e10b9
Результат:
{"result":"item successfully deleted and ratio with categories"}

**Сколько на каждую часть проекта ушло времени**
1) Написание API на нативном PHP. (~3 часа)
2) Первый опыт с Laravel. Первый успешный api запрос. (~3часа)
3) Реализация всех остальных методов. (~1 час)
4) Создание консольной команды. (~2 часа)
5) Первый опыт с тестами в Laravel и phpunit. (~3 часа)
6) База данных. (~30 минут)
7) Git. (~30 минут)

P.S. В связи с нехваткой времени, тестами я покрыть код не успел... По логике, нужно сделать тесты на все возможные ситуации, для которых я делал обработчики. У меня был опыт тестирования на джаве, и я там так делал... Во время выполнения задания получил опыт в некоторых штуках :-)
P.S.S. Дамб базы данных так же лежит в проекте. (dump.sql)
