@include('header')
<main>
    <div>
        <div class="container-fluid text-center" style="background-color: black;">
            <div class="row">
                <div class="col-2" id="select-connect">
                    <div class="current-connect-b row ">
                        @if(isset($currentConnect))
                            <div class="col-3">
                                <img src="/images/icons/lock_w.png" width="20" height="20">
                            </div>
                            <div class="col-6 text-left flex-column">
                                <span class="text-white">Текущий конект:</span>
                                <span class="text-white">{{$currentConnect["ip"]}}</span>
                            </div>
                            <div class="col-3">
                                <img src="/images/icons/down_w.png" width="15" height="15">
                            </div>
                        @else
                            <div class="col-3">
                                <img src="/images/icons/lock_w.png" width="20" height="20">
                            </div>
                            <div class="col-6 text-left flex-column">
                                <span class="text-white">Введите пароль:</span>
                                <span class="text-white">ввести пароль</span>
                            </div>
                            <div class="col-3">
                                <img src="/images/icons/down_w.png" width="15" height="15">
                            </div>
                        @endif
                    </div>
                    <div class="current-connect-w row d-none">
                        @if(isset($currentConnect))
                            <div class="col-3">
                                <img src="/images/icons/lock_b.png" width="20" height="20">
                            </div>
                            <div class="col-6 text-left flex-column">
                                <span>Текущий конект:</span>
                                <span>{{$currentConnect["ip"]}}</span>
                            </div>
                            <div class="col-3">
                                <img src="/images/icons/down_b.png" width="15" height="15">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-2" id="select-branch">
                    <div class="current-branch-w">
                        <h4 class="text-white">ветки</h4>
                        @if(isset($allBranches))
                            <span class="text-white">текущая ветка:</span>
                            <span class="text-white">{{$allBranches["current"]}}</span>
                        @endif
                    </div>
                    <div class="current-branch-b d-none">
                        <h4>ветки</h4>
                        @if(isset($allBranches))
                            <span>текущая ветка:</span>
                            <span>{{$allBranches["current"]}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-2">
                    <h3 class="text-white">
                        <a href="{{route("user.logout")}}">
                            <button type="button" class="btn btn-success">Выход</button>
                        </a>
                    </h3>
                </div>
                <div class="col-6 justify-content-end items-right">
                    <img src="/logo.png" width="106" height="64">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="git-editor row">
            <div class="col-2 text-center">
                <div class="row">
                    <div class="col-6">
                        <span>Изменения</span>
                    </div>
                    <div class="col-6"><span>История</span></div>
                </div>
                <div class="column">
                    @if(isset($filesFromStatus))
                        <div class="row count-files text-center">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <span>{{count($filesFromStatus)}} измененый файл</span>
                            </div>
                        </div>
                        <div class="list-files overflow-auto" style="min-height: 70vh;">
                            @foreach($filesFromStatus as $file)
                                <div class="row item-file">
                                    <div class="col-2 p-0">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                    <div class="col-8 p-0">
                                        <span style="cursor: pointer;" class="fileRow"
                                              data-filename="{{$file["name"]}}">{{$file["name"]}}</span>
                                    </div>
                                    <div class="col-2 p-0">
                                        <img src="/images/icons/txt.png" width="15" height="15">
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
                        <div class="list-files overflow-auto" style="min-height: 70vh;">
                        </div>
                    @endif
                    <div class="commit">
                        <div class="row">
                            <div class="col-2">
                                <img src="/images/icons/txt.png" width="15" height="15">
                            </div>
                            <div class="col-10">
                                <input type="text" class="form-control" placeholder="название коммита">
                            </div>
                        </div>
                        <div class="column">
                            <div class="commit-description">
                            <textarea class="form-control" placeholder="description"
                                      rows="3"></textarea>
                            </div>
                            <div class="submit-commit">
                                <button type="button" class="btn btn-primary">
                                    Коммит
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="filter">
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- Кнопка-триггер модального окна -->
                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addConnectModal"
                            >add <img src="/images/icons/down_b.png" width="15"
                                      height="15"></button>
                        </div>
                    </div>
                    <div class="user-login">
                        <span>Admin</span>
                    </div>
                    <div class="list-connects">
                        @if(isset($connects))
                            @foreach($connects as $connect)
                                <div class="item-connect row">
                                    <div class="col-4">
                                        <img src="/images/icons/lock_b.png" width="15" height="15">
                                    </div>
                                    <div class="col-8">
                                        <button type="button" class="btn btn-connect" data-bs-toggle="modal"
                                                data-connect-id="{{$connect["id"]}}"
                                                data-connect-ip="{{$connect["ip"]}}"
                                                data-connect-port="{{$connect["port"]}}"
                                                data-connect-pathToSite="{{$connect["pathToSite"]}}"
                                                data-connect-login="{{$connect["login"]}}"
                                                data-bs-target="#signInConnect"
                                        ><span>{{$connect["ip"].":".$connect["port"]}}</span></button>
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
                        <span>Ветки</span>
                    </div>
                    <div class="list-connects column">
                        @if(isset($allBranches))
                            @foreach($allBranches as $branch)
                                <div class="branch border" data-branch="{{$branch}}" style="cursor: pointer">
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
                    <h5 class="modal-title" id="addConnectModalLabel">Заголовок модального окна</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form method="post" action="{{ route("connect.registration") }}">
                    <div class="modal-body">
                        @csrf
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
                        <input type="text" name="idConnect" id="loginInputIPIdConnect">

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

</main>
@include('footer')
