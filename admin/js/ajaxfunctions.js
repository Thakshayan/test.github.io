function deleteDetail(idx,ctgry){
    if(confirm("Are You sure want to delete ??")){
        $.ajax({
            type : "POST",
            url : "delete.php",
            data : {identity : idx, category: ctgry},
            cache:false,
            success:function(hlo){
                window.location.href.substr(0, window.location.href.indexOf('#'))
                location.reload();
            }   
        });
    }
}
function markAsRead(idx, ctgry){
    $.ajax({
        type : "POST",
        url : "update.php",
        data : {identity : idx, category: ctgry},
        cache:false,
        success:function(hlo){
        }   
    });
    return false;
}