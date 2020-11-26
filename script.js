$(document).ready(function(){

    $(".form-ajax").submit(function(e){
        e.preventDefault();
       $.ajax({
           url : $(this).attr('action'),
           method : $(this).attr('method'),
           dataType : 'json',
           data: $(this).serialize(),
           success : (data) => {
               if(!data[1].length)
               {
                    window.location.replace(data[0])
               }
               else
               {
                    $('.display-error').html(errors(data[1]));
               }
               console.log(data)
           },
           error : (error) => {
               console.log(error.responseText)
           }

       })
    });
});
function errors(errors)
{
    let output = '';
    if(errors.length > 1)
    {
        output += '<ul>';
        $.each(errors, (key, value) => {
            output += '<li>' + value + '</li>';
        })
        output += '</ul>'
    }
    else
    {
        output = errors[0];
    }
    return output;
}
