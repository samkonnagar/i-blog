function changeMode(id, data) {
    $.post("backend/change_mode_back.php",
        {
          uId: id,
          mode: data
        },
        function(data, status){
          alert(data);
        });
}


$('.blog-features').click((event)=>{
    event.stopPropagation();
})

function showMore(id) {
    location.assign(`preview.php?blog_id=${id}`)
    
}
function editBlog(id) {
    location.assign(`editBlog.php?blog_id=${id}`)
    
}


