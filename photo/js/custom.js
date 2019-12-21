function loadMore(total){
    for(var i = 0; i < total; i++){
        var cards = document.getElementsByClassName('cardHidden');
        if(cards[0]){
            cards[0].classList.remove('cardHidden');
        }
        if(!cards.length){
            document.getElementById('loadMore').style.display='none';
        }
    }
}

function rating(imageId, type){
    var opposite = type=='up' ? 'down' : 'up';
    document.getElementById(type + imageId).removeAttribute('href');
    document.getElementById(opposite + imageId).href='javascript:void(0)';
    xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/rating/index/" + imageId + "/" + type, false);
    xhttp.send();

    updateRating(imageId);
}

function updateRating(imageId){
    xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/rating/getUpVote/" + imageId, false);
    xhttp.send();
    var upSpans = document.getElementById('up' + imageId).getElementsByTagName('span');
    upSpans[0].innerText=xhttp.responseText;

    xhttp.open("GET", "/rating/getDownVote/" + imageId, false);
    xhttp.send();
    var downSpans = document.getElementById('down' + imageId).getElementsByTagName('span');
    downSpans[0].innerText=xhttp.responseText;
}
