средствами laravel (php 7+, mysql) необходимо разработать часть магазина

1. модели (в том числе миграции для создания структуры в бд):
1.1. модель товара [наименование, описание, цена, кол-во на складе]
1.2. модель покупателя [имя, email, кол-во денег/баллов] (можно взять готовые модели User и доработать)
1.3. модель заказа [номер, статус, дата, ссылка на покупателя, резерв товаров с фиксацией цен]
1.4. любые дополнительные модели какие вы считаете нужными

2. эндпоинты в формате json:
2.1 /catalog - выдача списка товаров
2.2 /create-order - создание заказа (в теле запроса перечисление товаров и их кол-ва), товары должны быть зарезервированы за покупателем
2.3 /approve-order - списать с баланса покупателя сумму за товары, сменить статус заказа

В рамках тестового задания не требуется делать систему защищенной аутентификации, при заказе просто передается id пользователя.
Так же не требуется создавать методы для создания/редактирования/удаления/просмотра моделей - заполнение бд через seeder (т е необходимы только эндпоинты описанные выше)

Результат выложить на GitHub. 