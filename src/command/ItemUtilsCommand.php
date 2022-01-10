<?php

namespace oirancage\itemutils\command;

use pocketmine\command\CommandSender;

class ItemUtilsCommand extends \CortexPE\Commando\BaseCommand {

	/**
	 * @inheritDoc
	 */
	protected function prepare(): void{
		$this->registerSubCommand(new DuplicateCommand("duplicate", "duplicate item with named tag", ["d"]));
		$this->registerSubCommand(new RenameCommand("rename", "rename item", ["r"]));
		$this->registerSubCommand(new ImportCommand("import", "import item from json", ["i"]));
		$this->registerSubCommand(new ExportCommand("export", "export item to json text", ["e"]));
	}

	/**
	 * @inheritDoc
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		$this->sendUsage();
	}
}