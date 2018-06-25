
//window.addEventListener("scroll", parallax);
function parallax(){
    if ( window.matchMedia("(min-width: 768px)" ).matches ){

        if( window.pageYOffset > 150 ){
            document.getElementById("box-two").style.top = ( window.pageYOffset )/2 + 'px';
        }
    }
}
window.addEventListener("scroll", fixNavbar);       
function fixNavbar(){
    // If full size screen
    if ( window.matchMedia("(min-width: 768px)" ).matches ){

        if( window.pageYOffset >= 150 ){
            document.getElementById("main").style.top = '0';
            document.getElementById("navbar").style.position = 'fixed';
            document.getElementById("navbar").style.width = '80%';
            document.getElementById("navbar").style.top = '0';
            
            document.getElementById("box-one").style.position = 'fixed';
            document.getElementById("box-one").style.top = '40px';
            document.getElementById("box-one").style.left = '10%';

            document.getElementById("box-two").style.top = '40px';
            document.getElementById("box-three").style.left = '15%';
        }
        else{
            document.getElementById("main").style.top = '0';
            document.getElementById("navbar").style.top = '0';
            document.getElementById("navbar").style.width = '100%';
            document.getElementById("navbar").style.position = 'relative';

            document.getElementById("box-one").style.position = 'relative';
            document.getElementById("box-one").style.left = '0%';
            document.getElementById("box-one").style.top = '0';

            document.getElementById("box-two").style.top = '0';
            document.getElementById("box-three").style.left = '0%';
        }
    }
}
function smoothScroll( elementId ){
    var offset = 35; // Might need to make responsive
    var current = window.pageYOffset;
    var destination = document.getElementById( elementId ).offsetTop;

    var timer = setInterval( function(){
        if( current <= destination ){
            current = current + offset;
            window.scrollTo( 0, current );
            if( current >= destination ){
                clearInterval( timer );
                window.scrollTo( 0, destination );
            }
        }
        if( current >= destination ){
            current = current - offset;
            window.scrollTo( 0, current );
            if( current <= destination ){
                clearInterval( timer );
                window.scrollTo( 0, destination );
            }
        }
    }, 1 );
}
function makeBackground( elementId ){
    document.getElementById('box-two').style.background = 'url("' + elementId + '") no-repeat fixed';
    document.getElementById('box-two').style.backgroundSize = 'cover';
}
/* Useful methods
var style = window.getComputedStyle(value);
var width = style.getPropertyValue('width');
elt.setAttribute("style", "width:" + 50 + '%;');
*/



