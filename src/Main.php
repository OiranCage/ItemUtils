<?php

namespace oirancage\itemutils;

use CortexPE\Commando\exception\HookAlreadyRegistered;
use CortexPE\Commando\PacketHooker;
use oirancage\itemutils\command\ItemUtilsCommand;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
	public function onEnable(): void{
		if(!PacketHooker::isRegistered()) {
			PacketHooker::register($this);
		}
		$this->getServer()->getCommandMap()->register("itemutils", new ItemUtilsCommand($this, "itemutils", "item utility", ["iu"]));
	}
}