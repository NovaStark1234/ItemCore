<?php

namespace ItemCore;

use pocketmine\scheduler\Task;
use ItemCore\Main;

class RepeatTask extends Task {
	
	/**
	Construct Main $plugin
	*/
	public function __construct(Main $plugin) {
		$this->plugin = $plugin;
	}
	
	/**
	onRun() function
	*/
	public function onRun() :void {
	  if($this->plugin->cfg->get("Enable") == true) {
		foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {
			$inv = $player->getinventory();
			if($inv->getItemInHand()->getId() !== (int) $this->plugin->cfg->get("ItemId")) {
				return;
			} elseif($inv->getItemInHand()->getId() == (int) $this->plugin->cfg->get("ItemId")) {
				$text = str_replace(["{x}", "{y}", "{z}", "{world}", "{direction}"], [$player->getPosition()->getFloorX(), $player->getPosition()->getFloorY(), $player->getPosition()->getFloorZ(), $player->getWorld()->getDisplayName(), $this->getPlayerDirection($player->getLocation()->getYaw() - 90)], (string) $this->plugin->cfg->get("Text"));
				switch(strtolower($this->plugin->cfg->get("ShowType"))) {
			        case "tip":
                        $player->sendTip($text);
                    break;
                    case "popup":
                        $playet->sendPopup($text);
                    break;
                }
			}
		}
	  } else {
	    return;
	  }
	}
	
	/**
	Get player's Direction function
    Return String
	*/
	public function getPlayerDirection(float $deg) :string {
		$deg %= 360;
		if($deg < 0){
			$deg += 360;
		}
        $cfg = $this->plugin->cfg;
		if(22.5 <= $deg and $deg < 67.5) {
			return (string) $cfg->get("FormatNorthWest"); //"NorthWest";
		} elseif(67.5 <= $deg and $deg < 112.5) {
			return (string) $cfg->get("FormatNorth"); //"North";
		} elseif(112.5 <= $deg and $deg < 157.5) {
			return (string) $cfg->get("FormatNorthEast"); //"NorthEast";
		} elseif(157.5 <= $deg and $deg < 202.5) {
			return (string) $cfg->get("FormatEast"); //"East";
		} elseif(202.5 <= $deg and $deg < 247.5){
			return (string) $cfg->get("FormatSouthEast"); //"SouthEast";
		}elseif(247.5 <= $deg and $deg < 292.5) {
			return (string) $cfg->get("FormatSouth"); //"South";
		} elseif(292.5 <= $deg and $deg < 337.5) {
			return (string) $cfg->get("FormatSouthWest"); //"SouthWest";
		} else {
			return (string) $cfg->get("FormatWest"); //"West";
		}
	}
	
}
