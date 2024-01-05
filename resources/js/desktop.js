$(document).ready(function() {
    var isOpenSelectConnect=false;

    function openSelectConnect() {
        var element=$("#select-connect");
        element.css('background-color', 'white');
        $('.current-connect-b').addClass('d-none');
        $('.current-connect-w').removeClass('d-none');
        $('.git-editor').addClass('d-none');
        $('.connect-editor').removeClass('d-none');
    }

    function openSelectBranch() {
        var element=$("#select-branch");
        element.css('background-color', 'white');
        $('.current-branch-w').addClass('d-none');
        $('.current-branch-b').removeClass('d-none');
        $('.git-editor').addClass('d-none');
        $('.connect-editor').addClass('d-none');
        $('.branches-editor').removeClass('d-none');
    }

    function closeSelectConnect() {
        var element=$("#select-connect");
        element.css('background-color', 'black');
        $('.current-connect-w').addClass('d-none');
        $('.current-connect-b').removeClass('d-none');
        $('.connect-editor').addClass('d-none');
        $('.git-editor').removeClass('d-none');
    }

    function checkoutBranch(branch) {
        $.ajax({
            type: "POST",
            url: "/checkoutBranch",
            cache: false,
            dataType: "json",
            data: {
                branch: branch,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(data) {
                if(data.error.length>1)
                {
                    alert(data.error);
                }else {
                    location.reload();
                }
            }
        });
    }

    function getDiffFromFile(fileName) {
        $.ajax({
            type: "POST",
            url: "/getDiff",
            cache: false,
            dataType: "json",
            data: {
                file: fileName,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(data) {
                var diffContainer=$("#git-diff");
                diffContainer.empty();
                $("#fileNameDiff").text(fileName);
                if (data.length > 1) {
                    const targetElement=document.getElementById('git-diff');
                    const configuration={drawFileList: false, diffMaxChanges: 100, matching: 'lines', highlight: true};
                    const diff2htmlUi=new Diff2HtmlUI(targetElement, data, configuration);
                    diff2htmlUi.draw();
                    diff2htmlUi.highlightCode();
                } else {
                    diffContainer.append("");
                }
            },
            error: function() {
                console.log("error");
            }
        });
    }

    $("#select-connect").on('mousedown', function(e) {
        openSelectConnect();
    });

    $("#select-branch").on('mousedown', function(e) {
        openSelectBranch();
    });

    $(".branch").on('click', function(e) {
        checkoutBranch($(this).attr('data-branch'));
    });

    $(".btn-connect").on('mousedown', function(e) {
        $("#loginInputIP").val($(this).attr("data-connect-ip"))
        $("#loginInputIPIdConnect").val($(this).attr("data-connect-id"))
        $("#loginInputPort").val($(this).attr("data-connect-port"))
        $("#loginInputLogin").val($(this).attr("data-connect-login"))
        $("#loginInputPath").val($(this).attr("data-connect-pathToSite"))
    });
    $(".fileRow").on('mousedown', function(e) {
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
