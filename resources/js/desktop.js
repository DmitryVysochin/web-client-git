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

    function getDiffFromFile(fileName){
        $.ajax({
            type: "POST",
            url: "/getDiff",
            cache: false,
            dataType: "json",
            data: {
                file:fileName,
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){

            },
            success: function(data){
                var rows=data[0];
                var diffContainer=$(".git-diff");
                diffContainer.empty();
                $("#fileNameDiff").text(fileName);
                rows.forEach(function(currentValue,key,array){
                    diffContainer.append("<div class=\"row\">\n" +
                        "                        <div class=\"col-1 column\" style=\"background-color: #a0dbe5\">\n" +
                        "                            <span>"+key+"</span>\n" +
                        "                            <span>"+key+"</span>\n" +
                        "                        </div>\n" +
                        "                        <div class=\"col-11\" style=\"background-color: #b6f6b2\">\n" +
                        "                            <span> "+currentValue+"</span>\n" +
                        "                        </div>\n" +
                        "                    </div>");
                });
            },
            error: function() {
                console.log("error");
            }
        });
    }

    $("#select-connect").on('mousedown',function (e){
        openSelectConnect();
    });
    $(".fileRow").on('mousedown',function (e){
        getDiffFromFile($(this).attr('data-filename'));
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
