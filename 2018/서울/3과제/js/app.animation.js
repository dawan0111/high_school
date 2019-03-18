// animation set
class Animation {

	play () { }

	clear () { }

	static init () {
		Animation.styleSet();

		$(".child-animation > *:not(.child-animation)").each(function(idx, el) {
			var $el = $(el);
			var type = $el.parent().data('type');

			$el.addClass("animation "+type);
		});
		
		$(".animation").addClass("animationBefore");
	}

	static styleSet () {
		$("head").append(`
			<style>
				.animation { transition: 1s ease; transform: inherit; opacity: 1; }
				.animationBefore { transition: 0s ease; transform: scale(0); opacity: 0; }
				.animationBefore.l2r { transform: translateX(-100px); }
				.animationBefore.r2l { transform: translateX(100px); }
				.animationBefore.t2b { transform: translateY(-100px); }
				.animationBefore.b2t { transform: translateY(100px); }
				.animationBefore.type2 { transition: 1s ease }
			</style>
		`);
	}
}