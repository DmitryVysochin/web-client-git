@include('header')
<div class="container-fluid" style="padding: 0;height: 20rem;">
    <div class="col-2 text-center" style="border-right: 1px solid #8A8B8CFF;">
        <div class="row" style="margin: 0;border-bottom: 1px solid #8A8B8CFF;">
            <div class="col-6" style="border-right: 1px solid #8A8B8CFF;"><span>Изменения</span></div>
            <div class="col-6"><span>История</span></div>
        </div>
        <div class="column" style="background-color: #f4f6f6">
            <div class="row count-files text-center" style="margin: 0;border-bottom: 1px solid #8a8b8c;">
                <div class="col-2">
                    <input class="form-check-input" style="margin-left: 1em" type="checkbox" value="">
                </div>
                <div class="col-10">
                    <span>1 измененый файл</span>
                </div>
            </div>
            <div class="list-files" style="min-height: 40rem;">
                <div class="row item-file" style="margin: 0;border-bottom: 1px solid #8a8b8c;background-color: #edeeee">
                    <div class="col-2">
                        <input class="form-check-input" style="margin-left: 1em" type="checkbox" value="">
                    </div>
                    <div class="col-8" style="display:flex; justify-content: left;">
                        <span>.gitinore</span>
                    </div>
                    <div class="col-2">
                        <img src="/images/icons/txt.png">
                    </div>
                </div>
            </div>
            <div class="commit" style="background-color: #cbc9c9; border-top: 1px solid #8a8b8c;">
                <div class="row" style="margin-top: 1em;">
                    <div class="col-2 avatar">
                        <img src="/images/icons/txt.png">
                    </div>
                    <div class="col-10" style="padding-right: 18px">
                        <input type="text" class="form-control" placeholder="название коммита">
                    </div>
                </div>
                <div class="flex-column">
                    <div class="commit-description" style="display: flex; justify-content: center;">
                        <textarea style="width: 95%;margin-top: 5px;" class="form-control" rows="3">description</textarea>
                    </div>
                    <div class="submit-commit">
                        <button type="button" style="width: 95%; margin-top: 5px;" class="btn btn-primary">Коммит</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-10"></div>
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
@include('footer')
