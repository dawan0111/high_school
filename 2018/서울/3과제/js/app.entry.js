// slide animation
function slide () {}

// tab menu
function tabView () { }

// application init
function init () {
	Animation.init()
	Navigation.init()
	Layer.init()
	Path.init()
}

// event register
$(init)
	.on('click', '.toMain', Navigation.goToMain)
	.on('click', '.site-menu li', Navigation.goToPage)
	.on('click', '.arrow a', Navigation.goToArrow)