<?php

namespace oirancage\itemutils\command;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class RenameCommand extends BaseSubCommand {

	protected function prepare(): void{
		$this->setPermission("itemutils.command.rename");
		$this->registerArgument(0, new RawStringArgument("name"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in server.");
			return;
		}
		$item = $sender->getInventory()->getItemInHand();
		$item->setCustomName($args[0]);
	}
}