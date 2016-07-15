DELIMITER ;;
  /*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER insert_agreement_validation
BEFORE INSERT
ON company_has_agreement
FOR EACH ROW
  BEGIN
    DECLARE buyer_exists integer;
    DECLARE payer_exists integer;


    SET buyer_exists := (SELECT ( (SELECT COUNT(*) FROM client WHERE child_id=new.buyer AND root_id=new.company_id)+(SELECT COUNT(*) FROM provider WHERE child_id=new.buyer AND root_id=new.company_id)) );
    SET payer_exists := (SELECT ( (SELECT COUNT(*) FROM client WHERE child_id=new.payer AND root_id=new.company_id)+(SELECT COUNT(*) FROM provider WHERE child_id=new.payer AND root_id=new.company_id)) );

    IF ( buyer_exists = 0 OR payer_exists = 0 )
    THEN
      signal sqlstate '45000' set message_text = 'Foreign Key Constraint Violated!, The agreement between companies always need a previous relationship';
    ELSEIF ( new.payer = new.buyer )
      THEN
        signal sqlstate '45001' set message_text = 'Foreign Key Constraint Violated!, The contracting parties may not be the same';
    END IF;
  END */;;
DELIMITER ;
DELIMITER ;;
  /*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER update_agreement_validation
BEFORE UPDATE
ON company_has_agreement
FOR EACH ROW
  BEGIN
    DECLARE buyer_exists integer;
    DECLARE payer_exists integer;


    SET buyer_exists := (SELECT ( (SELECT COUNT(*) FROM client WHERE child_id=new.buyer AND root_id=new.company_id)+(SELECT COUNT(*) FROM provider WHERE child_id=new.buyer AND root_id=new.company_id)) );
    SET payer_exists := (SELECT ( (SELECT COUNT(*) FROM client WHERE child_id=new.payer AND root_id=new.company_id)+(SELECT COUNT(*) FROM provider WHERE child_id=new.payer AND root_id=new.company_id)) );

    IF ( buyer_exists = 0 OR payer_exists = 0 )
    THEN
      signal sqlstate '45000' set message_text = 'Foreign Key Constraint Violated!, The agreement between companies always need a previous relationship';
    ELSEIF ( new.payer = new.buyer )
      THEN
        signal sqlstate '45001' set message_text = 'Foreign Key Constraint Violated!, The contracting parties may not be the same';
    END IF;
  END */;;
DELIMITER ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER client_auto_relation
  AFTER INSERT
  ON client
  FOR EACH ROW
  BEGIN
     IF ( new.root_id = new.child_id )
     THEN
       signal sqlstate '45002' set message_text = 'Self referencing constraint violation';
     END IF;
     IF ( select count(*) from provider p where p.root_id = new.child_id AND p.child_id = new.root_id ) = 0
    THEN
      insert into provider values(new.child_id, new.root_id);
    END IF;
 END */;;
DELIMITER ;

DELIMITER ;;
  /*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER provider_auto_relation
AFTER INSERT
ON provider
FOR EACH ROW
  BEGIN
    IF ( new.root_id = new.child_id )
    THEN
      signal sqlstate '45002' set message_text = 'Self referencing constraint violation';
    END IF;
    IF ( select count(*) from client p where p.root_id = new.child_id AND p.child_id = new.root_id ) = 0
    THEN
      insert into client values(new.child_id, new.root_id);
    END IF;
  END */;;
DELIMITER ;

DELIMITER ;;
  /*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER client_auto_relation_remove
AFTER DELETE
ON client
FOR EACH ROW
  BEGIN
    IF ( select count(*) from provider p where p.root_id = OLD.child_id AND p.child_id = OLD.root_id ) = 1
    THEN
      delete from provider where child_id = OLD.root_id and root_id = OLD.child_id;
    END IF;
  END */;;
DELIMITER ;

DELIMITER ;;
  /*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER provider_auto_relation_remove
AFTER DELETE
ON provider
FOR EACH ROW
  BEGIN
    IF ( select count(*) from client p where p.root_id = old.child_id AND p.child_id = old.root_id ) = 1
    THEN
      delete from client where child_id = OLD.root_id and root_id = OLD.child_id;
    END IF;

  END */;;
DELIMITER ;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`%` SQL SECURITY DEFINER VIEW `listado` AS select distinct `c`.`name` AS `empresa`,`cc`.`name` AS `cliente`,`cp`.`name` AS `proveedor` from (((`company` `cc` left join (`company` `c` left join `client` `cl` on((`c`.`id` = `cl`.`root_id`))) on((`cl`.`child_id` = `cc`.`id`))) left join `provider` `p` on((`p`.`root_id` = `c`.`id`))) left join `company` `cp` on((`cp`.`id` = `p`.`child_id`)));
CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`%` SQL SECURITY DEFINER VIEW `CustomList` AS select distinct `t`.`empresa` AS `empresa`,`t`.`relacion` AS `relacion`,`t`.`vinculo` AS `vinculo` from (select distinct `listado`.`empresa` AS `empresa`,`listado`.`cliente` AS `relacion`,'cliente' AS `vinculo` from `mydb`.`listado` where (`listado`.`empresa` is not null) union select distinct `listado`.`empresa` AS `empresa`,`listado`.`proveedor` AS `relacion`,'proveedor' AS `vinculo` from `mydb`.`listado` where (`listado`.`empresa` is not null)) `t`;

#select c.name as empresa, GROUP_CONCAT(DISTINCT cc.name) as cliente, GROUP_CONCAT(DISTINCT cp.name) as proveedor from company c LEFT JOIN client cl ON c.id = cl.root_id LEFT JOIN company cc ON cl.child_id = cc.id LEFT JOIN provider p ON p.root_id = c.id LEFT JOIN company cp ON cp.id = p.child_id group by c.id;

#select c.name as empresa, GROUP_CONCAT(DISTINCT cc.id) as cliente, GROUP_CONCAT(DISTINCT cp.id) as proveedor from company c LEFT JOIN client cl ON c.id = cl.root_id LEFT JOIN company cc ON cl.child_id = cc.id LEFT JOIN provider p ON p.root_id = c.id LEFT JOIN company cp ON cp.id = p.child_id group by c.id;