## DDD-demo

[English README](https://github.com/acwstudio/DDD-demo/blob/ddd_v1/README.md)

[Вступление](#intro)

[Файловая структура](#file_structure)

[Готовим фронтенд для Shop](#shop_frontend)

### Вступление 

<a name="intro"></a>
В данном проекте я попытаюсь на практике создать такую архитектуру приложения Laravel, которая позволит вести
командную разработку средних и больших проектов и облегчит взаимодействие с менеджментом и заказчиками. 

В общих чертах, это будет приложение, разделенное на доменный слой и слой приложения. Внутри каждый слой будет 
подробно детализирован с применением различных паттернов. Для определенности приложение будет E-Shop.

На начальном этапе, планируется создать систему управления пользователями. Пользователи будут двух разных типов:

- **`admins`** Администраторы для управления приложением
- **`customers`** Обычные пользователи приложения

У каждого типа пользователя будет свой круг задач, для осуществления которых будут предусмотрены свои функции 
и ограничения. Это будет два отдельных домена. 

Слой приложения будет включать в себя два типа приложения:

- **`Http`** приложение обрабатывающее запросы **`Http`** клиентов
- **`Console`** приложение для обработки консольных команд

Что и как из этого получится сейчас посмотрим. Чтобы данное описание не распухало, я не буду включать сюда код,
все сделанные изменения очень удобно смотреть в коммитах.

### Файловая структура
<a name="file_structure"></a>

Дефолтную структуру Laravel придется кардинально изменить. В процессе ребилдинга будут вырисовываться контуры 
будущего приложения. Начнем с глобальных шагов и вместо одной корневой директории **`app`** создадим три 
новых корневых папки 
- **`app/App`** для слоя приложений
- **`app/Domains`** для доменного слоя
- **`app/Support`** пока не знаю зачем, но думаю пригодится

Теперь отредактируем файл **`composer.json`**. Перенесем все содержимое из директории **`app`**, кроме вновь 
созданных директорий разумеется, в директорию **`app/App`**. Не забываем сделать **`composer dump-autoload`**

Сделаем коммит [#1](https://github.com/acwstudio/DDD-demo/commit/e3a041d5e2873cfcb405c1f8b4d31d1f87511dd1)

Продолжим. Внутри **`App/Http`** создадим две директории:

- **`App/Http/AdminPanel`** панель управления для пользователей **`admins`**
- **`App/Http/Shop`** то, что видят пользователи **`customers`**
 
Внутри созданных директорий, организуем модульную структуру. Первыми модулями будут модули управления 
пользователями **`Admins`** и **`Customers`**.

- **`App/Http/AdminPanel/Admins`** 
- **`App/Http/Shop/Customers`** 

Класс **`App/Http/Controllers/Controller.php`** вынесем в директорию **`App/Http/Controller.php`**

Директорию **`App/Http/Controllers`** перенесем и в **`App/Http/AdminPanel/Admins/Controllers`** и в 
**`App/Http/Shop/Customers/Controllers`**

Сделаем коммит [#2](https://github.com/acwstudio/DDD-demo/commit/41ce7ed6a9d7a4f8a8238d5f53595d6ff3de23ac)

На этом со слоем **`App`** пока остановимся и перейдем к слою **`Domain`** и создадим следующие директории

- **`Domain/Admins/Models`** домен **`Admins`** с директорией для **`Models`**
- **`Domain/Customers/Models`** домен **`Customers`** с директорией для **`Models`**

Дефолтную директорию **`App/Models`** вместе с моделью **`User.php`** удаляем. У нас будет два типа пользователей 
и две модели **`Admin.php`** и **`Customer.php`**. К их созданию перейдем чуть позже. 

Сделаем коммит [#3](https://github.com/acwstudio/DDD-demo/commit/3fc71cd7d93e54dae148d6ac10a18fed8c17aea4)

### Готовим фронтенд для Shop 
<a name="shop_frontend"></a>

Прежде чем приступить к этому шагу, пофиксил немного грамматику в README.ru.md

Начнем с фронтенда для Shop. У меня есть уже собраный макет со всеми необходимыми **`html`**, **`css`** и 
**`js`** файлами, а также всеми библиотеками и плагинами. Я не имею возможности установить этот макет с помощью
**`npm`** и я сделаю это ручками. Создадим файловую структуру.

- удалим дефолтные **`resources/css`** и **`resources/js`** директории.
- создадим директорию **`resources/shop`** где разместим ассеты темы
- создадим директорию **`resources/views/shop`** куда будем класть шаблоны темы

Некоторые файлы нам будут нужны в директории **`public`**. Копирование нужных файлов в определенные директории 
папки **`public`** будет производится с помощью файла **`webpack.mix.js`**. Для того, чтобы эти файлы не попадали 
в репозиторий, создадим эти директории заранее и разместим там файлы **`.gitignore`**. 

Файловая структура будет постепенно дополняться по мере продвижения проекта, все изменения смотрите в коммитах.

Отредактируем **`webpack.mix.js`** и запустим команду `npm install && npm run dev` 

**Примечание** Директория **`public/shop/images`** автоматически не копируется, картинки являются контентом и 
заполняются ручками (в реале через админку).

Сейчас сделаем стартовую страницу для приложения Shop и отредактируем файл **`routes/web/php`**, указав в роуте 
новый **view** шаблон.

Очень много файлов было создано и отредактировано, внимательно смотрите в коммите

Сделаем коммит [#4](https://github.com/acwstudio/DDD-demo/commit/a4c8e682550375e656d0df9740e2c0c60115d279)

### Несколько слов о регистрации вообще.

То, что предложено в Laravel 8 для аутентификации из коробки, стало уже слишком выморочно и крепко завязано на 
фронтенд технологии. Я беру Laravel чтобы написать серверное приложение, а мне предлагается начать разбираться 
в очередных новомодных фреймворках фронтенда. Хотя, вроде как предлагается пакет **`Fortify`**, который типа
**`frontend agnostic`**. Пакет обеспечивает весь набор возможностей, которые предлагались и раньше, но при этом 
плодит какую-то параллельную реальность c жутким оверхедом. Я так подозреваю, что оверхед этот для согласованной 
работы в составе с **`Jetstream`**, так что так себе **`frontend agnostic`**. Боже, зачем все это??? 

Поэтому отнесем это уродство на помойку и попробуем создать свою систему регистрации и аутентификации через 
нормальное место, а именно, через **`Route`**, **`Controller`** с логикой, вынесенной в отдельные классы, чтобы 
можно было эту логику использовать и в консольном приложении. Учитывая тот факт, что у нас два разных типа 
пользователя которые реализуют каждый свою логику, такой подход будет понятен и предсказуем.

Чтобы фреймворк различал эти два типа, необходимо для каждого из них задать в файле **`config/auth.php`** 
свои **`guard`**, **`provider`** и **`passwords`**

### Аутентификация пользователя типа `customer`

Установим пакет **`laravel-ide-helper`** для нормальной работы **PHPStorm** с фасадами

Создадим модель **`Domain/Customers/Models/Customer.php`** и миграцию для таблицы **`customers`**, выполним
**`php artisan migrate`**

Для заполнения таблицы фейковыми пользователями создадим файлы **`database/factories/CustomerFactory.php`** и 
**`database/seeders/CustomerSeeder.php`**, удалим ненужный **`database/factories/UserFactory.php`**. 

**Примечание** Во время выполнения команды **`php artisan db:seed --class=CustomerSeeder`** выскакивает ошибка 
**`Class 'Database\Factories\Domain\Customers\Models\CustomerFactory' not found`**. Из сообщения видно, что 
неправильно определяется полное имя класса **`CustomerFactory`**. Это связано с тем, что мы используем для
моделей кастомные директории, чтобы пофиксить проблему, надо кое-что дописать в
**`App/Providers/AppSeviceProvider`** подробности см [здесь](https://stackoverflow.com/questions/64445875/laravel-8-vendor-class-illuminate-database-eloquent-factories-factory-cant-re)

Выполним **`php artisan db:seed --class=CustomerSeeder`** и получаем набор фейковых зарегистрированных 
пользователей. Далее редактируем файл **`config/auth.php`**, в котором зададим для пользователя **`customer`** 
свой **`guard`**, **`provider`** и **`passwords`**. Все готово для создания аутентификации.

Сделаем коммит [#5](https://github.com/acwstudio/DDD-demo/commit/5600edb0b7d5a5be022f6260901a6769caa7ba21)

Прежде чем приступить к созданию аутентификации, определим функциональный перечень:

- вывод формы **LogIn**
- валидация данных
- ограничения на количество попыток залогиниться
- аутентификация
- разлогинивание

Чтобы не придумывать все самим, позаимствуем многое из прежних версий **Laravel**.

**Вывод формы LogIn**

- создадим контроллер **`App/Http/Shop/Customers/Controllers/ShopLoginController.php`** с методом 
**`showLoginForm`**
- в файле **`routes/web.php`** укажем роут к этому методу
- создадим шаблон **`resources/views/shop/auth/customer-login.blade.php`** для формы **LogIn**

При создании контроллера я призадумался, а так ли уж необходим **`App/Http/Controller.php`**? Он является 
промежуточным звеном в цепи наследования от вендорного **`Illuminate/Routing/Controller.php`** и внутри себя 
содержит несколько трейтов и больше ничего. Не факт, что мне будут нужны все эти трейты, а если что-то 
потребуется я всегда смогу вставить нужный трейт в конкретный контроллер, и наследовать вендорный класс 
напрямую. Отказываться от вендорного класса не будем, он позволяет применять **`Middlweare`** в контроллерах. 
Пожалуй так и сделаем. Удаляем **`App/Http/Controller.php`** и наследуем вендорный класс.

Набираем в броузере **`http://localhost:8004/login`** Все ОК форма появилась.

Сделаем коммит [#6](https://github.com/acwstudio/DDD-demo/commit/67750e400c3352b2a90c4a96d9e54660cb5765e3)

**Валидация данных**

Создадим класс **`App/Http/Shop/Customers/Requests/ShopLoginRequest.php`** который будет отвечать за валидацию.

В контроллере **`App/Http/Shop/Customers/Controllers/ShopLoginController.php`** создадим пока пустой метод 
**`login`**, инжектим в него созданный **`App/Http/Shop/Customers/Requests/ShopLoginRequest.php`** и вернем 
**`$request->all()`**. В файле **`routes/web.php`** укажем роут к этому методу. Проверим как работает валидация, 
наберем пароль меньше 8 знаков, а затем 8 или больше. Валидация работает.

Сделаем коммит [#7](https://github.com/acwstudio/DDD-demo/commit/110d71b253e407de01621bc1203cefa59ff18dda)

**Ограничения на количество попыток залогиниться**

За основу возьмем трейт **`ThrottlesLogins.php`** из пакета **`laravel/ui`**. Скопипастим его в директорию 
**`App/Http/Shop/Customers/Traits/ThrottlesLogins.php`** нашего проекта и подключим в контроллере
**`App/Http/Shop/Customers/Controllers/ShopLoginController.php`**. Недостающие в контроллере 
**`ShopLoginController.php`** методы для работы с трейтом **`ThrottlesLogins.php`**, возьмем в другом трейте 
**`AuthenticatesUsers`** из того же пакета **`laravel/ui`**.

Дополним код метода **`login`** кодом из трейта **`AuthenticatesUsers`**, но только в той части, которая 
касается работы трейта **`ThrottlesLogins.php`** и не выполняет реальной попытки аутентификации, считая любую 
попытку неудачной просто выводя в браузер строку.

Заполним форму любыми данными и отправим их. Получаем строку с неким текстом в браузере. Обновляем страницу. до 
тех пор, пока нас не вернет на страницу с формой **LogIn** и сообщением об ошибке, что мы превысили количество 
разрешенных попыток и покажет через какое время мы сможем продолжить попытки.

Сделаем коммит [#8](https://github.com/acwstudio/DDD-demo/commit/d1790e7094ad01b5e6c769d067e56aafab9c314a)

**Аутентификация пользователя**

Дополним **`App/Http/Shop/Customers/Controllers/ShopLoginController.php`** необходимым кодом, взятым из 
**`AuthenticatesUsers`** пакета **`laravel/ui`**. Добавим строки и заменим **`return`** в методе 
**`login`** и скопируем с нбольшими исправлениями еще ряд методов. Так же напишем пару строчек своего кода 
(одно свойство и конструктор). Еще один метод возьмем из трейта **`RedirectsUsers`** все того же пакета 
**`laravel/ui`**. 

Поправим путь для редиректа после завершения аутентификации в **`App/Providers/RouteServiceProvider.php`**

Методы связанные с разлогиниванием копировать не будем, их отправим позже в отдельный контроллер, который 
создадим специально для разлогинивания. Так же нам не нужен метод для валидации, потому что у нас есть класс 
**`App/Http/Shop/Customers/Requests/ShopLoginRequest.php`**.

Возьмите из базы данных, какого-нибудь фейкового Customer и залогиньтесь. Если перебросило на главную страницу 
значит аутентификация прошла нормально. Все работает. Попробуйте зайти на страницу `/login`, если сразу 
перебросило обратно на главную, то вы точно аутентифицированы. Чтобы разлогиниться запустите 
**`php artisan db:seed --class=CustomerSeeder`**

Немного подправил **`database/seeders/CustomerSeeder.php`** чтобы при выполнении 
**`php artisan db:seed --class=CustomerSeeder`** выводились emails фейковых Customers. Теперь не надо лезть за 
ними в базу данных.

Сделаем коммит [#9](https://github.com/acwstudio/DDD-demo/commit/7731de0a071a1b18c3bddc106272bb20b87ecae1)

**Разлогинивание пользователя**

Добавим новый роут в файле **`routes/web.php`**. Создадим контроллер
**`App/Http/Shop/Customers/Controllers/ShopLogoutController.php`** и скопируем туда методы из трейта 
**`AuthenticatesUsers`** все того же пакета **`laravel/ui`**. Может что-то подправить надо будет. В принципе, 
разлогинивание готово, осталось только форму и кнопку для отправки запроса на фронтенде сделать.

Доработаем главную страницу **`resources/views/shop/pages/shop.blade.php`** чтобы иметь возможность из меню 
переходить на форму **Log In**, показывать аутентифицированному пользователю кнопки, недоступные гостю, в том 
числе и **Log Out**.

Проверяем все работает, теперь для гостя появился в меню пункт **Log In** и скрыта правая часть с корзиной, а 
для аутентифицированного пользователя скрыта кнопка **Log In**, но открыта корзина и появилась кнопка **Log Out**

Сделаем коммит [#10](https://github.com/acwstudio/DDD-demo/commit/d634a7e5488e4d30a3661bbb9d6159bb6131332b)

### Регистрация пользователя типа `customer`

Определим функциональный перечень:

- вывод формы **Register**
- валидация данных
- регистрация
- верификация по email

**Вывод формы Register**

- создадим контроллер **`App/Http/Shop/Customers/Controllers/ShopRegisterController.php`** с методом 
**`showRegisterForm`**
- в файле **`routes/web.php`** укажем роут к этому методу
- создадим шаблон **`resources/views/shop/auth/customer-register.blade.php`** для формы **Register**

Жмем пункт меню **Register** все работает.

Сделаем коммит [#11](https://github.com/acwstudio/DDD-demo/commit/61cab34529da3e84f14b307bbf436a774dded12b)

**Валидация данных**

Создадим класс **`App/Http/Shop/Customers/Requests/ShopRegisterRequest.php`** который будет отвечать за валидацию.

В контроллере **`App/Http/Shop/Customers/Controllers/ShopRegisterController.php`** создадим пока пустой метод 
**`register`**, инжектим в него созданный **`App/Http/Shop/Customers/Requests/ShopRegisterRequest.php`** и вернем 
**`$request->all()`**. В файле **`routes/web.php`** укажем роут к этому методу. Проверим как работает валидация, 
наберем пароль меньше 8 знаков, или email, который уже существует и проч.

Сделаем коммит [#12](https://github.com/acwstudio/DDD-demo/commit/3a5d31b00375d21a27c83ee982adada80d7bdba3)

**Регистрация пользователя**

Кое-что возьмем готовое из пакета **`laravel/ui`**, в частности, метод **`register`** скопируем из трейта 
**`RegistersUsers.php`**, но с некоторыми исправлениями. Возьмем оттуда же еще несколько методов и напишем 
немного своего кода. В модели **`Domain/Customers/Models/Customer.php`** временно закомментим подстроку  
`implements MustVerifyEmail` в описании класса. Это отключит верификацию по email, которая у нас еще не 
работает. 

Проверяем работу регистрации. Все работает.

Сделаем коммит [#13](https://github.com/acwstudio/DDD-demo/commit/e29a19cbe28d21278e04e63a8924347fbc8d7ad3)

**Верификация по email**

Раскомментим подстроку `implements MustVerifyEmail` в описании класса **`Domain/Customers/Models/Customer.php`**. 

Сейчас роут на главную страницу приложения **Shop** не использует контроллер. Создадим контроллер 
**`App/Http/Shop/ShopHomeController.php`**  

Переходим к верификации:

- создадим контроллер **`App/Http/Shop/Customers/Controllers/ShopVerifyController.php`** с методами 
**`show`**, **`verify`**, **`resend`**, 
- в файле **`routes/web.php`** укажем роуты к этим методам
- создадим шаблон **`resources/views/shop/auth/customer-verify.blade.php`** для формы **Verify**

Все изменения внимательно смотрим в коммите. За основу был опять взят пакет **`laravel/ui`** и его трейт 
**`VerifiesEmails.php`**

Пробуем зарегиться, после регистрации отправляется email для верификации и сразу перебрасывает на страницу 
с сообщением что необходимо посмотреть почту и пройти верификацию. Если email по каким-то причинам не пришел 
можно сделать запрос еще одного.

Сделаем коммит [#14](https://github.com/acwstudio/DDD-demo/commit/28f3a860c29c99de61628da565a169916938ad48)

### Сброс пароля

- создадим контроллер **`App/Http/Shop/Customers/Controllers/ShopForgotPasswordController.php`** 
- скопируем туда все методы из трейта **`SendsPasswordResetEmails`** пакета **`laravel/ui`** и поправим где надо. 
- в файле **`routes/web.php`** укажем роуты к этим методам
- создадим шаблон **`resources/views/shop/auth/customer-email.blade.php`** для формы **Send Password Reset Link**
- создадим контроллер **`App/Http/Shop/Customers/Controllers/ShopResetPasswordController.php`** 
- скопируем туда все методы из трейта **`ResetsPasswords`** пакета **`laravel/ui`** и поправим где надо.
- в файле **`routes/web.php`** укажем роуты к этим методам
- создадим шаблон **`resources/views/shop/auth/customer-reset.blade.php`** для формы **Reset Password**

На форме **Log In** жмем на ссылку **Forgot your Password** и проходим процедуру сброса пароля. Все работает. 

Сделаем коммит [#15](https://github.com/acwstudio/DDD-demo/commit/9e3b5df9847c15c51f75317a3583e31aa527337e)

### Обсудим полученый результат

- Файловая структура приобрела упрядоченый вид, что позволяет без труда найти местоположение кода регистрации и 
аутентификации пользователей приложения **Shop**. 
- Весь код сосредоточен в одном месте и более прозрачен для изменений и понимания логики работы. В то время 
как использование пакетов аутентификации размазывает код между приложением и пакетом, затуманивает прозрачность 
кода магией внутри пакета, делая многие вещи за программиста (например вместо явного написания роутов в файле 
**`routes/web.php`** вызывается метод auth(), который содержит все роуты внутри пакета).
- Роуты прописаны явным образом в файле **`routes/web.php`**.

Тем не менее, есть поводы для проведения рефакторинга. Контроллеры перегружены логикой, применение трейта 
**`ThrottlesLogins.php`**, хоть визуально и разгружает код контроллера 
**`App/Http/Shop/Customers/Controllers/ShopLoginController.php`**, в реальности лишь затрудняет прослеживание 
взаимодействия методов.

Займемся рефакторингом.

### Рефакторим модуль `Customers`

Начнем с того, что переделаем трейт **`App/Http/Shop/Customers/Traits/ThrottlesLogins.php`** в класс 
**`App/Http/Shop/Customers/Services/ThrottlesLoginsService.php`**, который затем инжектим в конструкторе 
контроллера **`App/Http/Shop/Customers/Controllers/ShopLoginController.php`**

Теперь методы, используемые для ограничения неудачных попыток залогиниться, более очевидны в коде контроллера 
и это облегчает программисту жизнь.

Трейт **`App/Http/Shop/Customers/Traits/ThrottlesLogins.php`** удалим

Сделаем коммит [#16](https://github.com/acwstudio/DDD-demo/commit/84082f94b79016bb3c1deffa6dcd38a83afa289f)

После того как сделал коммит обратил внимание, что класс **`ThrottlesLogins.php`**, будет более логично 
переименовать в **`ShopThrottlesLoginsService.php`**

Следующим шагом вынесем всю логику из контроллера **`App/Http/Shop/Customers/Controllers/ShopLoginController.php`** 
в отдельный сервисный класс **`App/Http/Shop/Customers/Services/ShopLoginService.php`**. Отлично, наш контроллер 
теперь не занят множеством обязанностей и выглядит лаконично.

Вполне возможно, что мы еще вернемся и продолжим рефакторинг уже класса 
**`App/Http/Shop/Customers/Services/ShopLoginService.php`**, если к этому будут предпосылки

Сделаем коммит [#17](https://github.com/acwstudio/DDD-demo/commit/d737436c33e158cabf5290f92b639a3d957e2bcf)

Продолжим с контроллером **`App/Http/Shop/Customers/Controllers/ShopRegisterController.php`**, так же вынесем 
логику в сервисный класс **`App/Http/Shop/Customers/Services/ShopRegisterService.php`**. В принципе 
**`ShopRegisterController.php`** не столь уж громоздкий, но есть одна фишка, если нам, например, понадобиться 
произвести регистрацию из консоли, то мы используем этот сервисный класс.

Сделаем коммит [#18](https://github.com/acwstudio/DDD-demo/commit/914316d646bcd2bd43b3d6a997407bba2bea9ff9)

Переходим к рефакторингу верификации по email. Выносим логику из контроллера 
**`App/Http/Shop/Customers/Controllers/ShopVerifyController.php`** в сервисный класс
**`App/Http/Shop/Customers/Services/ShopVerifyService.php`**

Проверяем, все работает

Сделаем коммит [#19](https://github.com/acwstudio/DDD-demo/commit/ff00ba26acb6360fbfefa77054236122068f2480)

Рефакторим сброс пароля.

Создаем два сервисных класса **`App/Http/Shop/Customers/Services/ShopResetPasswordService.php`** и 
**`App/Http/Shop/Customers/Services/ShopForgotPasswordService.php`** куда выносим соответственно логику из
контроллеров **`App/Http/Shop/Customers/Controllers/ShopResetPasswordController.php`** и 
**`App/Http/Shop/Customers/Controllers/ShopForgotPasswordController.php`**

Проверяем, все работает

Сделаем коммит [#20](https://github.com/acwstudio/DDD-demo/commit/98e411304b200e8524b8fe0ca5172c4bcd3ef058)

### Новый рефакторинг модуля **`Customers`**

Данный рефакторинг будет связан с решением перенести сервисные классы модуля из слоя приложения в доменный слой.
 
Поводом послужила вот эта [статья](https://stitcher.io/blog/laravel-beyond-crud-03-actions). Логика следующая. 
Допустим мы захотим дать админам возможность регистрировать пользователя из консоли. Отлично, у нас уже есть 
сервисный класс **`App/Http/Shop/Customers/Services/ShopRegisterService.php`**, который мы можем использовать в 
консольном приложении, но, согласитесь, как-то странно, что этот класс будет использован в разных приложениях,
но принадлежать модулю одного из этих приложений. Логично, если он не будет принадлежать ни одному из приложений, 
а будет принадлежать некой третьей стороне. такой стороной, очевидно может быть домен **`Customers`**.

В выше указаной статье, предлагается называть такой класс не сервисом, а экшеном. Эта статья является третьей в 
серии статей о **DDD style** в **Laravel**. Вот ссылка на первую статью под названием
[Domain oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel).

Таким образом, перенесем все сервисные классы в доменный слой как экшены

- **`Domain/Customers/Actions/CustomerRegisterAction.php`** 

сделаем коммит [#21](https://github.com/acwstudio/DDD-demo/commit/1bc6095ab268c47d4774ab2786cbe8e28c0418f7)

- **`Domain/Customers/Actions/CustomerLoginAction.php`**

Интересная ситуация возникла с **`App/Http/Shop/Customers/Services/ShopThrottlesLoginsService.php`**, потому что 
этот класс реально сервис, а не экшен. Пожалуй что настало время воспользоваться **`app/Support`**. 

- **`Support/ThrottlesLoginsService.php`** 

сделаем коммит [#22](https://github.com/acwstudio/DDD-demo/commit/75957b8c14b848bb653e87749327965d95f504c9)

Сервисный класс **`App/Http/Shop/Customers/Services/ShopVerifyService.php`** по сути содержит два экшена 
**`startVerify`** и **`startResend`** поэтому разобъем его на два экшена.

- **`Domain/Customers/Actions/CustomerVerifyAction.php`**
- **`Domain/Customers/Actions/CustomerResendAction.php`**

сделаем коммит [#23](https://github.com/acwstudio/DDD-demo/commit/051e796369e97e40b2b86a37b622300642024af6)

Последние два экшена

- **`Domain/Customers/Actions/CustomerForgotPasswordAction.php`**
- **`Domain/Customers/Actions/CustomerResetPasswordAction.php`**

Сделаем коммит [#24](https://github.com/acwstudio/DDD-demo/commit/69261fad95ef4a7e2e228ea3f9ab2d514010f33d)

На этом пока оставим **`Customers`** в покое и перейдем к **`Admins`**

### Подготовка к подключению другого типа пользователей

Каждый тип пользователей будет иметь:

- свой способ управления **`drivers`**, например, сеансы или токены
- свой **`provider`**, например, **`eloquent`** или **`database`**
- все вместе это называется **`guard`**

В настоящий момент используется настройка **`defaults`**, которая настроена на пользователей **`Customers`**. 
Это настройка позволяет не указывать **`guard`** явно. Сейчас мы настроим еще один **`guard`** для **`Admins`**, 
который надо будет указать явно. По аналогии, для большей ясности, укажем **`guard`** для **`Customers`** тоже 
явно. Для этого потребуется некоторый рефакторинг. Итак приступим:

- создадим класс **`Domain/Admins/Models/Admin.php`** и настроим **`guard`** для **`Admins`**.
- создадим миграцию для таблицы **`admins`**
- создадим **`database/factories/AdminFactory`** фабрику фейковых админов
- создадим **`database/seeders/AdminSeeder`** для наполнения базы данных фейковыми админами

Выполним **`php artisan migate`** а потом **`php artisan db:seed --class=AdminSeeder`**

Несколько фейковых админов появились в базе данных.

сделаем коммит [#25](https://github.com/acwstudio/DDD-demo/commit/b1f4f179b120570f8a33b66652abb28558dcf47f)

- проведем рефакторинг с целью явного указания **`guard`** для **`Customers`**.

Упс, обнаружилось, что контроллер **`App/Http/Shop/Customers/Controllers/ShopLogoutController.php`** не имеет 
экшена. Это не мешает ему правильно работать, но для единообразия, создадим ему экшен 
**`Domain/Customers/Actions/CustomerLogoutAction.php`**

сделаем коммит [#26](https://github.com/acwstudio/DDD-demo/commit/a7457e6bfb563ff4e4ee8ee010601f2077700219)

- разделение файла **`routes/web.php`** на два: **`routes/shop.php`** и **`routes/admin.php`** с очевидной целью 
разделить роуты для **Shop** и для **Admin Panel**. Это повлечет за собой некоторые правки в 
**`App/Providers/RouteServiceProvider.php`**. может еще где, смотрите коммит.

сделаем коммит [#27](https://github.com/acwstudio/DDD-demo/commit/cbeab01e8b7898f65a499cb81910fca533e3b944)

### Готовим фронтенд для Admin Panel

В качестве темы для **Admin Panel** возьмем бесплатную **Admin LTE**. Начнем с того, что установим ее с 
помощью пакетного менеджера **`npm install admin-lte@^3.0 --save`**

- подготовим файловую структуру в директории **`public`**
- отредактируем **`webpack.mix.js`** выполним **`npm install && npm run dev`**
- подготовим файловую структуру для шаблонов **`resources/views/admin/`**
- разместим шаблоны

сделаем коммит [#28](https://github.com/acwstudio/DDD-demo/commit/0304dc44b2fd4701524553c38eec02c5d19dd9ed)

### Особенности пользователей  типа `admins`

Данный тип пользователей, это админы, которые будут заниматься управлением и поддержкой сайта через Админ 
панель. В связи с этим они имеют ряд особенностей:

- небольшое и ограниченное количество пользователей
- для каждого пользователя будет своя роль с набором разрешений
- отсутствует возможность самостоятельной регистрации
- зарегистрировать нового пользователя может только пользователь с ролью **`super-admin`**
- регистрацию можно производить как через форму приложения **`AdminPanel`**, так и через консольное приложение

### Аутентификация пользователя типа `admins`

Отредактируем **`App/Providers/RouteServiceProvider.php`** добавим **`const = HOME_ADMIN`** и переименуем 
**`const = HOME`** в **`const = HOME_SHOP`**. Соответственно, отредактируем везде где эта константа 
использовалась.

Отредактируем **`App/Http/Middleware/RedirectIfAuthenticated.php`**, добавив логику в зависимости от **`guard`**

Отредактируем **`App/Http/Middleware/Authenticated.php`**, добавив логику в зависимости от типа пользователя

- Создадим роуты в файле **`routes/admin.php`**
- Создадим контроллер **`App/Http/AdminPanel/Admins/Controllers/AdmunLoginController`**
- Создадим экшен **`Domain/Admins/Actions/AdmunLoginAction`**
- создадим валидационный класс **`App/Http/AdminPanel/Admins/Requests/AdmunLoginRequest`**
- создадим шаблон страницы **Log In**
- создадим **`App/Httml/AdminPanel/AdminHomeController.php`** и поправим роут.

сделаем коммит [#29](https://github.com/acwstudio/DDD-demo/commit/3f3698f5b7a0dcf72b1ceddb74e10301d19d797d)

### Разлогинивание пользователя типа **`admins`**

- Создадим роут в файле **`routes/admin.php`**
- Создадим контроллер **`App/Http/AdminPanel/Admins/Controllers/AdmunLogoutController`**
- Создадим экшен **`Domain/Admins/Actions/AdmunLogoutAction`**

сделаем коммит [#30](https://github.com/acwstudio/DDD-demo/commit/afb59de5b16e9069fc5babee5b7da4d0f6d2ee09)

### Регистрация пользователя типа **`admins`**

Регистрацию нового пользователя может производить только пользователь с ролью **`super-admin`**. Таким образом,
прежде чем делать регистрацию, необходимо добавить функционал для создания ролей с разрешениями и присвоения их 
пользователям. Воспользуемся готовым решением, пакетом **`spatie/laravel-permission`**. Подробная документация 
[здесь](https://spatie.be/docs/laravel-permission/v3/installation-laravel). Установим пакет.

После установки доработаем **`database/seeders/AdminSeeder.php`** с учетом нового функционала. 

- создадим конфигурационный файл с набором значений для ролей и разрешений **`congig/roles-set.php`**
- создадим **`database/seeders/RoleSeeder.php`**
- создадим **`database/seeders/PermissionSeeder.php`**
- рефакторим **`database/seeders/AdminSeeder.php`**
- добавим последовательность классов **`seeders`** в **`database/seeders/DatabaseSeeder.php`**

Выполним команду **`php artisan migrate:refresh --seed`**

сделаем коммит [#31](https://github.com/acwstudio/DDD-demo/commit/196977135d3514df56d2a559186e96ea3755276e)

**Регистрация через приложение `AdminPanel`**

- создадим роут в файле **`routes/admin.php`**
- создадим контроллер **`App/Http/AdminPanel/Admins/Controllers/AdmunRegisterController`**
- создадим экшен **`Domain/Admins/Actions/AdmunRegisterAction`**
- создадим валидационный класс **`App/Http/AdminPanel/Admins/Requests/AdmunRegisterRequest`**
- создадим шаблон страницы **Register**

сделаем коммит [#32](https://github.com/acwstudio/DDD-demo/commit/7e468366ac52ee862dbcebbab939a8f2dce9569b)

После коммита заметил, что роль на форме выбрать можно, но пользователю она не присваивается. Пофиксим это в 
экшене **`Domain/Admins/Actions/AdmunRegisterAction`**

сделаем коммит [#33](https://github.com/acwstudio/DDD-demo/commit/b471f1bdcfddf58dbb68bdb57c178917506658d6)

Следующий шаг - добавим отправку **email** вновь зарегистрированному админу с данными регистрации. 

- Создадим **`App/Http/AdminPanel/Admins/Mails/AdminRegisteredMail.php`**
- Создадим **`resources/views/admin/emails/admin-registered.blade.php`**

сделаем коммит [#34](https://github.com/acwstudio/DDD-demo/commit/d2789cd3a8809aebe73a1560958a7840ecbe84ad)

**Регистрация через консоль**

После коммита обратил внимание, что в случае регистрации админа нет необходимости редиректить на **HOME_ADMIN** 
и логиниться. Удалим все лишнее.

- Создадим класс для валидации введеных данных **`App/Console/Admins/AdminDataValidate.php`**
- Создадим команду для регистрации **`App/Console/Admins/Commands/AdminRegisterCommand.php`**

создадим коммит [#35](https://github.com/acwstudio/DDD-demo/commit/b88aff3078f44e375eee9c8359618e28acc41a08)

### Сброс пароля пользователя типа **`admins`**

**Сброс пароля через приложение `AdminPanel`**

Сброс пароля может сделать только админ с ролью **`super-admin`**. Фактически это редактирование пароля 
конкретного админа. Чтобы открыть форму с данными этого админа, необходимо в запросе указать его **id** в 
качестве параметра. Самый очевидный способ сделать такой запрос, это кликнуть нужную ссылку в строке списка 
админов. Выведем таблицу со списком всех админов.

- напишем роут в файле **`routes/admin.php`**
- создадим контроллер **`App/Http/AdminPanel/Admins/Controllers/AdminListController`**
- Создадим шаблон со списком админов

Сделаем сброс пароля

- Добавим в форму **LogIn** ссылку `Forgot Your Password?`
- Напишем роуты в файле **`routes/admin.php`**
- Создадим контроллер **`App/Http/AdminPanel/Admins/Controllers/AdminResetPasswordController.php`**
- Создадим экшен **`App/Domain/Admins/Actions/AdminResetPasswordAction.php`**
- Создадим валидационный класс **`App/Http/AdminPanel/Admins/Requests/AdminResetPasswordRequest.php`**
- Создадим шаблон формы для сброса пароля 

создадим коммит [#36](https://github.com/acwstudio/DDD-demo/commit/0f8c69f6106ede6f78903472de4805e2c9498589)

**Сброс пароля через Console`**

- Создадим команду для сброса пароля **`App/Console/Admins/Commands/AdminResetPasswordCommand.php`**

создадим коммит [#37](https://github.com/acwstudio/DDD-demo/commit/c7ce131c29f377633296c71210b911cfb9df9f59)

### Рефакторинг некоторых моментов

- Улучшение файловой структуры внутри **`resources/views/admins/pages`**. Сгруппируем шаблоны связанные с 
админами в директорию **`admins`**. Пофиксил по ходу дела мелкие недоработки в контроллерах с этими **`views`**

создадим коммит [#38](https://github.com/acwstudio/DDD-demo/commit/297deb66b4c95178274aa3356c67634d3dcc86bd)

### Применение паттерна **`View Model`** в слое **`App`**

**`View Model`** это классы которые несут ответственность за предоставление данных для **`views`**. Иначе эти 
данные поступают напрямую из контроллеров или модели предметной области. Этот паттерн позволяет сосредоточить 
обработку данных в отдельном классе, тем самым свести логику внутри **`views`** к минимуму. Кроме того, они 
позволяют лучше разделить проблемы и обеспечивают большую гибкость для разработчика. Боле подробно ознакомиться 
с паттерном можно [здесь](https://stitcher.io/blog/laravel-beyond-crud-08-view-models).

Установим пакет **`spatie/laravel-view-models`**. Этот пакет через свой класс **`ViewModel.php`** добавляет 
несколько методов и некоторой магии. Если ваш класс **`YourViewModel.php`** наследует класс пакета, то вы 
получаете функционал который немного упрощает написание собственных **View Models**.

**Приложение Shop**

- Создадим общий для приложения **Shop** класс **`App/Http/Shop/ShopViewModel.php`**. который будет наследовать 
класс **`ViewModel.php`** из пакета. В нем будут формироваться данные общие для всего приложения
- Создадим класс **`App/Http/Shop/Customers/ViewModels/CustomerViewModel.php`**, который будет наследовать 
**`App/Http/Shop/ShopViewModel.php`**. В этом классе будет добавлены данные о заголовке страницы. Он будет общим 
для модуля **Customers**.
- Рефакторим контроллеры и шаблоны с учетом использования нового паттерна.

По ходу дела пофиксил разные мелочи.

сделаем коммит [#39](https://github.com/acwstudio/DDD-demo/commit/f17d5f5ad9e71b35a18b06035882a885b48da44d)

**Приложение Admin Panel**

В приложении **Admin Panel** есть такая проблема, некорректно работает боковое меню. Нет подсветки активного 
пункта меню и группа к которой этот пункт принадлежит нераскрыта. Для того, чтобы все заработало корректно 
требуется подготовить данные для передачи во **`views`** и применить там некоторую логику. Конечно, можно еще 
доработать меню, с точки зрения его рендеринга, сделав его более динамическим, но оставим это на последующий 
рефакторинг, а сейчас попробуем с помощью **View Models** пофиксить проблему.

- Создадим общий для модуля **Admins** класс **`App/Http/AdminPanel/Admins/ViewModels/AdminViewModel`**. 
который будет наследовать класс **`ViewModel.php`** из пакета. В нем будут формироваться общие данные для всего 
модуля.
- Создадим классы конкретные классы **`App/Http/AdminPanel/Admins/ViewModels/AdminListViewModel.php`** b 
**`App/Http/AdminPanel/Admins/ViewModels/AdminRegisterViewModel.php`**
- Отредактируем контроллеры и шаблоны

Теперь наше меню, пока только в части **Admins**, работает корректно.

сделаем коммит [#40](https://github.com/acwstudio/DDD-demo/commit/f5bfb71558be9c3c305a1c1c988931a2f5d3b970)

После коммита, увидел что еще не все **ViewModels** сделал для модуля **Admins**.

- Создадим **`App/Http/AdminPanel/Admins/ViewModels/AdminResetPasswordViewModel.php`**
- Отредактируем другие участвующие классы.

сделаем коммит [#41](https://github.com/acwstudio/DDD-demo/commit/408a3eb92a982fd57d14b1ba22d78dfed8e9594c)

### Создание динамического меню

Все-таки статическое меню, заданное в шаблонах, уводит все дальше в плохую архитектуру. Придется делать билдер 
меню. Структуру меню я задам в конфигурационном файле, создавать фичи для создания и редактирования меню через 
**Admin Panel** нет оснований.

- зададим структуру меню в файле **`config/menu.php`**
- создадим миграцию для таблицы **`menu_administrators`**
- создадим класс **`database/seeders/MenuAdministratorSeeder.php`**

Далее пришлось многое рефакторить, описать процесс довольно сложно, поэтому смотрите коммит

сделаем коммит [#42](https://github.com/acwstudio/DDD-demo/commit/4389866f7759e95238f9fceaedecbad7cead20e3)

Дополним функционал возможностью банить пользователя типа **`Admin`**. Такую возможность будет иметь только админ 

**Банить пользователя через Admin Panel**

- добавим поле **`ban`** в таблицу **`admins`**
- добавим в нужные валидационные классы проверку на **`ban`**
- создадим контроллер **`App/Http/AdminPanel/Admins/Controllers/AdminBanController.php`**
- создадим форму **`resources/views/admin/pages/admins/ban.blade.php`**
- напишем роут в файле **`routes/admin`**
- добавим столбец **`Set Ban`** в **`resources/views/admin/pages/admins/list.blade.php`**
- создадим валидационный класс **`App/Http/AdminPanel/Admins/Requests/AdminBanRequest.php`**
- создадим кастомный **Rule** класс **`Domain/Admins/Rules/AdminPasswordVerifyRule.php`**
- создадим экшен **`Domain/Admins/Actions/AdminBanAction.php`**
- создадим **ViewModel** **`App/Http/AdminPanel/Admins/ViewModels/AdminBanViewModel.php`**

Может что-то упустил в описании, но нет времени на подробное изложение, смотрите коммит

сделаем коммит [#43](https://github.com/acwstudio/DDD-demo/commit/7ec187e50e99e0a438ba81f5676c6c51ca14d08b)

**Банить пользователя через Console**

- создадим команду **`App/Console/Admins/Commands/AdminBanCommand.php`**

создадим коммит [#44](https://github.com/acwstudio/DDD-demo/commit/42b39638c3381a4ad60f907f419453a6178f1ac3)

### Управление пользователями типа Customers через Admin Panel

**Вывод списка пользователей `Customers`**

- создадим контроллер **`App/Http/AdminPanel/Customers/Controllers/CustomerListController.php`**
- напишем роут в файле **`routes/admin`**
- создадим шаблон для списка **`customers`** в файле **`resources/views/admin/pages/customers/list.blade.php`**
- добавим пункты меню в **`config/menu-admin.php`**
- создадим **ViewModel** **`App/Http/AdminPanel/Customers/ViewModels/CustomerListViewModel.php`**

сделаем коммит [#45](https://github.com/acwstudio/DDD-demo/commit/23a4efcd40da04d385554824ec19dd2ac1850392)

Сделаем некоторый рефакторинг для создания меню и его наполнения

- рефакторинг конфига **`config/menu-admin`**
- рефакторинг **`database/seeders/MenuAdministratorSeeder.php`**

сделаем коммит [#46]()
