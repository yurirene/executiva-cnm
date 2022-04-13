@extends('template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <img class="img-responsive mt-5" src="/img/bg-logo.png" style="max-height: 400px;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <p>
                <b>SIS<i>VOTO</i></b> É 
                <span class="typed-text"></span><span class="cursor">&nbsp;</span>
            </p>
        </div>
    </div>
    
</div>
@endsection

@section('css')
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat');

.container {
  height: 100vh;
  align-items: center;
}
.container p {
  font-size: 5vw;
  padding: 0.5rem;
  letter-spacing: 0.1rem;
  text-align: center;
  overflow: hidden;
}
.container p span.typed-text {
  font-weight: normal;
  color: #be2e1b;
}
.container p span.cursor {
  display: inline-block;
  background-color: #ccc;
  margin-left: 0.1rem;
  width: 3px;
  animation: blink 1s infinite;
}
.container p span.cursor.typing {
  animation: none;
}
@keyframes blink {
  0%  { background-color: #ccc; }
  49% { background-color: #ccc; }
  50% { background-color: transparent; }
  99% { background-color: transparent; }
  100%  { background-color: #ccc; }
}
</style>
@endsection

@push('js')
<script>
    const typedTextSpan = document.querySelector(".typed-text");
    const cursorSpan = document.querySelector(".cursor");

    const textArray = ["FÁCIL", "RÁPIDO", "PRÁTICO", "NOSSO"];
    const typingDelay = 70;
    const erasingDelay = 70;
    const newTextDelay = 1000; // Delay between current and next text
    let textArrayIndex = 0;
    let charIndex = 0;

    function type() {
    if (charIndex < textArray[textArrayIndex].length) {
        if(!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
        typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
        charIndex++;
        setTimeout(type, typingDelay);
    } 
    else {
        cursorSpan.classList.remove("typing");
        setTimeout(erase, newTextDelay);
    }
    }

    function erase() {
    if (charIndex > 0) {
        if(!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
        typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex-1);
        charIndex--;
        setTimeout(erase, erasingDelay);
    } 
    else {
        cursorSpan.classList.remove("typing");
        textArrayIndex++;
        if(textArrayIndex>=textArray.length) textArrayIndex=0;
        setTimeout(type, typingDelay + 1100);
    }
    }

    document.addEventListener("DOMContentLoaded", function() { // On DOM Load initiate the effect
    if(textArray.length) setTimeout(type, newTextDelay + 250);
    });
</script>
@endpush