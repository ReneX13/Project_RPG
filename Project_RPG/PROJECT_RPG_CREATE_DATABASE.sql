CREATE DATABASE PROJECT_RPG;
USE PROJECT_RPG;


/*--ACCOUNT:	Holds account info, email is unique,
	--Functional dependencies: BCNF
		--Account_ID -> Email, Email -> Account_ID
		--Email -> Password, First_Name, Last_Name*/
CREATE TABLE ACCOUNT(Account_ID INT(8) UNSIGNED PRIMARY KEY,
					 Email VARCHAR(64) NOT NULL UNIQUE,
					 Password VARCHAR(24) NOT NULL,
					 First_Name VARCHAR(24) NOT NULL,
					 Last_Name VARCHAR(24) NOT NULL)
					 ENGINE = INNODB; 

/*--ACCOUNT_BILLING: Holds account billing info, multiple cards registered for each account,
	--Functional dependencies: BCNF
		--Only one trivial dependencies, ALL_ATTRIBUTES -> ALL_ATTRIBUTES*/
CREATE TABLE ACCOUNT_BILLING(Account_ID INT UNSIGNED NOT NULL,
							 Card_Number BIGINT(16)UNSIGNED NOT NULL, 
							 Security_Code INT (3)UNSIGNED NOT NULL,
					         Expiration_Month INT(2)UNSIGNED NOT NULL,
					         Expiration_Year INT(4)UNSIGNED NOT NULL,
							 CONSTRAINT PK_ACCOUNT_BILL PRIMARY KEY (Account_ID, Card_Number,Security_Code,Expiration_Month,Expiration_Year),
							 FOREIGN KEY (Account_ID) REFERENCES ACCOUNT(Account_ID))
							 ENGINE = INNODB;

/*--CHARACTER_RACE_DATA: This table holds the base stats your character has for its race. Each race is in either faction, Alliance or Swarm.
	--Functional dependencies:	BCNF
		--Race_Type -> Stats, Faction*/
CREATE TABLE CHARACTER_RACE_DATA(Race_Type VARCHAR(16) PRIMARY KEY,
							     Stats VARBINARY(64) NOT NULL,
							     Faction ENUM('Alliance','Swarm') NOT NULL)
								 ENGINE = INNODB;
								 
/*--CHARACTER_CLASS_DATA: This tables holds the base stats your character has for its class. 
	--Functional dependencies: BCNF
		--Class_Type -> Stats*/
CREATE TABLE CHARACTER_CLASS_DATA(Class_Type VARCHAR(16) PRIMARY KEY,
							      Stats VARBINARY(64) NOT NULL)
								  ENGINE = INNODB;
								 
/*--PLAYER_CHARACTER: This tables hold basic information of a player's character. Since each Character_Name is unique, 
				--  Character_Name is associated with the player's Account_ID, However, the Account_ID is associated with
				--  multiple characters owned by the player.
	--Functional dependencies: BCNF
		--Character_Name -> Class_Type, Race_Type, Gender, Char_Level, Account_ID*/
CREATE TABLE PLAYER_CHARACTER(Character_Name VARCHAR(24) PRIMARY KEY,
							  Class_Type VARCHAR(16)NOT NULL ,
							  Race_Type VARCHAR(16) NOT NULL,
							  Gender ENUM('Male', 'Female') NOT NULL,
							  Char_Level INT(3) UNSIGNED  NOT NULL,
							  Account_ID INT UNSIGNED NOT NULL,
							  FOREIGN KEY (Account_ID) REFERENCES ACCOUNT(Account_ID),
							  FOREIGN KEY (Race_Type) REFERENCES CHARACTER_RACE_DATA(Race_Type),
							  FOREIGN KEY (Class_Type) REFERENCES CHARACTER_CLASS_DATA(Class_Type))
							  ENGINE = INNODB;


/*--ELEMENT: Holds all element types.
	--Functional Dependencies: Trivial*/
CREATE TABLE ELEMENT(Element VARCHAR(16) PRIMARY KEY )
					 ENGINE = INNODB;

/*--ELEMENT: Holds weakness and resistant elements against each element.
	--Functional Dependencies: BCNF
		--Element -> Weak_Against, Resistant_Against*/
CREATE TABLE ELEMENT_WEAKNESS_AND_RESISTANCES(Element VARCHAR(16) NOT NULL PRIMARY KEY,
											  Weak_Against VARCHAR(16) NOT NULL,
											  Resistant_Against VARCHAR(16) NOT NULL,
											  FOREIGN KEY (Element) REFERENCES ELEMENT(Element),
											  FOREIGN KEY (Weak_Against) REFERENCES ELEMENT(Element),
											  FOREIGN KEY (Resistant_Against) REFERENCES ELEMENT(Element))
											  ENGINE = INNODB;

/*--ITEM: Holds the data for the existing items in the game.
	----Functional Dependencies: BCNF
			-- Item_ID -> Item_Name 
			-- Item_Name -> HP_MP, Effect_Remove*/
CREATE TABLE ITEM(Item_ID INT(8) UNSIGNED PRIMARY KEY,
				  Item_Name VARCHAR(64) NOT NULL UNIQUE,
				  HP_MP VARBINARY(16) NOT NULL,
				  Effect_Remove  VARBINARY(8) NOT NULL)
				  ENGINE = INNODB;

/*--WEAPONS: Holds the data for the existing weapons in the game.
	----Functional Dependencies: BCNF
			-- Weapon_ID -> Weapon_Name 
			-- Weapon_Name -> Weapon_Type, Handed, Stats, Stats_Effect, Element*/
CREATE TABLE WEAPON(Weapon_ID INT(8) UNSIGNED PRIMARY KEY,
					Weapon_Name VARCHAR(64) NOT NULL UNIQUE,
					Weapon_Type ENUM('Sword', 'Axe', 'Great Axe', 'Great Sword', 'Bow', 'Rifle', 'Handgun', 'Staff', 'Wand', 'Mace', 'Dagger') NOT NULL,
					Handed ENUM('One', 'Two'),
					Stats VARBINARY(64) NOT NULL,
				    Stats_Effect VARBINARY(8) NOT NULL,
					Element VARCHAR(16) NOT NULL,
					FOREIGN KEY (Element) REFERENCES ELEMENT(Element))
					ENGINE = INNODB;

/*--ARMOR: Holds the data for the existing armor in the game.
	--Functional Dependencies: BCNF
			-- Armor_ID -> Armor_Name 
			-- Armor_Name -> Armor_Type, Handed, Armor_Material, Stats, Stats_Effect, Element*/					
CREATE TABLE ARMOR(Armor_ID INT(8) UNSIGNED PRIMARY KEY,
				   Armor_Name VARCHAR(64) NOT NULL UNIQUE,
				   Armor_Type ENUM('Head', 'Chest', 'Legs', 'Hands','Feet') NOT NULL,
				   Armor_Material ENUM('Plate', 'Mail', 'Leather', 'Cloth') NOT NULL,
				   Stats VARBINARY(64) NOT NULL,
				   Stats_Effect VARBINARY(8) NOT NULL,
				   Element VARCHAR(16) NOT NULL,
				   FOREIGN KEY (Element) REFERENCES ELEMENT(Element))
				   ENGINE = INNODB;

/*--ABILITY: Holds the data for the existing abilities in the game.
	--Functional Dependencies: BCNF
		--Ability_ID -> Ability_Name
		--Ability_Name -> Ability_Type, Power_Level, Effect_Apply, Effect_Remove, Element*/
CREATE TABLE ABILITY(Ability_ID INT(8) UNSIGNED PRIMARY KEY,
				     Ability_Name VARCHAR(64) NOT NULL UNIQUE,
					 Ability_Type ENUM('Physical_ATK', 'Range_ATK', 'Magical_ATK', 'Heal') NOT NULL,
					 Power_Level INT(1) UNSIGNED NOT NULL,
					 Effect_Apply  VARBINARY(8) NOT NULL,
				     Effect_Remove  VARBINARY(8) NOT NULL,
					 Element VARCHAR(16) NOT NULL,
				     FOREIGN KEY (Element) REFERENCES ELEMENT(Element))
					 ENGINE = INNODB;

/*--ENEMY: Holds data of each enemy that exists in the game.
	--Functional Dependencies: 
		--Enemy_ID -> Enemy_Name
		--Enemy_Name -> Stats, Element*/
CREATE TABLE ENEMY(Enemy_ID INT(8) UNSIGNED PRIMARY KEY,
				   Enemy_Name VARCHAR(64) NOT NULL UNIQUE,
				   Stats VARBINARY(64) NOT NULL,
				   Element VARCHAR(16) NOT NULL,
				   FOREIGN KEY (Element) REFERENCES ELEMENT(Element))
				   ENGINE = INNODB;

/*--NPC: Holds data of each enemy that exists in the game.
	--Functional Dependencies: 
		--NPC_ID -> NPC_Name
		--NPC_Name -> Stats, Element*/	   
CREATE TABLE NPC(NPC_ID INT(8) UNSIGNED PRIMARY KEY,
				 NPC_Name VARCHAR(64) NOT NULL UNIQUE,
				 Stats VARBINARY(64) NOT NULL,
				 Element VARCHAR(16) NOT NULL,
				 FOREIGN KEY (Element) REFERENCES ELEMENT(Element))
				 ENGINE = INNODB; 

/*--REGION: Holds basic data of each region that exists in the game.	
	--Functional Dependencies: BCNF
		--Region_ID -> Region_Name
		--Region_Name -> Region_Name, Region_Description*/
CREATE TABLE REGION(Region_ID INT(8) UNSIGNED PRIMARY KEY,
					Region_Name VARCHAR(64) NOT NULL UNIQUE,
					Region_Description TEXT NOT NULL)
					ENGINE = INNODB;

/*--TOWN: Holds basic data of each towns that exists in the game.
	--Functional Dependencies: BCNF
		--Town_ID -> Town_Name, Region_ID*/
CREATE TABLE TOWN(Town_ID INT(8) UNSIGNED PRIMARY KEY,
				  Town_Name VARCHAR(64) NOT NULL UNIQUE,
				  Region_ID INT(8) UNSIGNED NOT NULL,
				  FOREIGN KEY(Region_ID) REFERENCES REGION(Region_ID))
				  ENGINE = INNODB;
				  
/* ##########################################################################################*/
/* ##########################################################################################*/
	/* RELATIONAL TABLES  */
/* ##########################################################################################*/
/* ##########################################################################################*/
CREATE TABLE ENEMY_ITEM_DROP(Enemy_ID INT(8) UNSIGNED NOT NULL,
							 Item_ID INT(8) UNSIGNED NOT NULL,
							 Drop_Rate DECIMAL(5,5) UNSIGNED NOT NULL,
							 CONSTRAINT PK_ITEM_DROP PRIMARY KEY (Enemy_ID, Item_ID),
							 FOREIGN KEY (Enemy_ID) REFERENCES ENEMY(Enemy_ID),
							 FOREIGN KEY (Item_ID) REFERENCES ITEM(Item_ID))
							 ENGINE = INNODB;
							 
CREATE TABLE ENEMY_WEAPON_DROP(Enemy_ID INT(8) UNSIGNED NOT NULL,
							   Weapon_ID INT(8) UNSIGNED NOT NULL,
							   Drop_Rate DECIMAL(5,5) UNSIGNED NOT NULL,
							   CONSTRAINT PK_WEAPON_DROP PRIMARY KEY (Enemy_ID, Weapon_ID),
							   FOREIGN KEY (Enemy_ID) REFERENCES ENEMY(Enemy_ID),
							   FOREIGN KEY (Weapon_ID) REFERENCES WEAPON(Weapon_ID))
							   ENGINE = INNODB;
				
CREATE TABLE ENEMY_ARMOR_DROP(Enemy_ID INT(8) UNSIGNED NOT NULL,
							  Armor_ID INT(8) UNSIGNED NOT NULL,
							  Drop_Rate DECIMAL(5,5) UNSIGNED NOT NULL,
							  CONSTRAINT PK_ARMOR_DROP PRIMARY KEY (Enemy_ID, Armor_ID),
							  FOREIGN KEY (Enemy_ID) REFERENCES ENEMY(Enemy_ID),
							  FOREIGN KEY (Armor_ID) REFERENCES ARMOR(Armor_ID))
							  ENGINE = INNODB;
							  
CREATE TABLE ENEMY_HAS_ABILITY(Enemy_ID INT(8) UNSIGNED NOT NULL,
                               Ability_ID INT(8) UNSIGNED NOT NULL,
							   CONSTRAINT PK_E_ABILITY PRIMARY KEY (Enemy_ID, Ability_ID),
							   FOREIGN KEY (Enemy_ID) REFERENCES ENEMY(Enemy_ID),
							   FOREIGN KEY (Ability_ID) REFERENCES ABILITY(Ability_ID))
							   ENGINE = INNODB;
							   
CREATE TABLE NPC_HAS_ABILITY(NPC_ID INT(8) UNSIGNED NOT NULL,
                             Ability_ID INT(8) UNSIGNED NOT NULL,
							 CONSTRAINT PK_N_ABILITY PRIMARY KEY (NPC_ID, Ability_ID),
							 FOREIGN KEY (NPC_ID) REFERENCES NPC(NPC_ID),
							 FOREIGN KEY (Ability_ID) REFERENCES ABILITY(Ability_ID))
							 ENGINE = INNODB;
							 
CREATE TABLE ENEMY_IN_REGION(Enemy_ID INT(8) UNSIGNED NOT NULL,
							 Region_ID INT(8) UNSIGNED NOT NULL,
							 CONSTRAINT PK_E_REGION PRIMARY KEY (Enemy_ID, Region_ID),
							 FOREIGN KEY (Enemy_ID) REFERENCES ENEMY(Enemy_ID),
							 FOREIGN KEY (Region_ID) REFERENCES REGION(Region_ID))
							 ENGINE = INNODB;

CREATE TABLE NPC_IN_REGION(NPC_ID INT(8) UNSIGNED NOT NULL,
						   Region_ID INT(8) UNSIGNED NOT NULL,
						   CONSTRAINT PK_N_REGION PRIMARY KEY (NPC_ID, Region_ID),
						   FOREIGN KEY (NPC_ID) REFERENCES NPC(NPC_ID),
						   FOREIGN KEY (Region_ID) REFERENCES REGION(Region_ID))
						   ENGINE = INNODB;
					
CREATE TABLE NPC_IN_TOWN(NPC_ID INT(8) UNSIGNED NOT NULL,
						 Town_ID INT(8) UNSIGNED NOT NULL,
						 CONSTRAINT PK_N_TOWN PRIMARY KEY (NPC_ID, Town_ID),
						 FOREIGN KEY (NPC_ID) REFERENCES NPC(NPC_ID),
						 FOREIGN KEY (Town_ID) REFERENCES TOWN(Town_ID))
						 ENGINE = INNODB;
						 
CREATE TABLE CHARACTER_HAS_ABILITY(Character_Name VARCHAR(24) NOT NULL,
                                   Ability_ID INT(8) UNSIGNED NOT NULL,
								   CONSTRAINT PK_C_ABILITY PRIMARY KEY (Character_Name, Ability_ID),
							       FOREIGN KEY (Character_Name) REFERENCES PLAYER_CHARACTER(Character_Name),
							       FOREIGN KEY (Ability_ID) REFERENCES ABILITY(Ability_ID))
							       ENGINE = INNODB;

CREATE TABLE EQUIPPED_WEAPON(Weapon_ID INT(8) UNSIGNED NOT NULL,
							 Character_Name VARCHAR(24) NOT NULL,
							
							 FOREIGN KEY (Weapon_ID) REFERENCES WEAPON(Weapon_ID),
							 FOREIGN KEY (Character_Name) REFERENCES PLAYER_CHARACTER(Character_Name))
							 ENGINE = INNODB;	   
								   
CREATE TABLE EQUIPPED_ARMOR(Armor_ID INT(8) UNSIGNED NOT NULL,
							Character_Name VARCHAR(24) NOT NULL,
							
							FOREIGN KEY (Armor_ID) REFERENCES Armor(Armor_ID),
							FOREIGN KEY (Character_Name) REFERENCES PLAYER_CHARACTER(Character_Name))
							ENGINE = INNODB;								   

								   
								   
/* ##########################################################################################*/
/* ##########################################################################################*/
	/* TRIGGERS  FOR DATA ENTERY*/
/* ##########################################################################################*/
/* ##########################################################################################*/

DELIMITER //

CREATE PROCEDURE CHECK_LENGTH(IN Z VARBINARY(64), IN Y INT)
BEGIN
	IF(LENGTH(Z) != Y) THEN
		SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'BINARY TYPE NOT IN CORRECT FORMAT';
	END IF;
END//

/*ABILITY TRIGGERS*/
	CREATE TRIGGER CHECK_ABILITY_BINARY_ATT_I
	BEFORE INSERT 
	ON ABILITY
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.Effect_Remove, 8);
		CALL CHECK_LENGTH(NEW.Effect_Apply, 8);
	END//

	CREATE TRIGGER CHECK_ABILITY_BINARY_ATT_U
	BEFORE UPDATE 
	ON ABILITY
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.EFFECT_REMOVE, 8);
		CALL CHECK_LENGTH(NEW.EFFECT_APPLY, 8);
	END//
/* ######################################################## */

/*ITEM TRIGGERS*/
	CREATE TRIGGER CHECK_ITEM_BINARY_ATT_I
	BEFORE INSERT 
	ON ITEM
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.EFFECT_REMOVE, 8);
		CALL CHECK_LENGTH(NEW.HP_MP, 16);
	END//

	CREATE TRIGGER CHECK_ITEM_BINARY_ATT_U
	BEFORE UPDATE 
	ON ITEM
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.EFFECT_REMOVE, 8);
		CALL CHECK_LENGTH(NEW.HP_MP, 6);
	END//
/* ######################################################## */

/*RACE, CLASS, NPC AND ENEMY TRIGGERS*/
		CREATE TRIGGER CHECK_RACE_BINARY_ATT_I
		BEFORE INSERT 
		ON CHARACTER_RACE_DATA
		FOR EACH ROW
		BEGIN
			CALL CHECK_LENGTH(NEW.STATS, 64);
		END//
	
	CREATE TRIGGER CHECK_RACE_BINARY_ATT_U
	BEFORE UPDATE
	ON CHARACTER_RACE_DATA
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.STATS, 64);
	END//
	
		CREATE TRIGGER CHECK_CLASS_BINARY_ATT_I
		BEFORE INSERT 
		ON CHARACTER_CLASS_DATA
		FOR EACH ROW
		BEGIN
			CALL CHECK_LENGTH(NEW.STATS, 64);
		END//

	CREATE TRIGGER CHECK_CLASS_BINARY_ATT_U
	BEFORE UPDATE 
	ON CHARACTER_CLASS_DATA
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.STATS, 64);
	END//
	
		CREATE TRIGGER CHECK_NPC_BINARY_ATT_I
		BEFORE INSERT 
		ON NPC
		FOR EACH ROW
		BEGIN
			CALL CHECK_LENGTH(NEW.STATS, 64);
		END//

	CREATE TRIGGER CHECK_NPC_BINARY_ATT_U
	BEFORE UPDATE
	ON NPC
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.STATS, 64);
	END//

		CREATE TRIGGER CHECK_ENEMY_BINARY_ATT_I
		BEFORE INSERT 
		ON ENEMY
		FOR EACH ROW
		BEGIN
			CALL CHECK_LENGTH(NEW.STATS, 64);
		END//
	
	CREATE TRIGGER CHECK_ENEMY_BINARY_ATT_U
	BEFORE UPDATE 
	ON ENEMY
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.STATS, 64);
	END//
/* ######################################################## */

/*WEAPON & ARMOR TRIGGERS*/
		CREATE TRIGGER CHECK_WEAPON_BINARY_ATT_I
		BEFORE INSERT 
		ON WEAPON
		FOR EACH ROW
		BEGIN
			CALL CHECK_LENGTH(NEW.STATS_EFFECT, 8);
			CALL CHECK_LENGTH(NEW.STATS, 64);
		END//

	CREATE TRIGGER CHECK_WEAPON_BINARY_ATT_U
	BEFORE UPDATE 
	ON WEAPON
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.STATS_EFFECT, 8);
		CALL CHECK_LENGTH(NEW.STATS, 64);
	END//
	
		CREATE TRIGGER CHECK_ARMOR_BINARY_ATT_I
		BEFORE INSERT 
		ON ARMOR
		FOR EACH ROW
		BEGIN
			CALL CHECK_LENGTH(NEW.STATS_EFFECT, 8);
			CALL CHECK_LENGTH(NEW.STATS, 64);
		END//

	CREATE TRIGGER CHECK_ARMOR_BINARY_ATT_U
	BEFORE UPDATE 
	ON ARMOR
	FOR EACH ROW
	BEGIN
		CALL CHECK_LENGTH(NEW.STATS_EFFECT, 8);
		CALL CHECK_LENGTH(NEW.STATS, 64);
	END//
/* ######################################################## */
\d;

/* ##########################################################################################*/
/* ##########################################################################################*/
	/* TRIGGERS  DATA CONSISTNENCY*/
/* ##########################################################################################*/
/* ##########################################################################################*/


DELIMITER //
/*WEAPON & ARMOR EUIPPED TRIGGERS*/
		CREATE TRIGGER CHECK_ON_ARMOR_EQUIPPED
		BEFORE INSERT 
		ON EQUIPPED_ARMOR
		FOR EACH ROW
		BEGIN
			SET @CLASS_TYPE = (SELECT Class_Type
						   FROM PLAYER_CHARACTER 
						   WHERE Character_Name = NEW.Character_Name);
			SET @ARMOR_TYPE = (SELECT Armor_Material
						   FROM ARMOR 
						   WHERE Armor_ID = NEW.Armor_ID);
			
			/* CHECK IF CLASS TYPE CAN USE MATERIAL */
				/* NOT IMPLEMENTED */
				
			/* 
				FOR SIMPLFICATION OF THE PROJECT WE WILL LET
				EACH CHARACTER HAVE ONLY OF EACH ARMOR TYPE
			*/
			SET @X = (SELECT COUNT(Armor_ID) 
						FROM EQUIPPED_ARMOR
						WHERE Character_Name = NEW.Character_Name 
							AND 
							Armor_ID IN(SELECT Armor_ID
										FROM ARMOR
										WHERE Armor_Type = (SELECT Armor_Type 
															 FROM ARMOR
															 WHERE Armor_ID = NEW.Armor_ID)));

			IF(@X > 0) THEN

				SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'TOO MANY OF SAME ARMOR TYPE...';
			END IF;
			
		END//

	CREATE TRIGGER CHECK_UPDATE_ARMOR_WITH_SAME_TYPE_ONLY
	BEFORE UPDATE 
	ON EQUIPPED_ARMOR
	FOR EACH ROW
	BEGIN
		SET @OLD_TYPE =(SELECT Armor_TYPE
						FROM ARMOR 
						WHERE Armor_ID = OLD.Armor_ID);
		SET @NEW_TYPE =(SELECT Armor_TYPE
						FROM ARMOR 
						WHERE Armor_ID = NEW.Armor_ID);
					
		/* CHECK IF CLASS TYPE CAN USE MATERIAL */
				/* NOT IMPLEMENTED */
				
		IF(@OLD_TYPE != @NEW_TYPE)  THEN
			SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'ARMOR TYPE DO NOT MATCH...';
		END IF;
	END//

		CREATE TRIGGER CHECK_EQUIPPED_WEAPON_BEFORE_INSERTION
		BEFORE INSERT 
		ON EQUIPPED_WEAPON
		FOR EACH ROW
		BEGIN
			/* CHECK IF NUMBER OF WEAPONS MATCHES THE SUM OF HANDED */
				/* NOT IMPLEMENTED */
			
			/* 
				FOR SIMPLFICATION OF THE PROJECT WE WILL LET
				EACH CHARACTER HAVE ONLY ONE WEAPON
			*/
			SET @X := (SELECT COUNT(Weapon_ID)
				  FROM EQUIPPED_WEAPON
				  WHERE Character_Name = NEW.Character_Name);
			IF(@X > 0) THEN
				SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'TOO MANY WEAPONS...';
			END IF;
		END//
		
	CREATE TRIGGER CHECK_UPDATE_WEAPON_WITH_SAME_TYPE_ONLY
	BEFORE UPDATE 
	ON WEAPON
	FOR EACH ROW
	BEGIN
					
		/* CHECK IF CLASS TYPE CAN USE WEAPON TYPE */
				/* NOT IMPLEMENTED */
				
		/* CHECK IF NUMBER OF WEAPONS MATCHES THE SUM OF HANDED */
				/* NOT IMPLEMENTED */
				
		/* 
			FOR SIMPLFICATION OF THE PROJECT WE WILL LET
			EACH CHARACTER HAVE ONLY ONE WEAPON
			THAT IS IMPLEMENT IN THE BEFORE INSERT ON EQUIPPED_WEAPON
		*/
	END//
/* ######################################################## */
\d;