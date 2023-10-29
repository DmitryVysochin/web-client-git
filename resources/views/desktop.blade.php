@include('header')
<main>
    <div>
        <div class="container-fluid text-center" style="background-color: black;">
            <div class="row" >
                <div class="col-2" id="select-connect" >
                    <div class="current-connect-b row ">
                        <div class="col-3" >
                            <img src="/images/icons/lock_w.png" width="20" height="20">
                        </div>
                        <div class="col-6 text-left flex-column">
                            <span class="text-white">Текущий конект:</span>
                            <span class="text-white">nikolab</span>
                        </div>
                        <div class="col-3" >
                            <img src="/images/icons/down_w.png" width="15" height="15">
                        </div>
                    </div>
                    <div class="current-connect-w row d-none">
                        <div class="col-3">
                            <img src="/images/icons/lock_b.png" width="20" height="20">
                        </div>
                        <div class="col-6 text-left flex-column">
                            <span >Текущий конект:</span>
                            <span >nikolab</span>
                        </div>
                        <div class="col-3" >
                            <img src="/images/icons/down_b.png" width="15" height="15">
                        </div>
                    </div>
                </div>
                <div class="col-2" >
                    <h3 class="text-white">ветки</h3>
                </div>
                <div class="col-2" >
                    <h3 class="text-white">пуш</h3>
                </div>
                <div class="col-6 justify-content-end items-right">
                    <img src="/logo.png" width="106" height="64">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" >
        <div class="git-editor row">
            <div class="col-2 text-center" >
                <div class="row">
                    <div class="col-6">
                        <span>Изменения</span>
                    </div>
                    <div class="col-6"><span>История</span></div>
                </div>
                <div class="column">
                    <div class="row count-files text-center">
                        <div class="col-2">
                            <input class="form-check-input" type="checkbox" value="">
                        </div>
                        <div class="col-10">
                            <span>1 измененый файл</span>
                        </div>
                    </div>
                    <div class="list-files overflow-auto" style="min-height: 70vh;">
                        <div class="row item-file" >
                            <div class="col-2 p-0">
                                <input class="form-check-input" type="checkbox" value="">
                            </div>
                            <div class="col-8 p-0" >
                                <span>.gitinore</span>
                            </div>
                            <div class="col-2 p-0">
                                <img src="/images/icons/txt.png" width="15" height="15">
                            </div>
                        </div>

                    </div>
                    <div class="commit">
                        <div class="row">
                            <div class="col-2">
                                <img src="/images/icons/txt.png" width="15" height="15">
                            </div>
                            <div class="col-10" >
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
                    <span>gitignore</span>
                </div>
                <div class="col-12 git-diff overflow-auto">
                    <div class="row">
                        <div class="col-1 column" style="background-color: #a0dbe5">
                            <span>13</span>
                            <span>13</span>
                        </div>
                        <div class="col-11" style="background-color: #b6f6b2">
                            <span> # MemoryCaptures can get excessive in size.</span>
                        </div>
                    </div>
                    @if(isset($iterator))
                        @foreach($iterator as $key=>$line)
                            <div class="row">
                                <div class="col-1 column" style="background-color: #a0dbe5">
                                    <span>{{$key}}</span>
                                    <span>{{$key}}</span>
                                </div>
                                <div class="col-11" style="background-color: #b6f6b2">
                                    <span>{{$line}}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if(isset($iterator))
                    @foreach($iterator as $line)
                        {{$line}}
                    @endforeach
                @endif
            </div>
        </div>
        <div class="connect-editor row d-none">
            <div id="connect-block" class="col-2 text-center" >
                <div class="column">
                    <div class="row text-center" >
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
                        <div class="item-connect row">
                            <div class="col-4">
                                <img src="/images/icons/lock_b.png" width="15" height="15">
                            </div>
                            <div class="col-8">
                                <span>nikolab</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
            </div>
        </div>
    </div>
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
    {{--<div class="bg-gray-100 dark:bg-gray-900 items-right">--}}
    {{--    <div>--}}
    {{--        <a href="{{route("user.logout")}}">--}}
    {{--            <button type="button" class="btn btn-success">Выход</button>--}}
    {{--        </a>--}}
    {{--    </div>--}}
    {{--</div>--}}
    {{--<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">--}}
    {{--    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">--}}
    {{--        <div>--}}
    {{--            <div>--}}
    {{--                <h1>Рабочий Стол</h1>--}}
    {{--                @if(isset($isConnect))--}}
    {{--                    {{$isConnect}}--}}
    {{--                @endif--}}
    {{--                <form method="post" action="{{ route("connect.registration") }}">--}}
    {{--                    @csrf--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="exampleInputIP" class="form-label">IP адрес сервера</label>--}}
    {{--                        <input name="ip" type="text" class="form-control" id="exampleInputIP" aria-describedby="ipHelp" required>--}}
    {{--                        <div id="ipHelp" class="form-text">Введите в формате 127.0.0.1</div>--}}
    {{--                    </div>--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="exampleInputPort" class="form-label">Порт SSH</label>--}}
    {{--                        <input name="port" value="22" type="text" class="form-control" id="exampleInputPort" aria-describedby="portHelp">--}}
    {{--                        <div id="portHelp" class="form-text">По умолчанию 22</div>--}}
    {{--                    </div>--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="exampleInputLogin" class="form-label">Логин SSH</label>--}}
    {{--                        <input name="login" type="text" class="form-control" id="exampleInputLogin" required>--}}
    {{--                    </div>--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="exampleInputPassword" class="form-label">Пароль SSH</label>--}}
    {{--                        <input name="password" type="text" class="form-control" id="exampleInputPassword" required>--}}
    {{--                    </div>--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="exampleInputPath" class="form-label">Путь до корня сайта</label>--}}
    {{--                        <input name="pathToSite" type="text" class="form-control" id="exampleInputPath" required>--}}
    {{--                    </div>--}}
    {{--                    <button type="submit" class="btn btn-primary">Войти</button>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
</main>
@include('footer')
