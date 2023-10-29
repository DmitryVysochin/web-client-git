$(document).ready(function(){
    var isOpenSelectConnect=false;
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
        element.css('background-color','black');
        $('.current-connect-w').addClass('d-none');
        $('.current-connect-b').removeClass('d-none');
        $('.connect-editor').addClass('d-none');
        $('.git-editor').removeClass('d-none');
    }

    $("#select-connect").on('mousedown',function (e){
        openSelectConnect();
    });
    // $("#select-connect").on("mouseup",function(e){
    //     isOpenSelectConnect=true;
    // })
    // $("main").on('mousedown',function(e){
    //     if(isOpenSelectConnect===true) {
    //         var connectEditor=$("#connect-block");
    //         if (!connectEditor.is(e.target)
    //             && connectEditor.has(e.target).length === 0) {
    //             closeSelectConnect();
    //         }
    //     }
    // });
    // $("main").on('mouseup',function(e){
    //     if(isOpenSelectConnect===true) {
    //         var connectEditor=$("#connect-block");
    //         if (!connectEditor.is(e.target)
    //             && connectEditor.has(e.target).length === 0) {
    //             isOpenSelectConnect=false;
    //         }
    //     }
    // });
});
