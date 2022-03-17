<?php

namespace oirancage\itemutils\command;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class ExportCommand extends BaseSubCommand {

	protected function prepare(): void{
		$this->setPermission("itemutils.command.export");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in server.");
			return;
		}

		$bookWithPen = VanillaItems::WRITABLE_BOOK();
		$inventory = $sender->getInventory();
		if($inventory->canAddItem($bookWithPen)){
			$item = $inventory->getItemInHand();
			$text = json_encode($item);
			foreach(mb_str_split($text, 200) as $k => $v){
				$bookWithPen->setPageText($k, $v);
			}
			$inventory->addItem($bookWithPen);
			$sender->sendMessage("Successfully export item.");
		}else{
			$sender->sendMessage("You have no space to export item into writable book.");
		}
	}
}