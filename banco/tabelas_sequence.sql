create table cad_paciente(
	id_paciente int not null,
    cpf_paciente int not null,
    nm_paciente varchar(50),
    nr_telefone int,
    primary key (id_paciente));
	
CREATE SEQUENCE id_paciente_seq
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 20;
  
create table cad_medico(
	id_medico int not null,
    nm_medico varchar(50),
    crm_medico int,
    ds_area varchar(50),
    nr_telefone int,
    primary key (id_medico));
	
CREATE SEQUENCE id_medico_seq
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 20; 
	
create table cad_consulta(
	nr_seq_consulta int not null,
	nr_prontuario int not null,
	seq_medico_cons int not null,
    nm_pac_consulta varchar(100),
    nm_med_consulta varchar(100),
    dt_consulta date,
    ds_consulta varchar(100),
    primary key (nr_seq_consulta));

CREATE SEQUENCE nr_seq_consulta_seq
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 20; 	
	
create table cad_agenda(
	nr_seq_agenda int not null,
	nr_prontuario int not null,
    dt_consulta date,
    nm_pac_agenda varchar(50),
    nm_med_agenda varchar(50),
    ds_consulta varchar(100),
    primary key (nr_seq_agenda));

CREATE SEQUENCE nr_seq_agenda_seq
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 20;
  