<?php

namespace QuickCommands;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\utils\Config;

class Main extends PluginBase {

    private Config $config;
    private string $helpCommand;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, [
            "help-command" => "vortexhelp"
        ]);
        $this->helpCommand = strtolower($this->config->get("help-command", "vortexhelp"));

        // Clean ASCII logo with GitHub link
        $logoLines = [
            TextFormat::RED . "  ___________.__  ____  ___",
            TextFormat::RED . "  \\_   _____/|__| \\   \\/  /",
            TextFormat::RED . "   |    __)  |  |  \\     / ",
            TextFormat::RED . "   |     \\   |  |  /     \\\\",
            TextFormat::RED . "   \\___  /   |__| /___/\\  \\\\",
            TextFormat::RED . "       \\/               \\/",
            TextFormat::GRAY . "   GitHub: " . TextFormat::BLUE . "https://github.com/FiXUnique"
        ];

        foreach ($logoLines as $line) {
            $this->getLogger()->info($line);
        }

        $this->getLogger()->info("QuickCommands enabled. Help command: /" . $this->helpCommand);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        $name = strtolower($command->getName());
        $consoleSender = new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage());

        if (!$sender instanceof Player) {
            if (in_array($name, ["bal", "baltop", "gmc", "gms", "sa", "key", "inbox", $this->helpCommand, "vortexhelp", "serverhelp", "help", "?"])) {
                $sender->sendMessage(TextFormat::RED . "This command can only be used in-game.");
                return true;
            }
        }

        switch ($name) {
            case "gmc":
                if ($sender instanceof Player && $sender->hasPermission("quickcommands.gmc")) {
                    $this->getServer()->dispatchCommand($consoleSender, "gamemode creative " . $sender->getName());
                    $sender->sendMessage(TextFormat::GREEN . "Gamemode set to Creative.");
                } else {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }
                return true;

            case "gms":
                if ($sender instanceof Player) {
                    $this->getServer()->dispatchCommand($consoleSender, "gamemode survival " . $sender->getName());
                    $sender->sendMessage(TextFormat::GREEN . "Gamemode set to Survival.");
                }
                return true;

            case "sa":
                if ($sender instanceof Player && $sender->hasPermission("quickcommands.sa")) {
                    $this->getServer()->dispatchCommand($sender, "sellall");
                } else {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }
                return true;

            case "key":
                if ($sender instanceof Player && $sender->hasPermission("quickcommands.key")) {
                    if (count($args) < 3) {
                        $sender->sendMessage(TextFormat::RED . "Usage: /key <crate> <amount> <player>");
                        return true;
                    }
                    $crate = $args[0];
                    $amount = (int)$args[1];
                    $playerName = $args[2];
                    $this->getServer()->dispatchCommand($consoleSender, "mc key $crate $amount $playerName");
                    $sender->sendMessage(TextFormat::GREEN . "Gave $amount $crate keys to $playerName.");
                } else {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }
                return true;

            case "inbox":
                if ($sender instanceof Player && $sender->hasPermission("quickcommands.inbox")) {
                    $this->getServer()->dispatchCommand($sender, "mc receive");
                } else {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }
                return true;

            case "bal":
                if ($sender instanceof Player && $sender->hasPermission("quickcommands.bal")) {
                    $this->getServer()->dispatchCommand($sender, "balance");
                } else {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command or it must be run in-game.");
                }
                return true;

            case "baltop":
                if ($sender instanceof Player && $sender->hasPermission("quickcommands.baltop")) {
                    $this->getServer()->dispatchCommand($sender, "rich");
                } else {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command or it must be run in-game.");
                }
                return true;

            case "vortexhelp":
            case "serverhelp":
            case "help":
            case "?":
            case $this->helpCommand:
                if ($sender instanceof Player && $sender->hasPermission("quickcommands.vortexhelp")) {
                    $sender->sendMessage(TextFormat::GOLD . "=== " . TextFormat::YELLOW . "Vortex Plugin Help" . TextFormat::GOLD . " ===");
                    $sender->sendMessage(TextFormat::GRAY . "Custom Plugins:");
                    $sender->sendMessage(TextFormat::AQUA . "- KeyRewards: Manage crate keys and rewards.");
                    $sender->sendMessage(TextFormat::AQUA . "- QuickCommands: Provides useful quick commands.");
                    $sender->sendMessage(TextFormat::GRAY . "Created by FiX");
                    $sender->sendMessage("");
                    $sender->sendMessage(TextFormat::GREEN . "QuickCommands for NON-OP:");
                    $sender->sendMessage(TextFormat::YELLOW . "/gms " . TextFormat::WHITE . "- Set gamemode to Survival");
                    $sender->sendMessage(TextFormat::YELLOW . "/sa " . TextFormat::WHITE . "- Sell all items");
                    $sender->sendMessage(TextFormat::YELLOW . "/inbox " . TextFormat::WHITE . "- Check your key rewards inbox");
                    $sender->sendMessage(TextFormat::YELLOW . "/bal " . TextFormat::WHITE . "- Check your balance");
                    $sender->sendMessage(TextFormat::YELLOW . "/baltop " . TextFormat::WHITE . "- View top balances");
                    $sender->sendMessage("");
                    if ($sender->hasPermission("quickcommands.ophelp")) {
                        $sender->sendMessage(TextFormat::RED . "QuickCommands for OP:");
                        $sender->sendMessage(TextFormat::YELLOW . "/gmc " . TextFormat::WHITE . "- Set gamemode to Creative");
                        $sender->sendMessage(TextFormat::YELLOW . "/key <crate> <amount> <player> " . TextFormat::WHITE . "- Give crate keys");
                    }
                } else {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }
                return true;
        }

        return false;
    }
}