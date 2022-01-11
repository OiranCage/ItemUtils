<?php

namespace oirancage\itemutils\command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class NbtCommand extends \CortexPE\Commando\BaseSubCommand {

	/**
	 * @inheritDoc
	 */
	protected function prepare(): void{
		$this->setPermission("itemutils.command.nbt");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in server.");
			return;
		}

		$item = $sender->getInventory()->getItemInHand();
		$sender->sendMessage($item->nbtSerialize()->toString());
	}
}