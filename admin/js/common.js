function playNotification(cnt) {
    if (cnt > 0) {
        var audio = new Audio('audio/message_receive.mp3');
        var promise = audio.play();;
        if (promise !== undefined) {
            promise.then(_ => {
                // Autoplay started!
            }).catch(error => {
                // Autoplay was prevented.
                // Show a "Play" button so that user can start playback.
                console.log(error);
            });
        }
    }    
}

function updateSeenCnt(){
    $.ajax({
        type : "POST",
        url : "update.php",
        data : {identity : "seen", category: "updateCmplinSeen"},
        cache:false,
        success:function(hlo){
            document.getElementById("ntfyCnt").innerHTML = "0";
        }   
    }); 
    return false;
}