var autoSizeText;

autoSizeText = function() {
  var el1 = document.getElementById('content');
  var style1 = window.getComputedStyle(el1, null).getPropertyValue('height');
  var contentHeight = parseFloat(style1);

  var el2 = document.getElementById('title-content');
  var style2 = window.getComputedStyle(el2, null).getPropertyValue('height');
  var containerHeight = parseFloat(style2);

  var fontSize = 200;
  var newFont = fontSize - 1;

  while(contentHeight > containerHeight) {
  	el.style.fontSize = (newFont) + 'px';
    var newFont = newFont - 1;

    var el1 = document.getElementById('content');
    var style1 = window.getComputedStyle(el1, null).getPropertyValue('height');
    var contentHeight = parseFloat(style1);
  }
};

$(document).ready(function() {
  return autoSizeText();
});
