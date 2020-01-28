-- Comandos mysqli
CREATE TABLE `tabeliao`.`alunos_log` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `usuario` VARCHAR(255) NOT NULL , `aluno_id` INT(11) NOT NULL ,
`acao` VARCHAR(255) NOT NULL , `acao_resumo` VARCHAR(255) NOT NULL , `data` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `alunos_log` ADD FOREIGN KEY (`aluno_id`) REFERENCES `alunos`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- //
ALTER TABLE `servidores` ADD `pos_graduacao` VARCHAR(255) NOT NULL AFTER `formado_em`, ADD `pos_graduacao_completo` VARCHAR(255) NOT NULL AFTER `pos_graduacao`, ADD `pos_graduacao_onde` VARCHAR(255) NOT NULL AFTER `pos_graduacao_completo`; 
-- //
ALTER TABLE `servidores` ADD `dependente` VARCHAR(255) NOT NULL AFTER `titulo_uf`; 
-- //
ALTER TABLE `alunos_log` CHANGE `acao` `acao` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 
-- //
ALTER TABLE `alunos_pagamentos` ADD `desconto` VARCHAR(255) NOT NULL AFTER `mensalidade`, ADD `multa` VARCHAR(255) NOT NULL AFTER `desconto`; 
-- //
ALTER TABLE `alunos_pagamentos` CHANGE `created` `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP; 