function greetings(){
  alert("testing");
}

var autoSizeText;

autoSizeText = function() {
  var contentHeight = $('#content').height();
  var containerHeight = $('#resize').height();
  var el = document.getElementById('resize');
  var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
  var fontSize = parseFloat(style);
  var newFont = fontSize - 1;
  alert(contentHeight);
  while(contentHeight > containerHeight) {
  	el.style.fontSize = (newFont) + 'px';
    var newFont = newFont - 1;
    var contentHeight = $('#content').height();
  }
  alert(contentHeight);
};

$(document).ready(function() {
  return autoSizeText();
});
