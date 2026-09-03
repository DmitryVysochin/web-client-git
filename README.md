# Web Client Git

Веб-клиент для управления Git-репозиторием на удалённом сервере. Приложение подключается к серверу по SSH (без установки агентов на сервер), выполняет там git-команды и показывает результат в браузере: статус рабочей директории, diff по файлам, историю коммитов, список веток — с возможностью переключения веток, коммита выбранных файлов, `push`/`pull` (и force push) в origin.

Построено на Laravel 8. Пользователь может хранить несколько подключений (SSH + Git-учётные данные + путь до репозитория) и переключаться между ними.

## Как это работает

1. Пользователь регистрируется/авторизуется в приложении (собственная таблица `users`).
2. В разделе подключений создаётся "коннект" — IP, SSH-порт, SSH-логин/пароль, логин/пароль от Git, путь до репозитория на сервере (`app/Http/Controllers/Connect/ConnectSSHController.php`).
3. При открытии `/desktop` приложение по SSH ([phpseclib3](https://github.com/phpseclib/phpseclib)) заходит на сервер и выполняет `git status`, `git branch`, `git log` (`app/Classes/GitConnect.php`, `app/Classes/GitParser.php`), результат разбирается и отображается в интерфейсе (`app/Classes/GitManager.php`).
4. Действия из интерфейса (checkout ветки, commit, push, pull) отправляются AJAX-запросами на соответствующие роуты и выполняются на сервере через ту же SSH-сессию.

SSH-пароль и id текущего подключения хранятся в сессии (`session('passwordSsh')`, `session('currentConnect')`) и заново используются при каждом запросе к серверу.

## Стек

- **Backend:** PHP 7.3+/8.0, Laravel 8, [phpseclib/phpseclib](https://phpseclib.com/) 3.x (SSH-подключение), Laravel Sanctum
- **Frontend:** Blade, Bootstrap 5, jQuery, Laravel Mix (webpack)
- **База данных:** MySQL (или другая, поддерживаемая Eloquent)

## Требования

- PHP >= 7.3 (или 8.0) с расширениями, необходимыми Laravel 8
- Composer
- Node.js + npm
- MySQL (или другая СУБД, настроенная в `.env`)
- SSH-доступ к серверу(ам), на которых будет управляться git-репозиторий, и установленный на них `git`

## Установка

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate
```

Настроить подключение к базе данных в `.env` (`DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), затем накатить миграции:

```bash
php artisan migrate
```

Собрать фронтенд-ассеты:

```bash
npm run dev      # разработка
npm run watch    # разработка с автопересборкой
npm run prod     # production-сборка
```

Запустить приложение:

```bash
php artisan serve
```

## Использование

1. Зарегистрировать пользователя (`/registration`) и авторизоваться (`/login`).
2. Добавить подключение к серверу: IP, SSH-порт (по умолчанию 22), SSH-логин/пароль, логин/пароль от Git, путь до директории с репозиторием.
3. Перейти в `/desktop` — приложение подключится по SSH и покажет текущий статус репозитория, ветки и историю коммитов.
4. Выбрать изменённые файлы и закоммитить их, переключить ветку, выполнить `push`/`pull` — всё выполняется на удалённом сервере через SSH.

## Структура проекта

```
app/Classes/
  SshConnect.php     — базовое SSH-подключение (phpseclib3)
  GitConnect.php      — git-команды поверх SSH (status/diff/log/branch/commit/push/pull/checkout)
  GitManager.php      — обработка сырого вывода git-команд в структуры для UI
  GitParser.php        — парсинг вывода status/log/remote
  Tools.php

app/Http/Controllers/
  Connect/ConnectSSHController.php  — управление подключениями и git-операции (роуты connect.*, git.*, user.desktop)
  LoginController.php, RegisterController.php — аутентификация пользователей

app/Models/
  Connect/ConnectSSHModel.php  — модель сохранённых подключений (таблица connects)
  User.php

resources/views/
  userlogin.blade.php, userregistration.blade.php  — вход/регистрация
  connectlogin.blade.php                            — форма добавления подключения
  desktop.blade.php                                 — основной экран git-клиента
```

## Тесты

```bash
php artisan test
```

## Безопасность

SSH- и Git-пароли подключений хранятся в базе данных и сессии в открытом виде — приложение рассчитано на использование в доверенном окружении (внутренняя инфраструктура), а не как публичный сервис.
