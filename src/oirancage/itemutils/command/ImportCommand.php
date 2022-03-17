<?php

namespace oirancage\itemutils\command;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\player\Player;

class ImportCommand extends BaseSubCommand {

	protected function prepare(): void{
		$this->setPermission("itemutils.command.import");
		$this->registerArgument(0, new RawStringArgument("nbt"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in server.");
			return;
		}
		try{
			$item = Item::jsonDeserialize(json_decode($args["nbt"], true));
		}catch(\Exception $exception){
			$sender->sendMessage("Invalid json serialized item was given.");
			return;
		}

		$inventory = $sender->getInventory();
		if($inventory->canAddItem($item)){
			$inventory->addItem($item);
			$sender->sendMessage("Successfully give item");
		}else{
			$sender->sendMessage("You have no space to add given item.");
		}
	}
}