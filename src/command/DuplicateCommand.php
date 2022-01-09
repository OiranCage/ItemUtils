<?php

namespace oirancage\itemutils\command;

use CortexPE\Commando\args\TextArgument;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class DuplicateCommand extends BaseSubCommand {

	protected function prepare(): void{
		$this->setPermission("itemutils.command.duplicate");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in server.");
			return;
		}

		$inventory = $sender->getInventory();
		$item = $inventory->getItemInHand();
		if($inventory->canAddItem($item)){
			$inventory->addItem($item);
			$sender->sendMessage("Successfully duplicate item.");
		}else{
			$sender->sendMessage("You have no space to add item.");
		}
	}
}