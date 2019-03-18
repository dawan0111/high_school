// page class
class Navigation {

	// instance Constructor
	constructor () { }

	// set static variable
	static init () {

		// jQuery selector minimization
		Navigation.main    = $('.main')
		Navigation.sub     = $('.sub')
		Navigation.page    = $('.page')
		Navigation.gnb     = $('.gnb')
		Navigation.len     = Navigation.gnb.find('li').length
		Navigation.section = Navigation.page.find('>section')
		Navigation.nowPage = -1
	}

	// go to main page
	static goToMain () {
		Navigation.nowPage = -1
		Navigation.sub.removeClass('active')
		Navigation.page.find('>section.active').removeClass('active')
		Navigation.main.addClass('active')
	}

	// go to selected sub page
	static goToPage () {
		Navigation.goToPageReal($(this).index())
	}

	// go to page
	static goToPageReal (num) {
		// variable set
		const main = Navigation.main,
			  sub  = Navigation.sub,
			  page = Navigation.page,
			  gnb  = Navigation.gnb

		if (Navigation.nowPage === -1) {
			main.removeClass('active')
			sub.addClass('active')
		}

		page.find('>section.active').removeClass('active')
		page.find('>section').eq(num).addClass('active')
		gnb.find('li.active').removeClass('active')
		gnb.find('li').eq(num).addClass('active')
		Navigation.nowPage = num
	}

	// go to selected sub page
	static goToArrow () {
		// variable set 
		const _this = $(this),
		      len   = Navigation.len
		let   num   = Navigation.nowPage
		num = _this.hasClass('left') ? num - 1 : num + 1
		if (num == -1 || num >= len) {
			Navigation.goToMain()
			return
		} else if (num < -1) {
			num = len - 1
		}
		Navigation.goToPageReal(num)
	}
}