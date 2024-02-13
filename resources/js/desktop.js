$(document).ready(function() {
    var isOpenSelectConnect=false;
    var loadingModal= new bootstrap.Modal(document.getElementById('loadingOperation'), {
        backdrop: 'static',
        keyboard: false
    });

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
        var loadingModal = new bootstrap.Modal(document.getElementById('loadingOperation'), {
            backdrop: 'static',
            keyboard: false
        });
        loadingModal.show();
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
                loadingModal.hide();
                var classColor="success";
                if(String(data.result) == "ERROR")
                {
                    classColor="danger"
                }
                else {
                    location.reload();
                }
                $("#notificationContainer").append("<div class=\"alert alert-"+classColor+" alert-dismissible fade show\" role=\"alert\">\n" +
                    "                <strong>Notification!</strong> "+data.message+"\n" +
                    "                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Закрыть\"></button>\n" +
                    "            </div>");
            }
        });
    }

    function getDiffFromFile(fileName) {
        var loadingModal = new bootstrap.Modal(document.getElementById('loadingOperation'), {
            backdrop: 'static',
            keyboard: false
        });
        loadingModal.show();
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
                loadingModal.hide();
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
                var classColor="danger";
                $("#notificationContainer").append("<div class=\"alert alert-"+classColor+" alert-dismissible fade show\" role=\"alert\">\n" +
                    "                <strong>Notification!</strong> Ошибка загрузки файла \n" +
                    "                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Закрыть\"></button>\n" +
                    "            </div>");
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

    $("#buttonDeleteConnect").on('click', function(e) {
        checkoutBranch($(this).attr('data-branch'));
    });

    $("#pullAction").on('click', function(e) {
        loadingModal.show();
        var branch = $(".currentBranchSpan").html();
        $.ajax({
            type: "POST",
            url: "/pull",
            cache: false,
            dataType: "json",
            data:{
                "branch": branch,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(data) {
                loadingModal.hide();
                var classColor="success";
                if(String(data.result) == "ERROR")
                {
                    classColor="danger"
                }
                $("#notificationContainer").append("<div class=\"alert alert-"+classColor+" alert-dismissible fade show\" role=\"alert\">\n" +
                    "                <strong>Notification!</strong> "+data.message+"\n" +
                    "                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Закрыть\"></button>\n" +
                    "            </div>");
            },
        });
    });

    $("#pushAction").on('click', function(e) {
        loadingModal.show();
        var branch = $(".currentBranchSpan").html();
        $.ajax({
            type: "POST",
            url: "/push",
            cache: false,
            dataType: "json",
            data:{
                "branch": branch,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(data) {
                loadingModal.hide();
                var classColor="success";
                if(String(data.result) == "ERROR")
                {
                    classColor="danger"
                }
                $("#notificationContainer").append("<div class=\"alert alert-"+classColor+" alert-dismissible fade show\" role=\"alert\">\n" +
                    "                <strong>Notification!</strong> "+data.message+"\n" +
                    "                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Закрыть\"></button>\n" +
                    "            </div>");
            },
        });
    });

    $("#forcePushAction").on('click', function(e) {
        loadingModal.show();
        var branch = $(".currentBranchSpan").html();
        $.ajax({
            type: "POST",
            url: "/push",
            cache: false,
            dataType: "json",
            data:{
                "force": 1,
                "branch": branch,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(data) {
                loadingModal.hide();
                var classColor="success";
                if(String(data.result) == "ERROR")
                {
                    classColor="danger"
                }
                $("#notificationContainer").append("<div class=\"alert alert-"+classColor+" alert-dismissible fade show\" role=\"alert\">\n" +
                    "                <strong>Notification!</strong> "+data.message+"\n" +
                    "                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Закрыть\"></button>\n" +
                    "            </div>");

            },
        });
    });

    $("#commitForm").submit(function(e) {
        loadingModal.show();
        e.preventDefault();
        var data={};
        $("#commitForm").find("input, textarea").each(function() {
            if (this.type === "checkbox") {
                if(this.checked) {
                    data[this.name]=String(this.dataset.filenameCheckbox);
                }
            }else {
                data[this.name]=this.value;
            }
        });
        $.ajax({
            type: "POST",
            url: "/commit",
            cache: false,
            dataType: "json",
            data: data,
            beforeSend: function() {

            },
            success: function(data) {
                loadingModal.hide();
                location.reload();
            },
            error: function() {
                loadingModal.hide();
                console.log("error");
            }
        });
    });

    $("#deleteForm").submit(function(e) {
        loadingModal.show();
        e.preventDefault();
        var data={};
        $("#deleteForm").find("input").each(function() {
            data[this.name]=this.value;
        });
        $.ajax({
            type: "POST",
            url: "/deleteConnect",
            cache: false,
            dataType: "json",
            data: data,
            beforeSend: function() {

            },
            success: function(data) {
                console.log("data");
                setTimeout(function(){
                    loadingModal.hide();
                    location.reload();
                },1000)
                loadingModal.hide();
            },
            error: function() {
                loadingModal.hide();
            }
        });
    });

    $(".btn-connect").on('mousedown', function(e) {
        $("#nameConnect").val($(this).attr("data-connect-name"));
        $("#loginInputIP").val($(this).attr("data-connect-ip"));
        $("#loginInputIPIdConnect").val($(this).attr("data-connect-id"));
        $("#loginInputPort").val($(this).attr("data-connect-port"));
        $("#loginInputLogin").val($(this).attr("data-connect-login"));
        $("#loginInputPath").val($(this).attr("data-connect-pathToSite"));
    });

    $("#toggleDeleteModal").on('mousedown', function(e) {
        $("#idDeleteConnect").val($(this).attr("data-delete-connect-id"));
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
