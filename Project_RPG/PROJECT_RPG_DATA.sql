INSERT INTO CHARACTER_CLASS_DATA(Class_Type,Stats)
VALUES
	/* STA:5 STR:3 AGI:5 DEF:4 MIN:10 INT:7 EVA:6 ACC:8  */
('Mage',		'0000010100000011000001010000010000001010000001110000011000001000'), 

	/* STA:10 STR:8 AGI:4 DEF:10 MIN:6 INT:6 EVA:6 ACC:8  */
('Paladin',		'0000101000001000000001000000101000000110000001100000011000001000'),

	/* STA:7 STR:6 AGI:6 DEF:6 MIN:7 INT:7 EVA:4 ACC:6  */
('Shaman',		'0000011100000110000001100000011000000111000001110000010000000110'),

	/* STA:6 STR:5 AGI:10 DEF:7 MIN:4 INT:4 EVA:8 ACC:10  */
('Hunter',		'0000011000000101000010100000011100000100000001000000100000001010'),

	/* STA:7 STR:6 AGI:6 DEF:6 MIN:7 INT:7 EVA:6 ACC:4  */
('Druid',		'0000011100000110000001100000011000000111000001110000011000000100'),

	/* STA:5 STR:3 AGI:5 DEF:4 MIN:7 INT:10 EVA:6 ACC:8  */
('Priest',		'0000010100000011000001010000010000000111000010100000011000001000'),

	/* STA:8 STR:10 AGI:7 DEF:8 MIN:3 INT:3 EVA:8 ACC:8  */
('Warrior',		'0000100000001010000001110000100000000011000000110000100000001000'),

	/* STA:7 STR:8 AGI:10 DEF:6 MIN:4 INT:4 EVA:10 ACC:10  */
('Rogue',		'0000011100001000000010100000011000000100000001000000101000001010');


INSERT INTO CHARACTER_RACE_DATA(Race_Type, Stats, Faction)
VALUES
	/* STA:6 STR:6 AGI:8 DEF:6 MIN:7 INT:8 EVA:7 ACC:9  */
('Elf',			'0000011000000110000010000000011000000111000010000000011100001001',	'Alliance'),

	/* STA:7 STR:7 AGI:6 DEF:7 MIN:5 INT:5 EVA:7 ACC:8  */
('Human',		'0000011100000111000001100000011100000101000001010000011100001000',	'Alliance'),

	/* STA:6 STR:6 AGI:8 DEF:6 MIN:8 INT:7 EVA:9 ACC:7  */
('Blood Elf',	'0000011000000110000010000000011000001000000001110000100100000111', 'Swarm'),

	/* STA:8 STR:8 AGI:6 DEF:8 MIN:5 INT:5 EVA:6 ACC:6  */
('Orc', 		'0000100000001000000001100000100000000101000001010000011000000110', 'Swarm'),

	/* STA:9 STR:6 AGI:5 DEF:5 MIN:6 INT:6 EVA:6 ACC:6  */
('Undead', 		'0000100100000110000001010000010100000110000001100000011000000110',	'Swarm'),

	/* STA:9 STR:7 AGI:6 DEF:8 MIN:5 INT:5 EVA:5 ACC:7  */
('Dwarf', 		'0000100100000111000001100000100000000101000001010000010100000111', 'Alliance'),

	/* STA:5 STR:5 AGI:9 DEF:6 MIN:8 INT:8 EVA:8 ACC:7  */
('Gnome', 		'0000010100000101000010010000011000001000000010000000100000000111', 'Alliance'),

	/* STA:7 STR:7 AGI:7 DEF:7 MIN:6 INT:6 EVA:8 ACC:7  */
('Troll',		'0000011100000111000001110000011100000110000001100000100000000111', 'Swarm');

INSERT INTO ELEMENT(ELEMENT)
VALUES
('Electric'),('Earth'),('Water'),('Fire'),('Wind'),('Light'),('Dark'),('Physical');

INSERT INTO ELEMENT_WEAKNESS_AND_RESISTANCES(Element, Weak_Against, Resistant_Against)
VALUES

('Fire', 		'Water', 	'Wind'),
('Wind',		'Fire',		'Earth'),
('Earth', 		'Wind', 	'Electric'),
('Electric', 	'Earth', 	'Water'),
('Water',		'Electric', 'Fire'),
('Light', 		'Dark', 	'Physical'),
('Dark', 		'Light', 	'Physical');










INSERT INTO ACCOUNT(Account_ID, Email, Password, First_Name, Last_Name) 
VALUES 
(1,		'David.hernandez@gmail.com',	'Qwerty123',			'David','Hernandez'), 
(2,		'lovestoparty@yahoo.com',		'HorsesChorses1',		'Michael','Clarkson'),
(3,		'southparkfan69@aol.com',		'EscapadesSexyBoy!',	'Jose','Gutierrez'), 
(4,		'pinkglamour44@msn.com',		'GunsFromHalo',			'Sydney','Garcia'),
(5,		'yoyohoopsmcscoops@live.com',	'Shititsjesus',			'Yanette','Zamora'),
(6,		'fastandfurious@aol.com',		'Mustang1',				'Ryan','Sharp'),
(7,		'motometal@yahoo.com',			'Tangomuch!',			'Wes','Hightower'),
(8,		'Mcloving@msn.com',				'Reloadincase14!',		'John','Wayne'),
(9,		'hereforgoodtime@gmail.com',	'Hotcheetosyum!',		'Chris','Ledoux'),
(10,	'Mahifishing@gmail.com',		'Ihaveacold4',			'Chris','Shivers'),
(11,	'fantastic4@yahoo.com',			'Doomsday32!',			'Ryan','Tapatio'),
(12,	'foshizzlemynizzle@live.com',	'Nebraskasucks1!',		'Rex','Olson'),
(13,	'baldandsexy@yahoo.com',		'Sweetmama1!',			'Richard','Smart'),
(14,	'fajitargood@msn.com',			'Horizonlight123',		'Timothy','Shepherd'),
(15,	'dollartree@yahoo.com',			'BeerandchipsA1!',		'Travis','Graves'),
(16,	'yamaha123@aol.com',			'Sendsallyhome34!',		'Matthew','Robles'),
(17,	'geauxscotty@gmail.com',		'Regulators4life!',		'Ernesto','Sanchez'),
(18,	'runforest@yahoo.com',			'Pimpmyride!!',			'Hillary','Clinton'),
(19,	'dallas@msn.com',				'TejdG54!',				'Angelica','Montes'),
(20,	'ascendkay@aol.com',			'yEllowsub!',			'Carlina','Lovingport');

INSERT INTO ACCOUNT_BILLING(Account_ID, Card_Number, Security_Code, Expiration_Month, Expiration_Year)
VALUES
(1,6235623358928462,900,11,2017),
(2,7842095295827461,900,11,2017),
(3,7824950189720573,734,06,2019),
(4,2406105989654365,212,07,2019),
(5,5920586270980765,767,02,2020),
(6,1122387676547897,788,09,2020),
(8,9834564322435678,099,12,2020),
(9,7635423456789843,124,07,2020),
(10,7654556789873246,678,03,2020),
(11,1234765223456789,989,02,2020),
(12,0980612340998765,656,01,2020),
(13,0987890954323231,768,09,2018),
(14,0981234112389090,324,12,2017),
(15,4567819904445321,656,06,2018),
(16,8877878612109043,084,03,2019),
(17,0093342657891235,234,07,2019),
(18,0987656785432212,532,11,2017),
(19,0912123569015544,897,08,2022),
(20,5543243678999909,777,09,2018);

INSERT INTO PLAYER_CHARACTER(Character_Name, Class_Type, Race_Type, Gender, Char_Level, Account_ID)
VALUES
('Flinsword','Shaman','Orc','Female',89,1),
('Gimmick','Rogue','Elf','Male',97,2),
('Gurk','Mage','Human','Female',109,3),
('Raiki','Paladin','Undead','Female',89,4),
('Nerdrage','Rogue','Elf','Female',73,5),
('Bloodfemale','Mage','Blood Elf','Female',110,1),
('Wallkillz','Warrior','Dwarf','Male',89,2),
('Efflux','Priest','Elf','Female',38,3),
('Pikachu','Rogue','Dwarf','Female',110,4),
('Cervantes','Shaman','Gnome','Female',110,5),
('Avidance','Rogue','Blood Elf','Male',110,1),
('Moonword','Warrior','Gnome','Female',23,2),
('Jaime','Priest','Orc','Male',4,3),
('Disyo','Druid','Elf','Male',110,4),
('Vot','Druid','Gnome','Female',65,5),
('Donkeymoon','Shaman','Orc','Female',11,1),
('Buubz','Rogue','Elf','Male',110,2),
('Ferrarifonefifty','Mage','Human','Female',109,3),
('Nicknitro','Hunter','Orc','Female',89,4),
('Brickbazooka','Hunter','Elf','Male',97,5),
('Guilty','Hunter','Human','Female',109,1),
('Flinsdagger','Shaman','Orc','Female',89,1),
('Wapress','Paladin','Dwarf','Male',110,2),
('Gurkgurk','Mage','Human','Male',110,4),
('Raven','Shaman','Orc','Female',67,1),
('Shohast','Rogue','Elf','Male',97,2),
('Treblehook','Mage','Human','Female',109,3),
('Panther','Paladin','Undead','Female',89,4),
('Nergotex','Rogue','Elf','Female',45,5),
('Hostilefem','Mage','Blood Elf','Female',110,6),
('Wimblerykill','Warrior','Dwarf','Male',89,7),
('Chokesmith','Priest','Elf','Female',38,8),
('Patagonia','Rogue','Dwarf','Female',56,9),
('Snailslime','Shaman','Gnome','Female',98,10),
('Romance','Rogue','Blood Elf','Male',23,11),
('Jugglesjuggle','Warrior','Gnome','Female',23,12),
('Centaur','Priest','Orc','Male',4,13),
('Zeus','Druid','Elf','Male',110,14),
('Bot','Druid','Gnome','Female',69,15),
('Ripslash','Shaman','Orc','Female',56,16),
('Boondub','Rogue','Elf','Male',87,17),
('Hailmarypass','Mage','Human','Female',111,18),
('Dynamitecash','Hunter','Orc','Female',98,19),
('Bumblebee','Hunter','Elf','Male',87,20),
('Astros','Hunter','Human','Female',89,1),
('Simpledagger','Shaman','Orc','Female',35,19),
('Wasppress','Paladin','Dwarf','Male',17,20),
('Gamaray','Mage','Human','Male',12,14);





/* ################################################################################################# */
/* ################################################################################################# */
/* Partially Updated */  
/* ################################################################################################# */
/* ################################################################################################# */
INSERT INTO ABILITY(Ability_ID,Ability_Name,Ability_Type,Power_Level,Effect_Apply,Effect_Remove,Element)
VALUES
(1, 'Sapped', 				'Physical_ATK', 	1,'10000011','10000001','Dark'),
(2, 'Tranquilize', 			'Range_ATK', 		1,'01111001','01010000','Physical'),
(3, 'Hibernate', 			'Magical_ATK', 		1,'11111100','10001010','Wind'),
(4, 'Polymorph', 			'Magical_ATK', 		2,'10011000','00010010','Electric'),
(5, 'Mesmerize', 			'Physical_ATK', 	2,'00011010','11011000','Water'),
(6, 'Rejuvenate', 			'Heal', 			2,'10110000','10011101','Wind'),
(7, 'Infuse', 				'Heal', 			3,'00010110','00001010','Electric'),
(8, 'Cure',					'Heal', 			3,'11000001','00111100','Physical'),
(9, 'Fire Blade', 			'Magical_ATK', 		4,'11000001','00111100','Fire'),
(10, 'Earthquake', 			'Magical_ATK', 		4,'01010110','10001101', 'Earth'),
(11, 'Lightning Arrow', 	'Range_ATK', 		4,'00011010','11100111','Electric'),
(12, 'Dispel', 				'Heal', 			5,'01111010','11010010','Light'),
(13, 'Cauterize', 			'Magical_ATK', 		5,'11101010','11000000','Fire'),
(14, 'Fire Blast', 			'Magical_ATK', 		5,'11111000','10011010','Fire'),
(15, 'Earth Totem', 		'Magical_ATK', 		6,'01001001','10000111','Earth'),
(16, 'Eviscerate', 			'Physical_ATK', 	6,'10110100','11100000','Electric'),
(17, 'Wyvern Firebolt', 	'Range_ATK', 		6,'00011110','10110001','Fire'),
(18, 'Caustic Infection',	'Magical_ATK', 		7,'01111001','10001110','Dark'),
(19, 'Nature Swiftness', 	'Heal', 			7,'01101001','10100011','Wind'),
(20, 'Earthstomp', 			'Physical_ATK', 	7,'00011100','11010101','Earth'),
(21, 'Light Chill', 		'Magical_ATK', 		7,'01111001','11010010','Light'),
(22, 'Ward', 				'Heal', 			8,'01010000','11011101','Physical'),
(23, 'Envenom', 			'Physical_ATK', 	8,'11100110','10011010','Dark'),
(24, 'Shiv', 				'Physical_ATK', 	8,'10101111','11100111','Water'),
(25, 'Anthracene', 			'Magical_ATK', 		8,'11100110','10110011','Wind'),
(26, 'Invocation', 			'Heal', 			9,'10110101','10100111','Earth'),
(27, 'Wolf Bite', 			'Physical_ATK', 	9,'11100111','00110101','Dark'),
(28, 'Fire Bomb', 			'Magical_ATK', 		9,'00011001','10010100','Fire'),
(29, 'Sunfire', 			'Range_ATK', 		9,'10100000','10100000','Fire'),
(30, 'Sunlight', 			'Magical_ATK', 		9,'10110111','00101110','Wind');



/* ################################################################################################# */
/* ################################################################################################# */
/* DATA  NOT UPDATED */  
/* ################################################################################################# */
/* ################################################################################################# */
INSERT INTO REGION(Region_ID, Region_Name, Region_Description) VALUES
(1, 'Stormshire', 'West Riverdale'),
(2, 'Analizm', 'East Riverdale'),
(3, 'Pinor', 'North Riverdale'),
(4, 'Riverdale', 'Centeral Riverdale'),
(5, 'Foxsin', 'South of Riverdale'),
(6, 'Villenior', 'Southwest of Riverdale'),
(7, 'Malianor', 'Southeast of Riverdale'),
(8, 'Exanplen', 'Northwest of Riverdale'),
(9, 'Flantin', 'Northeast of Riverdale');

INSERT INTO TOWN(Town_ID,Town_Name,Region_ID)
VALUES
(1,'Red Cliff',1),
(2,'Brigantine',1),
(3,'Corell',2),
(4,'Sedalia',2),
(5,'Wellersburg',3),
(6,'Eden Isle',3),
(7,'Glen Alphine',4),
(8,'Barnard',4),
(9,'Storm Lakes',5),
(10,'Sun Lakes',5),
(11,'Lake Sticknet',6),
(12,'Lingle',6),
(13,'Allyn',7),
(14,'Wolbach',7),
(15,'Bantam',8),
(16,'Bradfords',8),
(17,'Red Hook',9),
(18,'Hyporibaldo',9);

INSERT INTO ENEMY( Enemy_ID, Enemy_Name, Stats, Element)
VALUES
(1, 'Malicious Goblin', 			'1011011100101110101000001111110100011001110111110001000000101110', 'Physical'),
(2, 'Malevolent', 					'0010001001100100010000010101000111011000111011011111001101101000', 'Wind'),
(3, 'Thousand Head Serpent', 		'0111100001011101111011110111110101011001001100000110110101110010', 'Physical'),
(4, 'Carniverous Pidgeon', 			'0010110101010100100000111010101000010110000101110000100100101011', 'Dark'),
(5, 'Rabid Dog', 					'0100001101011101110101011101000001010110110000000001110001100101', 'Physical'),
(6, 'Three Headed Mountain Lion', 	'0111100011110101001111011010101000101100101101001010011111001011', 'Electric'),
(7, 'Dehydrated Hydra', 			'0000010011011000110111010111110100100110011110000100101101101001', 'Electric'),
(8, 'Flying Wyvern', 				'1010011111100110101100110111100101001001011110110111111101110101', 'Electric'),
(9, 'Blaze', 						'0110110001110011011100001000011010111010011010100110001110011110', 'Light'),
(10, 'Water Magician', 				'0011011001111010011010011001101000110010010100010100001111000001', 'Water'),
(11, 'Mind Leech', 					'1011110010000110100001111110110010000010010100100100111111111111', 'Fire'),
(12, 'Greedy Goblin', 				'1110000110101000111100011110001011010010110011011110111100111000', 'Earth'),
(13, 'Homeless Thief', 				'0110100010110000100011111110111110110101100110111010000000111010', 'Wind'),
(14, 'Paranoid Snake', 				'0000111101000001111101111110011001010010110000100011001011010110', 'Wind'),
(15, 'MalifLightnt', 				'0110101111111011110000010011110010000001000110100001011101000011', 'Dark'),
(16, 'Jorgen Mclain',			 	'1101110101101001111110110010101011011111001000110000000111110110', 'Water'),
(17, 'Debbie Laytern', 				'1010100010001111010001111111000100110000010000101011010000100110', 'Electric'),
(18, 'Lazarus', 					'0100001011100101110000000100010000110110111000001100100011110101', 'Fire'),
(19, 'Judas the Wise', 				'0110100011100101000111000001110000000001111000110011010011000110', 'Dark'),
(20, 'Payeiol', 					'0000101011000111100011111101110110011010001001100011010110111010', 'Water'),
(21, 'Qruant', 						'0010011010011101011001111010111100111001111001100010100011100111', 'Wind'),
(22, 'Yiahn', 						'1000110100111010100110011101100011110011000111110010001001011001', 'Earth'),
(23, 'Uiuqal', 						'1001101100000000001110001001101111000000110000000001111001101100', 'Fire'),
(24, 'Mew', 						'1010001110011000010001100101100110011100100101111101100001111101', 'Water'),
(25, 'Peytoe', 						'0000100110101100111110111010111010111011011001101100100010000001', 'Electric'),
(26, 'Ranger Dave', 				'1011101101111111010111101000011101011110111111000000001110000111', 'Physical'),
(27, 'Lister Paulson', 				'1100001000001010111010001010000101111111110001100010101010011110', 'Light'),
(28, 'Harold the Explorer', 		'1100010011001000110000001011100000011100110100011001010011011001', 'Water'),
(29, 'Indian Snake', 				'1010001000111000100000000011000011011100000010101000111001111100', 'Fire'),
(30, 'Pakistani Sanddigger', 		'1111000010101011100101001010000011000101101000000010100011000001', 'Earth'),
(31, 'Green Viper', 				'0000111110001100111001111111110100000010100001001000111011000111', 'Dark'),
(32, 'Blind Prophet', 				'1111100011010101011101111111000000011010101101000110111001101001', 'Earth'),
(33, 'Mac Attack', 					'0000110111010100011110010011001001010011101111100001001001111100', 'Water'),
(34, 'Wizard of the East', 			'0010000001101111101111110110010100011010111000001110101001110011', 'Fire'),
(35, 'King Tinitus', 				'0001001111000100100000011011000111000011000000100011111110110001', 'Electric');

INSERT INTO NPC (NPC_ID, NPC_Name,Stats, Element)
VALUES
(1,'Jorge Wellington', 	'1111000101001101010101101000000101101110000010100111110011111101', 'Dark'),
(2,'Deborah Fire M.', 	'0100010001001000110101100100001010001010100010011001111010001001', 'Fire'),
(3,'Ronnie the Thief', 	'1110100111110101010100000101011010101110110101111111001011101000', 'Light'),
(4,'Bulrathym', 		'0011000001111101101110111011000111100100010111111001111110001111', 'Electric'),
(5,'Stephanie Wise', 	'0011101101011110100111111110111000101111011111110111001001011001', 'Physical'),
(6,'Shauna Lorrin', 	'0011111010100111101101100010100101001110110111111010010000110111', 'Water'),
(7,'Stewart Josie', 	'0100010011001110001011010111011001001000100011010111111100110101', 'Earth'),
(8,'Tommie Mildred', 	'1010011010011011011110100110100010000100100100010001111101001010', 'Fire'),
(9,'Chrissie Gytha', 	'1001101010111001001011101001111110101111011010011001011111000000', 'Dark'),
(10,'Nigellus Darcey', 	'1011011101001011101100100110111010010010110110010001111110111101', 'Wind'),
(11,'Osmond German', 	'0001101010001101100111110000101000010010101101010001110011101010', 'Earth'),
(12,'Lesia PatrLight', 	'0101101101101000101000000000110100111100011011010110000010011110',	'Electric'),
(13,'Krystine Reba', 	'0001100111101110010110100011001111100010111000101010111110101111', 'Light'),
(14,'Ambrosine Gene', 	'1111011110000101111101010011001000111001111001110100101011001111', 'Water'),
(15,'Nicole Shevaun', 	'0000010101101101011011101100100001001011011001001110010001111111', 'Fire');















/* ################################################################################################# */
/* ################################################################################################# */
/* 				RELATIONAL DATA  NOT UPDATED */  
/* ################################################################################################# */
/* ################################################################################################# */



