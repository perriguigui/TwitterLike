var postId=0;

$('.like').on('click',function(event){
    postId = event.target.parentNode.parentNode.dataset['postid'];
     if(event.target.parentNode.parentNode.dataset['like'].like==0){
         var isLike = true;
     }else{
         var islike = false;
     }

    $.ajax({
        method:'POST',
        url: urlLike,
        data:{isLike: isLike, postId: postId, _token: token}
    })
        .done(function(){
            event.target.innerHTML = isLike ? 'you like':'Like';
        });
});

$('.post').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});


$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {body: $('#post-body').val(), postId: postId, _token: token}
    })
        .done(function (msg) {
            $(postBodyElement).text(msg['new_body']);
            $('#edit-modal').modal('hide');
        });
});
