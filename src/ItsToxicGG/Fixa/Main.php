<?php

namespace ItsToxicGG\Fixa;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;
use pocketmine\math\Vector3;
use pocketmine\world\Position;
use pocketmine\world\World;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\ItemFactory;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;

class Main extends PluginBase implements Listener {
    
    public function onEnable(): void{
        $this->getServer()->getLogger()->info("§f[§aEnabled§f] TheHiveLobbyCore");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
    }

    public function onLoad(): void{
        $this->getServer()->getLogger()->info("§f[§eLoading§f] TheHiveLobbyCore");
    }

    public function onDisable(): void{
        $this->getServer()->getLogger()->info("§f[§cDisable§f] TheHiveLobbyCore");
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $player->getInventory()->clearAll();
        $item1 = ItemFactory::getInstance()->get(345, 0, 1);
        $item2 = ItemFactory::getInstance()->get(450, 0, 1);
        $item3 = ItemFactory::getInstance()->get(421, 0, 1);
        $item4 = ItemFactory::getInstance()->get(403, 0, 1);
        $item1->setCustomName($this->getConfig()->get("item1-name"));
        $item2->setCustomName($this->getConfig()->get("item2-name"));
        $item3->setCustomName($this->getConfig()->get("item3-name"));
        $item4->setCustomName($this->getConfig()->get("item4-name"));
        $player->getInventory()->setItem(0, $item1);
        $player->getInventory()->setItem(6, $item2);
        $player->getInventory()->setItem(7, $item3);
        $player->getInventory()->setItem(8, $item4);
    }

    public function onClick(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $itn = $player->getInventory()->getItemInHand()->getCustomName();
        if($itn == $this->getConfig()->get("item1-name")){
            $this->getServer()->getCommandMap()->dispatch($player, $this->getConfig()->get("item1-cmd"));
        }
        if($itn == $this->getConfig()->get("item2-name")){
            $this->getServer()->getCommandMap()->dispatch($player, $this->getConfig()->get("item2-cmd"));
        }
        if($itn == $this->getConfig()->get("item3-name")){
            $this->getServer()->getCommandMap()->dispatch($player, $this->getConfig()->get("item3-cmd"));
        }
        if($itn == $this->getConfig()->get("item4-name")){
            $this->getServer()->getCommandMap()->dispatch($player, $this->getConfig()->get("item4-cmd"));
        }
    }

    public function onInventory(InventoryTransactionEvent $event){
        $event->cancel();
    }
}
