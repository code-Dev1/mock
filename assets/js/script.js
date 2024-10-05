// $(document).ready(function () {
//     $("#submitForm").submit(function (e) { 
//         e.preventDefault();
//         $.ajax({
//             type: "POST",
//             url: "../../ajax/addstudent.php",
//             data: $(this).serialize(),
//             success: function (response) {
//                 alert(response);
//                 alert(data);
//             },
//             error: function (error){
//                 alert(data);
                
//             }
//         });
//     });
// });


$(document).ready(function (){
    window.setTimeout(function(){
    $(".alert").slideUp(500);
    },5000);

});

$('.roleSelector').on('focus', function () {
    $(this).find('option:first').hide();
});
