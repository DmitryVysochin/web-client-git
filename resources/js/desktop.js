$(document).ready(function(){
    function openSelectConnect(){
        var element=$("#select-connect");
        element.css('background-color','white');
        $('.current-connect-b').addClass('d-none');
        $('.current-connect-w').removeClass('d-none');
        $('.git-editor').addClass('d-none');
        $('.connect-editor').removeClass('d-none');
    }
    function closeSelectConnect(){
        var element=$("#select-connect");
        element.css('background-color','#1b1e21');
        $('.current-connect-w').addClass('d-none');
        $('.current-connect-b').removeClass('d-none');
        $('.connect-editor').addClass('d-none');
        $('.git-editor').removeClass('d-none');
    }

    $("#select-connect").on('click',function (e){
        openSelectConnect();
    });
    $("#add-connect").on('click',function (e){
        openSelectConnect();
    });
});
