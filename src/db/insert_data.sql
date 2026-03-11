insert into AULA (numeroAula, capienza) values
('2.12', 315),
('3.4', 150),
('2.1', 160),
('2.3', 100),
('2.4', 100),
('2.5', 99),
('2.6', 100),
('2.7', 89),
('2.8', 89),
('2.9', 210),
('2.10', 72),
('2.11', 36),
('2.13', 92),
('3.7', 187),
('3.10', 84),
('3.11', 79),
('4.1', 72);

insert into ESAME (codiceIns, codiceEsame, oraInizio, durata, data, numeroLab, numeroAula) values
(, '11', '10:00:00', 120, '2026-01-10', null, '2.12'),
(, '12', '11:00:00', 120, '2026-01-29', null, '2.12'),
(, '13', '10:30:00', 120, '2026-02-12', null, '2.12'),
(, '21', '13:00:00', 90, '2026-01-12', null, '2.1'),
(, '22', '11:00:00', 90, '2026-01-26', null, '2.3'),
(, '23', '14:30:00', 90, '2026-02-13', null, '2.4'),
(, '31', '9:00:00', 100, '2026-01-18', null, '2.5'),
(, '32', '9:30:00', 100, '2026-02-04', null, '2.9'),
(, '41', '13:30:00', 90, '2026-01-15', null, '2.11'),
(, '42', '14:00:00', 90, '2026-02-1', null, '3.4'),
(, '51', '15:00:00', 120, '2025-12-22', null, '4.1'),
(, '52', '10:00:00', 120, '2026-01-22', null, '2.12'),
(, '61', '9:00:00', 120, '2026-01-11', null, '2.8'),
(, '62', '10:30:00', 120, '2026-02-03', null, '2.6');

insert into EVENTO (titolo, data, oraInizio, durata, numeroLab, numeroAula, locandina) values
('GAME AS A LAB', '2026-11-27', '17:00:00', 120, '2.2', null, 'asALAB.jpeg'),
('QUANTUM ENGINEERING', '2026-11-19', '17:00:00', 90, '2.3', null, 'Quantum.jpeg'),
('FUTURO NELL\'ICT', '2026-11-27', '17:00:00', 120, '2.13', null, 'futuroICT.jpeg');

INSERT INTO LABORATORIO(numeroLab,capienza) VALUES
('2.2', 98), ('3.1', 42), ('3.3',49), ('4.2', 79), ('CARTA', 2), ('LaMo', 30), ('LaMoV',17), ('LaRAC', 2),
('LAFO', 16), ('OFF', 30), ('LIB(I)', 50), ('LIB(M)', 40);
INSERT INTO LAUREA(codiceLaurea, oraInizio, durata, corso, data, numeroAula)
VALUES 

    (1, '09:00:00', 420, 'Ingegneria e Scienze Informatiche', '2026-07-22', '3.4'),
    (2, '09:00:00', 420, 'Ingegneria Biomedica', '2026-07-24', '2.1'),
    (3, '09:00:00', 420, 'Architettura', '2026-07-27', '2.15'),
    (4, '09:00:00', 420, 'Ingegneria e Scienze Informatiche', '2026-07-29', '2.12'),
    (5, '09:00:00', 420, 'Ingegneria Biomedica', '2026-09-10', '3.4'),
    (6, '09:00:00', 420, 'Architettura', '2026-09-15', '2.15'),
    (7, '09:00:00', 420, 'Ingegneria e Scienze Informatiche', '2026-09-22', '3.4'),
    (8, '09:00:00', 420, 'Ingegneria Biomedica', '2026-09-28', '2.1'),
    (9, '09:00:00', 420, 'Architettura', '2026-10-06', '2.15'),
    (10, '09:00:00', 420, 'Ingegneria e Scienze Informatiche', '2026-10-13', '2.12'),
    (11, '09:00:00', 420, 'Ingegneria Biomedica', '2026-10-20', '3.4'),
    (12, '09:00:00', 420, 'Architettura', '2026-10-27', '2.15'),
    (13, '09:00:00', 420, 'Ingegneria e Scienze Informatiche', '2026-11-05', '3.4'),
    (14, '09:00:00', 420, 'Ingegneria Biomedica', '2026-11-12', '2.1'),
    (15, '09:00:00', 420, 'Architettura', '2026-11-19', '2.15'),
    (16, '09:00:00', 420, 'Ingegneria e Scienze Informatiche', '2026-11-26', '2.12'),
    (17, '09:00:00', 420, 'Ingegneria Biomedica', '2026-12-03', '3.4'),
    (18, '09:00:00', 420, 'Architettura', '2026-12-10', '2.15'),
    (19, '09:00:00', 420, 'Ingegneria e Scienze Informatiche', '2026-12-15', '3.4'),
    (20, '09:00:00', 420, 'Ingegneria Biomedica', '2026-12-18', '2.1');