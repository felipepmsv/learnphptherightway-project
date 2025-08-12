-- Script: popular_tickets.sql
-- Objetivo: Criar procedure para popular tabela 'tickets' em lotes
-- Autor: ChatGPT
-- Data: 2025-08-12


DELIMITER $$

CREATE PROCEDURE popular_tickets(IN total_registros INT)
BEGIN
    DECLARE lote INT DEFAULT 100000; -- tamanho de cada inserção
    DECLARE executado INT DEFAULT 0;

    -- Limpar a tabela e resetar AUTO_INCREMENT
    TRUNCATE TABLE tickets;

    -- Resetar contador para títulos/conteúdos
    SET @row := 0;

    -- Loop para inserir os registros em blocos
    WHILE executado < total_registros DO
        
        INSERT INTO tickets (title, content, user_id, template_id, created_at, updated_at)
        SELECT 
            CONCAT('Título ', @row := @row + 1) AS title,
            CONCAT('Conteúdo de teste número ', @row) AS content,
            FLOOR(1 + RAND() * 100) AS user_id,     -- aleatório 1 a 100
            FLOOR(1 + RAND() * 10) AS template_id,  -- aleatório 1 a 10
            NOW(),
            NOW()
        FROM 
            (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
             UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t1,
            (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
             UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t2,
            (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
             UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t3,
            (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
             UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t4,
            (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
             UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t5
        LIMIT lote;

        SET executado = executado + lote;
    END WHILE;
END$$

DELIMITER ;

CALL popular_tickets(1000000);
