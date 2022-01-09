<?php

namespace oirancage\itemutils\command;

use pocketmine\command\CommandSender;

class ItemUtilsCommand extends \CortexPE\Commando\BaseCommand {

	/**
	 * @inheritDoc
	 */
	protected function prepare(): void{
		$this->registerSubCommand(new DuplicateCommand("duplicate", "duplicate item with named tag", ["dup"]));
		$this->registerSubCommand(new ImportCommand("import", "import item from json", ["imp"]));
		$this->registerSubCommand(new ExportCommand("export", "export item to json text", ["exp"]));
	}

	/**
	 * @inheritDoc
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		$this->sendUsage();
	}
}