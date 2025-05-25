# QuickCommands
Pocketmine Essentials Plugin
QuickCommands Plugin
====================

Author: FiX
Version: 1.0.0
API: PocketMine-MP 5.0.0

Description:
------------
QuickCommands is a custom PocketMine-MP plugin that provides quick and easy commands
like gamemode switching, selling items, checking balances, crate keys, and more.

Features:
---------
- /gmc       : Set gamemode to Creative (OP only)
- /gms       : Set gamemode to Survival
- /sa        : Sell all items
- /key       : Give crate keys (OP only)
- /inbox     : Check your key rewards inbox
- /bal       : Check your balance
- /baltop    : View top balances
- /vortexhelp: Shows help info for custom plugins (can be renamed)

Installation:
-------------
1. Download the QuickCommands plugin folder or PHAR file.
2. Place the folder or PHAR file into the 'plugins' directory of your PocketMine-MP server.
3. Restart or reload your server.
4. Configure permissions as needed.

Customization:
--------------
You can rename the /vortexhelp command to something like "/yourserverhelp" in the commands.yml or plugin.yml file.
Only OPs will see the OP commands listed in the help, while non-OP players will see only the commands available to them.

Permissions:
------------
quickcommands.gmc        - OP only (Creative gamemode)
quickcommands.gms        - OP only (Survival gamemode)
quickcommands.sa         - Everyone
quickcommands.key        - OP only (Give crate keys)
quickcommands.inbox      - Everyone
quickcommands.bal        - Everyone
quickcommands.baltop     - Everyone
quickcommands.vortexhelp - Everyone

Commands:
---------
- /gmc
- /gms
- /sa
- /key <crate> <amount> <player>
- /inbox
- /bal
- /baltop
- /vortexhelp (or your custom help command)

Support & Issues:
-----------------
If you find bugs or want to request features, please contact the author.

If you like this plugin, please share and rate! :D

License:
--------
MIT License

---

Thank you for using QuickCommands!

