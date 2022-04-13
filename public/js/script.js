function loadCamera(){
    //Captura elemento de vídeo
    var video = document.querySelector("#webCamera");
    //As opções abaixo são necessárias para o funcionamento correto no iOS
    video.setAttribute('autoplay', '');
    video.setAttribute('muted', '');
    video.setAttribute('playsinline', '');
    //--

    //Verifica se o navegador pode capturar mídia
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({audio: false, video: {facingMode: 'environment'}})
            .then( function(stream) {
            //Definir o elemento vídeo a carregar o capturado pela webcam
            video.srcObject = stream;
        })
            .catch(function(error) {
            alert("Oooopps... Falhou :'("+error+")");
        });
    }
}

loadCamera();