<?php

declare(strict_types = 1);

namespace ItemCore;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase {
	
	/**
	onEnable() function
	*/
	public function onEnable() :void {
		$task = new RepeatTask($this);
		$this->getScheduler()->scheduleRepeatingTask($task, 1);
		@mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
	}
	
}
