var postId=0;

$('.like').on('click',function(event){
    event.preventDefault();
    console.log(event);
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;

    $.ajax({
        method:'POST',
        url: urlLike,
        data:{isLike: isLike, postId: postId, _token: token}
    })
        .done(function(){
            event.target.innerHTML = isLike ? event.target.innerHTML == 'Like' ? ' You like':'Like': event.target.innerHTML == 'Dislike'?'You dont like':'Dislike';
            event.target.innerHTML = isLike ? event.target.innerHTML == 'Like' ? ' You like':'Like': event.target.innerHTML == 'Dislike'?'You dont like':'Dislike';
            if(isLike){
                event.target.nextElementSibling.innerHTML =' ';
            }else{
                event.target.previousElementSibling.innerHTML =' ';
            }
        });
});

$('.post').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[5];
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
