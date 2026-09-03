@include('header')
<?php

use App\Classes\Tools;

?>
<main>
    <div>
        <div id="notificationContainer" class="position-absolute top-0 p-3 m1 start-50 translate-middle-x" style="z-index: 11">
            @if(isset($error))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Notification!</strong>{{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
            @endif
        </div>
        <div class="container-fluid text-center" style="background-color: black;">
            <div class="row">
                <div class="col-2 border-end border-light" id="select-connect">
                    <div class="current-connect-b">
                        @if(isset($currentConnect))
                            <a class="nav-link text-white" href="#">Текущий конект:</a>
                            <span class="text-white">{{$currentConnect["nameConnect"]}}</span>
                        @else
                            <div class="text-center flex-column">
                                <a class="nav-link text-white">Введите пароль:</a>
                                <span class="text-white">ввести пароль</span>
                            </div>
                        @endif
                    </div>
                    <div class="current-connect-w row d-none">
                        @if(isset($currentConnect))
                            <div class="text-center flex-column">
                                <a class="nav-link" href="#">Текущий конект:</a>
                                <span>{{$currentConnect["nameConnect"]}}</span>
                            </div>
                        @else
                            <div class="text-center flex-column">
                                <a class="nav-link">Введите пароль:</a>
                                <span >ввести пароль</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-2 border-end border-light" id="select-branch">
                    <div class="current-branch-w">
                        <a class="text-white nav-link" href="#">Ветки</a>
                        @if(isset($allBranches))
                            <span class="text-white">текущая ветка:</span>
                            <span class="currentBranchSpan text-white">{{$allBranches["current"]}}</span>
                        @endif
                    </div>
                    <div class="current-branch-b d-none">
                        <a class="nav-link" style="color: black;" href="#">Ветки</a>
                        @if(isset($allBranches))
                            <span>текущая ветка:</span>
                            <span class="currentBranchSpan">{{$allBranches["current"]}}</span>
                        @endif
                    </div>
                </div>

                <nav class="col-2 navbar navbar-expand-lg border-end border-light" style="background-color: black;">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0 container-fluid pe-0 justify-content-center">
                            <li class="nav-item me-1">
                                <a id="pullAction" class="nav-link text-white" href="#">Pull</a>
                            </li>
                            <li class="ms-1 nav-item dropdown">
                                <a id="pushAction" class="nav-link text-white" href="#" aria-expanded="false">
                                    Push
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="col-4 justify-content-end">
                    <img src="/logo.png" width="95" height="64">
                </div>
                <div class="col-2 text-end justify-content-center">
                    <a href="{{route("user.logout")}}">
                        <button type="button" class="mt-2 btn text-white">Выход</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="git-editor row">
            <div class="col-2 text-center">
                <form id="commitForm" method="POST" action="{{ route("git.commit") }}">
                    @csrf
                    <div class="row">
                        <ul class="nav nav-tabs">
                            <li class="col-6 nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#change">Изменения</a>
                            </li>
                            <li class="col-6 nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#history">История</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="change">
                            <div class="column">
                                @if(isset($filesFromStatus))
                                    <div class="row count-files text-center">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-10">
                                            <span>{{count($filesFromStatus)}} измененый файл</span>
                                        </div>
                                    </div>
                                    <div class="list-files overflow-auto" style="min-height: 100%;">
                                        @foreach($filesFromStatus as $key=>$file)
                                            <div class="row m-0 item-file">
                                                <div class="col-2 m-0 p-0">
                                                    <input name="checkboxFile{{$key+1}}" class="form-check-input"
                                                           type="checkbox" value=""
                                                           data-filename-checkbox="{{$file["name"]}}">
                                                </div>
                                                <div class="col-8 m-0 p-0">
                                                <span style="cursor: pointer;" class="fileRow"
                                                      data-filename="{{$file["name"]}}">{{Tools::prepareFileName($file["name"])}}</span>
                                                </div>
                                                <div class="col-2 p-0">
                                                    <img src="/images/icons/txt.png"
                                                         width="15" height="15">
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-2">
                                    </div>
                                    <div class="row count-files text-center">
                                        <div class="col-10">
                                            <span>не подключено</span>
                                        </div>
                                    </div>
                                    <div class="list-files overflow-auto" style="min-height: 100%;">
                                    </div>
                                @endif
                                <div class="commit position-absolute " style="bottom: 0;">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="/images/icons/txt.png" width="15" height="15">
                                        </div>
                                        <div class="col-10">
                                            <input name="commitName" type="text" class="form-control"
                                                   placeholder="название коммита">
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="commit-description">
                            <textarea name="commitDescription" class="form-control" placeholder="description"
                                      rows="3"></textarea>
                                        </div>
                                        <div class="submit-commit">
                                            <button type="submit" class="btn btn-primary">
                                                Коммит
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="history">
                            <div class="column">
                                @if(isset($history))
                                    @foreach($history as $commit)
                                        <div class="column border">
                                            <div class="row col-12">
                                                <span>{{$commit["message"]}}</span>
                                            </div>
                                            <div class="row">
                                                <span>{{$commit["author"]}} &#183; {{$commit["date"]}} </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-10 column">
                <div class="col-12 text-left">
                    <span id="fileNameDiff"></span>
                </div>
                <div id="git-diff" class="col-12 overflow-auto">

                </div>
            </div>
        </div>
        {{--        скрытый блок редактирования подключения --}}
        <div class="connect-editor row d-none">
            <div id="connect-block" class="col-2 text-center">
                <div class="column">
                    <div class="row text-center">
                        <div class="col-4">
                            <!-- Кнопка-триггер модального окна -->
                            <button type="button" class="btn border btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addConnectModal"
                            >add
                            </button>
                        </div>
                    </div>
                    <div class="user-login">
                        <span>Admin</span>
                    </div>
                    <div class="list-connects justify-content-center">
                        @if(isset($connects))
                            @foreach($connects as $connect)
                                <div class="item-connect row ">
                                    <div class="col-8">
                                        <button type="button" class="btn btn-connect" data-bs-toggle="modal"
                                                data-connect-id="{{$connect["id"]}}"
                                                data-connect-ip="{{$connect["ip"]}}"
                                                data-connect-port="{{$connect["port"]}}"
                                                data-connect-pathToSite="{{$connect["pathToSite"]}}"
                                                data-connect-login="{{$connect["login"]}}"
                                                data-connect-name="{{$connect["nameConnect"]}}"
                                                data-bs-target="#signInConnect"
                                        ><span>{{$connect["nameConnect"]}}</span></button>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <button id="toggleDeleteModal" type="button" class="btn-close" data-bs-toggle="modal" data-delete-connect-id="{{$connect["id"]}}"
                                                data-bs-target="#deleteConnect" aria-label="Удалить"></button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-10">
            </div>
        </div>
        {{--        скрытый блок выбора ветки --}}
        <div class="branches-editor row d-none">
            <div class="col-2"></div>
            <div id="branches-block" class="col-2 text-center">
                <div class="column">
                    <div class="row text-center">
                        <span>Ветки:</span>
                    </div>
                    <div class="list-connects column">
                        @if(isset($allBranches))
                            @foreach($allBranches as $branch)
                                <div class="branch" data-branch="{{$branch}}" style="cursor: pointer">
                                    <span>{{$branch}}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-10">
            </div>
        </div>
    </div>
    {{--    модальное окно для создания подключения --}}
    <div class="modal fade" id="addConnectModal" tabindex="-1" aria-labelledby="addConnectModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addConnectModalLabel">Создание коннекта</h5>
                </div>
                <form method="post" action="{{ route("connect.registration") }}">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleNameConnect" class="form-label">Название подключения</label>
                            <input name="nameConnect" type="text" class="form-control" id="exampleNameConnect" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputIP" class="form-label">IP адрес сервера</label>
                            <input name="ip" type="text" class="form-control" id="exampleInputIP"
                                   aria-describedby="ipHelp" required>
                            <div id="ipHelp" class="form-text">Введите в формате 127.0.0.1</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPort" class="form-label">Порт SSH</label>
                            <input name="port" value="22" type="text" class="form-control" id="exampleInputPort"
                                   aria-describedby="portHelp">
                            <div id="portHelp" class="form-text">По умолчанию 22</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputLogin" class="form-label">Логин SSH</label>
                            <input name="login" type="text" class="form-control" id="exampleInputLogin" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword" class="form-label">Пароль SSH</label>
                            <input name="password" type="text" class="form-control" id="exampleInputPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPath" class="form-label">Путь до корня сайта</label>
                            <input name="pathToSite" type="text" class="form-control" id="exampleInputPath" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleLoginGit" class="form-label">Логин GIT для авторизации в удаленном репозитории</label>
                            <input name="loginGit" type="text" class="form-control" id="exampleLoginGit" required>
                        </div>
                        <div class="mb-3">
                            <label for="examplePasswordGit" class="form-label">Пароль GIT для авторизации в удаленном репозитории</label>
                            <input name="passwordGit" type="text" class="form-control" id="examplePasswordGit" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--    модальное окно для входа в подключение --}}
    <div class="modal fade" id="signInConnect" tabindex="-1" aria-labelledby="signInConnectLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signInConnectLabel">Заголовок модального окна</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form method="post" action="{{ route("connect.login") }}">
                    <div class="modal-body">
                        @csrf
                        <input type="text" hidden="hidden" name="idConnect" id="loginInputIPIdConnect">
                        <div class="mb-3">
                            <label for="exampleNameConnect" class="form-label">Название подключения</label>
                            <input name="nameConnect" type="text" class="form-control" id="nameConnect" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginInputIP" class="form-label">IP адрес сервера</label>
                            <input name="ip" type="text" class="form-control" id="loginInputIP"
                                   aria-describedby="ipHelp" required>
                            <div id="ipHelp" class="form-text">Введите в формате 127.0.0.1</div>
                        </div>
                        <div class="mb-3">
                            <label for="loginInputPort" class="form-label">Порт SSH</label>
                            <input name="port" value="22" type="text" class="form-control" id="loginInputPort"
                                   aria-describedby="portHelp">
                            <div id="portHelp" class="form-text">По умолчанию 22</div>
                        </div>
                        <div class="mb-3">
                            <label for="loginInputLogin" class="form-label">Логин SSH</label>
                            <input name="login" type="text" class="form-control" id="loginInputLogin" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginInputPassword" class="form-label">Пароль SSH</label>
                            <input name="password" type="text" class="form-control" id="loginInputPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginInputPath" class="form-label">Путь до корня сайта</label>
                            <input name="pathToSite" type="text" class="form-control" id="loginInputPath" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--    модальное окно для подтверждения удаление коннекта --}}
    <div class="modal fade" id="deleteConnect" tabindex="-1" aria-labelledby="deleteConnectLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signInConnectLabel">Действительно удалить коннект?</h5>
                </div>
                <form id="deleteForm" method="post" action="#">
                    @csrf
                    <input type="text" hidden="hidden" name="idConnect" id="idDeleteConnect">
                    <div class="modal-body row">
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Да</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Нет</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--    модальное окно загрузки --}}
    <div class="modal fade" id="loadingOperation" tabindex="-1" aria-labelledby="loadingOperationLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="text-center p-4">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Загрузка...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@include('footer')
