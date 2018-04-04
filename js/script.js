$(function(){
    $('#ajax').submit(function(e){
        e.preventDefault();

        var formData = $(this).serializeArray();
        var error = 0;


        if(error == 0){
            $.ajax({
                url:'response.php',
                type: 'post',
                dataType: 'html',
                data: formData,
                success: function(html){
                    if(html) {
                        $('.center-block.table-width').children().remove();
                        $('.center-block.table-width').append(html);
                    }
                }
            });
        }

    });
});

