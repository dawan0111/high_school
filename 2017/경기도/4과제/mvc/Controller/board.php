<?php

namespace Controller;

use Model\board as Mboard;
use Model\Website;

class board
{
	public function adminAddn()
	{
		$idx = Mboard::makeBoard($_POST['normalBoard'], "normal", false);
		$webSite = Website::findSite();

		$normalBoard = explode(", ", $webSite['normal_board']);
		$normalBoard[] = $idx;
		$nBoard = join($normalBoard, ", ");

		WebSite::boardUpdate($nBoard, "normal_board");

		return redirect("/page/boardsetting");
	}

	public function adminAddp()
	{
		$idx = Mboard::makeBoard($_POST['photoBoard'], "photo", false);
		$webSite = Website::findSite();

		$normalBoard = explode(", ", $webSite['photo_board']);
		$normalBoard[] = $idx;
		$nBoard = join($normalBoard, ", ");

		WebSite::boardUpdate($nBoard, "photo_board");

		return redirect("/page/boardsetting");
	}

	public function delete($url)
	{
		Mboard::delete($url);

		return redirect("/page/boardsetting");
	}

	public function tagSetup()
	{
		$tag  = $_POST['tag'];
		$tagText = join($tag, ", ");

		WebSite::tagUpdate($tagText);

		return redirect("/page/admintag");
	}
}