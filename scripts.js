autoSizeText() {
  var contentHeight = $('#content').height();
  var containerHeight = $('#resize').height();
  var el = document.getElementById('resize');
  var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
  var fontSize = parseFloat(style);
  var newFont = fontSize - 10;
  alert(contentHeight);
  while(contentHeight > containerHeight) {
  	el.style.fontSize = (newFont) + 'px';
    var newFont = newFont - 10;
    var contentHeight = $('#content').height();
    alert(contentHeight);
  }
};
