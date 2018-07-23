// Parallax(if you use imageonly for background image)
(function () {
	if (document.getElementsByClassName('parallax').length && document.getElementsByClassName('take-from-widget').length) {
		var i = 0, href, listWhichTake = document.getElementsByClassName('take-from-widget');
		for (; i < listWhichTake.length; i++) {
			href = listWhichTake[i].childNodes[1].src;
			if (href){
				listWhichTake[i].style.backgroundImage = 'url(' + href + ')';
			}
		}
	}
})();