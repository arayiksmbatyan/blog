$(function(){
   $('.delete-post').on('click', function() {
       var postId = $(this).data('id');
       $('.form-horizontal').attr('action', '/post/' + postId);
   });

   $('.delete-category').on('click', function() {
       var categoryId = $(this).data('id');
       $('.form-horizontal').attr('action', '/category/' + categoryId);
   });

});

