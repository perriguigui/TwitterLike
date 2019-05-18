
var postRetweet=0;

$('.like').on('click',function () {
   event.preventDefault();
   postId= event.target.parentNode.parentNode.dataset['postid'];
   var isRetweet= event.target.previousElementSibling==null;


    $.ajax({
        method:'POST',
        url: urlRetweet,
        data:{isRetweet: isRetweet, postId: postId, _token: token}
    })
        .done(function(){
            event.target.innerHTML = isRetweet ? 'you retweet':'retweet';
});

});