@include('header')
<main>
    <div style="background-color: #1b1e21; min-width: max-content; min-height: 4rem; border-top: 1px solid black;">
        <div class="container-fluid text-center" style="min-height: 100%; padding: 0;">
            <div class="row" style="margin: 0;">
                <div class="col-2" id="select-connect" style="cursor: pointer;border-right: 2px solid black;">
                    <div class="current-connect-b row "
                         style="margin: 0;min-height: max-content;">
                        <div class="col-3" style="margin-top: 1em;">
                            <img src="/images/icons/lock_w.png" width="20" height="20">
                        </div>
                        <div class="col-6 text-left flex-column">
                            <span style="font-size: 15px;color: white">Текущий конект:</span>
                            <span style="font-size: 20px;color: white">nikolab</span>
                        </div>
                        <div class="col-3" style="margin-top: 1em;">
                            <img src="/images/icons/down_w.png" width="15" height="15">
                        </div>
                    </div>
                    <div class="current-connect-w row d-none"
                         style="margin: 0;min-height: max-content;">
                        <div class="col-3" style="margin-top: 1em;">
                            <img src="/images/icons/lock_b.png" width="20" height="20">
                        </div>
                        <div class="col-6 text-left flex-column">
                            <span style="font-size: 15px;color: black">Текущий конект:</span>
                            <span style="font-size: 20px;color: black">nikolab</span>
                        </div>
                        <div class="col-3" style="margin-top: 1em;">
                            <img src="/images/icons/down_b.png" width="15" height="15">
                        </div>
                    </div>
                </div>
                <div class="col-2" style="min-height: max-content;border-right: 2px solid black;"><h3
                        style="color: white">
                        ветки</h3></div>
                <div class="col-2" style="min-height: max-content;border-right: 2px solid black;"><h3
                        style="color: white">
                        пуш</h3></div>
                <div class="col-6 justify-content-end items-right">
                    <img src="/logo.png" width="106" height="64">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style=" min-width: max-content;height: 20rem;">
        <div class="git-editor row">
            <div class="col-2 text-center" style="border-right: 1px solid #8A8B8CFF;">
                <div class="row"
                     style="border-bottom: 1px solid #8A8B8CFF;box-shadow: 0px 0px 26px 2px rgba(34, 60, 80, 0.1);">
                    <div class="col-6"
                         style="border-right: 1px solid #8A8B8CFF;box-shadow: 0px 0px 8px 1px rgba(34, 60, 80, 0.2);">
                        <span>Изменения</span>
                    </div>
                    <div class="col-6"><span>История</span></div>
                </div>
                <div class="flex-column">
                    <div class="row count-files text-center"
                         style="border-bottom: 1px solid #8a8b8c;box-shadow: 0px 0px 26px 2px rgba(34, 60, 80, 0.1) inset;">
                        <div class="col-2">
                            <input class="form-check-input" style="margin-left: 1em" type="checkbox" value="">
                        </div>
                        <div class="col-10">
                            <span>1 измененый файл</span>
                        </div>
                    </div>
                    <div class="list-files" style="min-height: 40rem;">
                        <div class="row item-file" style="border-bottom: 1px solid #8a8b8c;background-color: #edeeee">
                            <div class="col-2">
                                <input class="form-check-input" style="margin-left: 1em" type="checkbox" value="">
                            </div>
                            <div class="col-8" style="display:flex; justify-content: left;">
                                <span>.gitinore</span>
                            </div>
                            <div class="col-2">
                                <img src="/images/icons/txt.png" width="15" height="15">
                            </div>
                        </div>
                    </div>
                    <div class="commit">
                        <div class="row"
                             style="padding-top: 1em;border-top: 1px solid #8a8b8c;">
                            <div class="col-2">
                                <img src="/images/icons/txt.png" width="15" height="15">
                            </div>
                            <div class="col-10" style="display:flex; justify-content: left;">
                                <input type="text" class="form-control" placeholder="название коммита">
                            </div>
                        </div>
                        <div class="column">
                            <div class="commit-description">
                            <textarea style="margin-top: 5px;" class="form-control" placeholder="description"
                                      rows="3"></textarea>
                            </div>
                            <div class="submit-commit">
                                <button type="button" style="width: 95%; margin-top: 5px;" class="btn btn-primary">
                                    Коммит
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10"></div>
        </div>
        <div class="connect-editor row d-none">
            <div class="col-2 text-center" style="border-right: 1px solid #8A8B8CFF;">
                <div class="column">
                    <div class="row text-center" style="margin: 0;">
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="filter">
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- Кнопка-триггер модального окна -->
                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addConnectModal"
                                    style="border: 1px solid #ced4da">add <img src="/images/icons/down_b.png" width="15"
                                                                               height="15"></button>
                        </div>
                    </div>
                    <div class="user-login" style="display: flex;justify-content: left">
                        <span style="margin-left: 1em">Admin</span>
                    </div>
                    <div class="list-connects" style="min-height: 40rem;">
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
            <div class="col-10" style="background-color: black;opacity: 0.1;">
                {{$result_dio ?? ''}}
                {{$result_err ?? ''}}
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
