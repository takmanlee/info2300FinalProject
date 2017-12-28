var main = function() {
  /* Push the body and the nav over by 285px over */

  $('.icon-login').click(function() {
    $('.loginBox').animate({
      left: "0px"
    }, 200);

    $('body').animate({
      left: "285px"
    }, 200);
  });

  /* Then push them back */
  $('.icon-close').click(function() {
    $('.loginBox').animate({
      left: "-285px"
    }, 200);

    $('body').animate({
      left: "0px"
    }, 200);
  });
  
  var currentSlide = $('.slider ul li:first-child');
  currentSlide.addClass('active');

  $('a.control_next').click(function() {
    var currentSlide = $('.active');
    var nextSlide = currentSlide.next();
    
    if(nextSlide.length === 0) {
      nextSlide = $('.slider ul li:first-child');
    }
    
    currentSlide.fadeOut(500).removeClass('active');
    nextSlide.fadeIn(500).addClass('active');

  });


  $('a.control_prev').click(function() {
    var currentSlide = $('.active');
    var prevSlide = currentSlide.prev();

    if(prevSlide.length === 0) {
      prevSlide = $('.slider ul li:last-child');
    }
    
    currentSlide.fadeOut(500).removeClass('active');
    prevSlide.fadeIn(500).addClass('active');

  }); 

    // $('a.control_prev').click(function () {
    //     moveLeft();
    // });

    // $('a.control_next').click(function () {
    //     moveRight();
    // });


};

$(document).ready(main);

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

var checkCookie = function checkCookie() {
    var user=getCookie("username");
    if (user != "") {
        //$('.fadeOutDiv').hide();
        $('.fadeInDiv').css("display","block");
    } else {
        $('.fadeOutDiv').css("display","block");
        $('.fadeOutDiv').delay(2000).fadeOut();
        $('.fadeInDiv').delay(2000).fadeIn();
        setCookie("username", "visited", 1);
       }
}


//1. set ul width 
//2. image when click prev/next button
var ul;
var liItems;
var imageNumber;
var imageWidth;
var prev, next;
var currentPostion = 0;
var currentImage = 0;


function init(){
  ul = document.getElementById('post_slider');
  liItems = ul.children;
  imageNumber = liItems.length;
  imageWidth = liItems[0].children[0].clientWidth;
  ul.style.width = parseInt(imageWidth * imageNumber) + 'px';
  prev = document.getElementById("prev");
  next = document.getElementById("next");
  generatePager(imageNumber);
  //.onclike = slide(-1) will be fired when onload;
  /*
  prev.onclick = function(){slide(-1);};
  next.onclick = function(){slide(1);};*/
  prev.onclick = function(){ onClickPrev();};
  next.onclick = function(){ onClickNext();};
}

function animate(opts){
  var start = new Date;
  var id = setInterval(function(){
    var timePassed = new Date - start;
    var progress = timePassed / opts.duration;
    if (progress > 1){
      progress = 1;
    }
    var delta = opts.delta(progress);
    opts.step(delta);
    if (progress == 1){
      clearInterval(id);
      opts.callback();
    }
  }, opts.delay || 17);
  //return id;
}

function slideTo(imageToGo){
  var direction;
  var numOfImageToGo = Math.abs(imageToGo - currentImage);
  // slide toward left

  direction = currentImage > imageToGo ? 1 : -1;
  currentPostion = -1 * currentImage * imageWidth;
  var opts = {
    duration:1000,
    delta:function(p){return p;},
    step:function(delta){
      ul.style.left = parseInt(currentPostion + direction * delta * imageWidth * numOfImageToGo) + 'px';
    },
    callback:function(){currentImage = imageToGo;}  
  };
  animate(opts);
}

function onClickPrev(){
  if (currentImage == 0){
    slideTo(imageNumber - 1);
  }     
  else{
    slideTo(currentImage - 1);
  }   
}

function onClickNext(){
  if (currentImage == imageNumber - 1){
    slideTo(0);
  }   
  else{
    slideTo(currentImage + 1);
  }   
}


