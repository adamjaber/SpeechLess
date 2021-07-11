




// function deleteMeeting(){
//   $('.delete-meeting').click(function (){
//         console.log('asd');
//         alert('asdadd');
//  });
// }
function callAjax(data_meeting) {     // 
    $.ajax({
        type: "POST",
        url: "deleteobj.php",
        data: data_meeting,
        cache: true
        
    });
}

function getPageName(url) {
    var index = url.lastIndexOf("/") + 1;
    var filenameWithExtension = url.substr(index);
    var filename = filenameWithExtension.split(".")[0]; 
    return filename;                                    
}


$(document).ready(function () {
    var page = getPageName(window.location.pathname);
        // console.log(page);
    $.getJSON("includes/data/intro.json", function (data) {
        var htmlstr = '<p class="p1">' + data.title + "</p>";
        $(".Online").append(htmlstr);
        // console.log(htmlstr);
        $.each(data.contacts, function () {
            $(".Online").append("<p>"
                + this.name + "-"
                + this.email + "</p>");
        }
        );

    });

    $('.delete-meeting').click(function () {                             //delete meeting using ajax
        var data_meeting = "meetingID=" + this.value + "&status=delete";
        $(this).parent().hide();
        console.log(data_meeting);
        callAjax(data_meeting);
    });

    
    var sort=document.getElementById("sort");
    if(sort)
        sort.onchange=sortChange
    function sortChange() {
        var neww=this.value;
            console.log(neww);
            window.location.replace(window.location.pathname + "?sort=" + neww)

    }






    ///////////////////  carousel////////////////////
    if (page=="index") {
        let slidePosition = 0;
        const slides = document.getElementsByClassName('carousel__item');
        const totalSlides = slides.length;
        document.
            getElementById('carousel__button--next').addEventListener("click", function () {
                moveToNextSlide();
            });
        document.
            getElementById('carousel__button--prev')
            .addEventListener("click", function () {
                moveToPrevSlide();
            });

        function updateSlidePosition() {
            for (let slide of slides) {
                slide.classList.remove('carousel__item--visible');
                slide.classList.add('carousel__item--hidden');
            }

            slides[slidePosition].classList.add('carousel__item--visible');
        }

        function moveToNextSlide() {
            if (slidePosition === totalSlides - 1) {
                slidePosition = 0;
            } else {
                slidePosition++;
            }

            updateSlidePosition();
        }

        function moveToPrevSlide() {
            if (slidePosition == 0) {
                slidePosition = totalSlides - 1;
            } else {
                slidePosition--;
            }

            updateSlidePosition();
        }
    }



    // var sortdate= document.getElementById("#sort-date");

    // sortdate.onchange=function() {
    //     console.log("asd");
    // }



    // $('#add-meeting').click(function (){
    //     $('#dialog').dialog('open');
    // }
    // $(function () {
    //     $("#dialog").dialog({
    //         modal: true,
    //         autoOpen: false,
    //         title: "jQuery Dialog",
    //         width: 300,
    //         height: 150
    //     });
    //     $("#add-meeting").click(function () {
    //         $('#dialog').dialog('open');
    //     });
    // });



});





