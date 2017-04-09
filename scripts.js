function greetings(){
  alert("testing1");
  var el1 = document.getElementById('content');
  var style1 = window.getComputedStyle(el1, null).getPropertyValue('height');
  var contentHeight = parseFloat(style1);

  var el2 = document.getElementById('title-content');
  var style2 = window.getComputedStyle(el2, null).getPropertyValue('height');
  var containerHeight = parseFloat(style2);

  var el = document.getElementById('title-content');
  var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
  var fontSize = parseFloat(style);
  var newFont = fontSize - 1;

  alert(contentHeight + " | " + containerHeight + " | " + newFont);

  el.style.fontSize = (newFont) + 'px';
  var newFont = newFont - 1;

  var el2 = document.getElementById('title-content');
  var style2 = window.getComputedStyle(el2, null).getPropertyValue('height');
  var containerHeight = parseFloat(style2);

  alert(contentHeight + " | " + containerHeight + " | " + newFont);

  alert("testing2");
}

var autoSizeText;

autoSizeText = function() {
  var el1 = document.getElementById('content');
  var style1 = window.getComputedStyle(el1, null).getPropertyValue('height');
  var contentHeight = parseFloat(style1);

  var el2 = document.getElementById('title-content');
  var style2 = window.getComputedStyle(el2, null).getPropertyValue('height');
  var containerHeight = parseFloat(style2);

  var el = document.getElementById('title-content');
  var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
  var fontSize = parseFloat(style);
  var newFont = fontSize - 1;
  alert(contentHeight);
  while(contentHeight > containerHeight) {
  	el.style.fontSize = (newFont) + 'px';
    var newFont = newFont - 1;
    
    var el1 = document.getElementById('content');
    var style1 = window.getComputedStyle(el1, null).getPropertyValue('height');
    var contentHeight = parseFloat(style1);
  }
  alert(contentHeight);
};

$(document).ready(function() {
  return autoSizeText();
});
