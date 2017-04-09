greetings(){
  alert('hello');
}

autoSizeText() {
  var contentHeight = $('#content').height();
  var containerHeight = $('#title-content').height();
  var el = document.getElementById('title-content');
  var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
  var fontSize = parseFloat(style);
  var newFont = fontSize - 0.1;
  alert(contentHeight);
  while(contentHeight > containerHeight) {
  	el.style.fontSize = (newFont) + 'px';
    var newFont = newFont - 0.1;
    var contentHeight = $('#content').height();
  }
  alert(contentHeight);
};
