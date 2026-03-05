-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Thu Mar  5 11:49:17 2026 
-- * LUN file: C:\Users\ricca\OneDrive\Desktop\ProjectWeb.lun 
-- * Schema: Alma_aule_REL/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database Alma_aule_REL;
use Alma_aule_REL;


-- Tables Section
-- _____________ 

create table AULA (
     numeroAula char(1) not null,
     capienza char(1) not null,
     constraint ID_AULA_ID primary key (numeroAula));

create table ESAME (
     codiceIns char(1) not null,
     codiceEsame char(1) not null,
     oraInizio char(1) not null,
     durata char(1) not null,
     data char(1) not null,
     numeroLab char(1),
     numeroAula char(1),
     constraint ID_ESAME_ID primary key (codiceIns, codiceEsame));

create table EVENTO (
     titolo char(1) not null,
     data char(1) not null,
     oraInizio char(1) not null,
     durata char(1) not null,
     numeroLab char(1),
     numeroAula char(1),
     constraint ID_EVENTO_ID primary key (titolo));

create table LABORATORIO (
     numeroLab char(1) not null,
     capienza char(1) not null,
     constraint ID_LABORATORIO_ID primary key (numeroLab));

create table LAUREA (
     codiceLaurea char(1) not null,
     oraInizio char(1) not null,
     durata char(1) not null,
     corso char(1) not null,
     data char(1) not null,
     numeroAula char(1) not null,
     constraint ID_LAUREA_ID primary key (codiceLaurea));

create table LEZIONE (
     codiceIns char(1) not null,
     codiceLez char(1) not null,
     oraInizio char(1) not null,
     durata char(1) not null,
     data char(1) not null,
     numeroLab char(1),
     numeroAula char(1),
     constraint ID_LEZIONE_ID primary key (codiceIns, codiceLez));

create table INSEGNAMENTO (
     codiceIns char(1) not null,
     professore char(1) not null,
     constraint ID_INSEGNAMENTO_ID primary key (codiceIns));

create table POLIVALENTE (
     nome char(1) not null,
     postiTotali char(1) not null,
     postiDisponibili char(1) not null,
     computerTotali char(1) not null,
     computerDisponibili char(1) not null,
     constraint ID_POLIVALENTE_ID primary key (nome));

create table PRENOTAZIONE (
     codicePre char(1) not null,
     nominativo char(1) not null,
     data char(1) not null,
     oraInizio char(1) not null,
     durata char(1) not null,
     motivazione char(1) not null,
     numeroLab char(1),
     numeroAula char(1),
     constraint ID_PRENOTAZIONE_ID primary key (codicePre));


-- Constraints Section
-- ___________________ 

alter table ESAME add constraint FKRIFERIMENTO
     foreign key (codiceIns)
     references INSEGNAMENTO (codiceIns);

alter table ESAME add constraint FKOCCUPAZIONE_L_ES_FK
     foreign key (numeroLab)
     references LABORATORIO (numeroLab);

alter table ESAME add constraint FKOCCUPAZIONE_A_ES_FK
     foreign key (numeroAula)
     references AULA (numeroAula);

alter table EVENTO add constraint FKOCCUPAZIONE_L_EV_FK
     foreign key (numeroLab)
     references LABORATORIO (numeroLab);

alter table EVENTO add constraint FKOCCUPAZIONE_A_EV_FK
     foreign key (numeroAula)
     references AULA (numeroAula);

alter table LAUREA add constraint FKOCCUPAZIONE_A_LAUREA_FK
     foreign key (numeroAula)
     references AULA (numeroAula);

alter table LEZIONE add constraint FKSVOLGIMENTO
     foreign key (codiceIns)
     references INSEGNAMENTO (codiceIns);

alter table LEZIONE add constraint FKOCUPAZIONE_L_LEZ_FK
     foreign key (numeroLab)
     references LABORATORIO (numeroLab);

alter table LEZIONE add constraint FKOCCUPAZIONE_A_LEZ_FK
     foreign key (numeroAula)
     references AULA (numeroAula);

alter table PRENOTAZIONE add constraint FKPRENOTAZIONE_L_FK
     foreign key (numeroLab)
     references LABORATORIO (numeroLab);

alter table PRENOTAZIONE add constraint FKPRENOTAZIONE_A_FK
     foreign key (numeroAula)
     references AULA (numeroAula);


-- Index Section
-- _____________ 

create unique index ID_AULA_IND
     on AULA (numeroAula);

create unique index ID_ESAME_IND
     on ESAME (codiceIns, codiceEsame);

create index FKOCCUPAZIONE_L_ES_IND
     on ESAME (numeroLab);

create index FKOCCUPAZIONE_A_ES_IND
     on ESAME (numeroAula);

create unique index ID_EVENTO_IND
     on EVENTO (titolo);

create index FKOCCUPAZIONE_L_EV_IND
     on EVENTO (numeroLab);

create index FKOCCUPAZIONE_A_EV_IND
     on EVENTO (numeroAula);

create unique index ID_LABORATORIO_IND
     on LABORATORIO (numeroLab);

create unique index ID_LAUREA_IND
     on LAUREA (codiceLaurea);

create index FKOCCUPAZIONE_A_LAUREA_IND
     on LAUREA (numeroAula);

create unique index ID_LEZIONE_IND
     on LEZIONE (codiceIns, codiceLez);

create index FKOCUPAZIONE_L_LEZ_IND
     on LEZIONE (numeroLab);

create index FKOCCUPAZIONE_A_LEZ_IND
     on LEZIONE (numeroAula);

create unique index ID_INSEGNAMENTO_IND
     on INSEGNAMENTO (codiceIns);

create unique index ID_POLIVALENTE_IND
     on POLIVALENTE (nome);

create unique index ID_PRENOTAZIONE_IND
     on PRENOTAZIONE (codicePre);

create index FKPRENOTAZIONE_L_IND
     on PRENOTAZIONE (numeroLab);

create index FKPRENOTAZIONE_A_IND
     on PRENOTAZIONE (numeroAula);

