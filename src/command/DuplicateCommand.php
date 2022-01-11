<?php

namespace oirancage\itemutils\command;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\args\TextArgument;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class DuplicateCommand extends BaseSubCommand {

	protected function prepare(): void{
		$this->setPermission("itemutils.command.duplicate");
		$this->registerArgument(0, new IntegerArgument("quantity", true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in server.");
			return;
		}

		$quantity = ($args["quantity"] ?? 1);
		$inventory = $sender->getInventory();
		$item = clone $inventory->getItemInHand();
		$item->setCount($quantity);
		$addableQuantity = $inventory->getAddableItemQuantity($item);
		if($quantity <= 0){
			$sender->sendMessage("Quantity should be bigger than 0.");
			return;
		}

		if($addableQuantity === 0){
			$sender->sendMessage("You have no space to add item.");
			return;
		}

		if($addableQuantity < $quantity){
			$item->setCount($addableQuantity);
			$sender->sendMessage("You have not enough space to add $quantity items.");
			$sender->sendMessage("Quantity has been changed to $addableQuantity.");
		}

		$inventory->addItem($item);
		$sender->sendMessage("Successfully duplicate item.");
	}
}