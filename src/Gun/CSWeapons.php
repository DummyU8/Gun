<?php

namespace Gun;

use pocketmine\plugin\PluginBase;
use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\network\protocol\UseItemPacket;
use pocketmine\Player;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\item\Item;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\entity\Arrow;
use pocketmine\entity\Snowball;
use pocketmine\event\entity\EntityDespawnEvent;
use pocketmine\scheduler\CallbackTask;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\Server;
use pocketmine\entity\Living;

class CSWeapons extends PluginBase implements Listener {
	public function onEnable() {
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
	}
	
	public function onPacketReceived(DataPacketReceiveEvent $event){
		$pk = $event->getPacket();
		$player = $event->getPlayer();
		if($pk instanceof UseItemPacket and $pk->face === 0xff) {
		$item = $player->getInventory()->getItemInHand();
		if($item->getId() == 0){
		foreach($player->getInventory()->getContents() as $item){
				if ($item->getID() == 0 && $item->getDamage() == 0 && $item->getCount() > 0){
						$nbt = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x ),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () ),
						new DoubleTag ( "", $player->z ) 
				] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) 
				] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) 
				] ) 
		] );
		
		$f = 5.0;
		$snowball = Entity::createEntity ( "Snowball", $player->chunk, $nbt, $player );
		$snowball->setMotion ( $snowball->getMotion ()->multiply ( $f ) );
		$snowball->spawnToAll ();
		$player->getInventory ()->removeItem ( Item::get(0, 0, 1) );
		}
	}
	
						}elseif($item->getId() == 105){
						foreach($player->getInventory()->getContents() as $item){
						if ($item->getID() == 337 && $item->getDamage() == 0 && $item->getCount() > 0 ){
					
						$nbt = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x +1),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () ),
						new DoubleTag ( "", $player->z ) 
				] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) 
				] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) 
				] ) 
		] );
		$nbt6 = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x -1),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () ),
						new DoubleTag ( "", $player->z ) 
				] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) 
				] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) 
				] ) 
		] );
		$nbt2 = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x  ),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () ),
						new DoubleTag ( "", $player->z +1) 
				] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) 
				] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) 
				] ) 
		] );
		$nbt3 = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x ),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () ),
						new DoubleTag ( "", $player->z -1) 
				] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) 
				] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) 
				] ) 
		] );
		$nbt4 = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x ),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () +1 ),
						new DoubleTag ( "", $player->z ) 
				] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) 
				] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) 
				] ) 
		] );
		$nbt5 = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x ),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () -1),
						new DoubleTag ( "", $player->z ) 
				] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) 
				] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) 
				] ) 
		] );
		
		
		$f = 5.0;
		$snowball = Entity::createEntity ( "Snowball", $player->chunk, $nbt, $player );
		$snowball2 = Entity::createEntity ( "Snowball", $player->chunk, $nbt2, $player );
		$snowball3 = Entity::createEntity ( "Snowball", $player->chunk, $nbt3, $player );
		$snowball4 = Entity::createEntity ( "Snowball", $player->chunk, $nbt4, $player );
		$snowball5 = Entity::createEntity ( "Snowball", $player->chunk, $nbt5, $player );
		$snowball6 = Entity::createEntity ( "Snowball", $player->chunk, $nbt6, $player );
		$snowball->setMotion ( $snowball->getMotion ()->multiply ( $f ) );
		$snowball2->setMotion ( $snowball2->getMotion ()->multiply ( $f ) );
		$snowball3->setMotion ( $snowball3->getMotion ()->multiply ( $f ) );
		$snowball4->setMotion ( $snowball4->getMotion ()->multiply ( $f ) );
		$snowball5->setMotion ( $snowball5->getMotion ()->multiply ( $f ) );
		$snowball6->setMotion ( $snowball6->getMotion ()->multiply ( $f ) );
		$snowball->spawnToAll ();
		$snowball2->spawnToAll ();
		$snowball3->spawnToAll ();
		$snowball4->spawnToAll ();
		$snowball5->spawnToAll ();
		$snowball6->spawnToAll ();
		$player->getInventory ()->removeItem ( Item::get(337, 0, 1) );
		if ($snowball instanceof Projectile) {
			$this->server->getPluginManager ()->callEvent ( $projectileEv = new ProjectileLaunchEvent ( $snowball ) );
			if ($projectileEv->isCancelled ()) {
				$snowball->kill ();
			} else {
				
				$this->object_hash [spl_object_hash ( $snowball )] = 1;
				$snowball->spawnToAll ();
			}
		} else {
			$this->object_hash [spl_object_hash ( $snowball )] = 1;
			$snowball->spawnToAll ();
		}
		}
		}
						}elseif($item->getId() == 0){
		foreach($player->getInventory()->getContents() as $item){
				if ($item->getID() == 0 && $item->getDamage() == 0 && $item->getCount() > 0 ){
						$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 0 );
						$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 2 );
			$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 4 );
					$player->getInventory ()->removeItem ( Item::get(0, 0, 1) );
					}
					}
						}elseif($item->getId() == 0){
						foreach($player->getInventory()->getContents() as $item){
				if ($item->getID() == 0 && $item->getDamage() == 0 && $item->getCount() > 0){
						$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 0 );
						$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 5 );
			$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 10 );
					$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 15 );
			$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 20 );
					$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 25 );
					$player->getInventory ()->removeItem ( Item::get(0, 0, 1) );
					}
					}
						}elseif($item->getId() == 104){
						foreach($player->getInventory()->getContents() as $item){
				if ($item->getID() == 337 && $item->getDamage() == 0 && $item->getCount() > 0){
					$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 0 );
					$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 2 );
		          	$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 4 );
					$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 6 );
		           	$this->getServer ()->getScheduler ()->scheduleDelayedTask ( new CallbackTask ( [ 
					$this,
					"burstSnowball" ], [ 
					$player ] ), 8 );
					$player->getInventory ()->removeItem ( Item::get(337, 0, 1) );
					}
					}

		         }else{
			}						
		}
		}
	public function burstSnowball(Player $player) {
		$nbt = new CompoundTag ( "", [ 
				"Pos" => new ListTag ( "Pos", [ 
						new DoubleTag ( "", $player->x ),
						new DoubleTag ( "", $player->y + $player->getEyeHeight () ),
						new DoubleTag ( "", $player->z ) ] ),
				"Motion" => new ListTag ( "Motion", [ 
						new DoubleTag ( "", - \sin ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "", - \sin ( $player->pitch / 180 * M_PI ) ),
						new DoubleTag ( "",\cos ( $player->yaw / 180 * M_PI ) *\cos ( $player->pitch / 180 * M_PI ) ) ] ),
				"Rotation" => new ListTag ( "Rotation", [ 
						new FloatTag ( "", $player->yaw ),
						new FloatTag ( "", $player->pitch ) ] ) ] );
		
		$f = 5.0;
		$snowball = Entity::createEntity ( "Snowball", $player->chunk, $nbt, $player );
		$snowball->setMotion ( $snowball->getMotion ()->multiply ( $f ) );
		
		if ($snowball instanceof Projectile) {
			$this->server->getPluginManager ()->callEvent ( $projectileEv = new ProjectileLaunchEvent ( $snowball ) );
			if ($projectileEv->isCancelled ()) {
				$snowball->kill ();
			} else {
				
				$this->object_hash [spl_object_hash ( $snowball )] = 1;
				$snowball->spawnToAll ();
			}
		} else {
			$this->object_hash [spl_object_hash ( $snowball )] = 1;
			$snowball->spawnToAll ();
		}
	}
		public function onDamage(EntityDamageEvent $event){
		$player = $event->getEntity();
		$entity = $event->getEntity();
        if($player instanceof Player && $event->getCause() === EntityDamageEvent::CAUSE_PROJECTILE){
                $event->setDamage(6);
        }
	}
}
?>