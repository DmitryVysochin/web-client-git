@include('header')
<div class="bg-gray-100 dark:bg-gray-900 items-right">
    <div>
        <a href="{{route("user.logout")}}">
            <button type="button" class="btn btn-success">Выход</button>
        </a>
    </div>
</div>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div>
            <div>
                <h1>Рабочий Стол</h1>
                @if(isset($isConnect))
                    {{$isConnect}}
                @endif
                <form method="post" action="{{ route("connect.registration") }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputIP" class="form-label">IP адрес сервера</label>
                        <input name="ip" type="text" class="form-control" id="exampleInputIP" aria-describedby="ipHelp" required>
                        <div id="ipHelp" class="form-text">Введите в формате 127.0.0.1</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPort" class="form-label">Порт SSH</label>
                        <input name="port" value="22" type="text" class="form-control" id="exampleInputPort" aria-describedby="portHelp">
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
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('footer')
