ALTER TABLE CAD_CONSULTA ADD CONSTRAINT consulta_paciente_fk foreign key (nr_prontuario)
references cad_paciente(id_paciente);

ALTER TABLE CAD_CONSULTA ADD CONSTRAINT consulta_medico_fk foreign key (seq_medico_cons)
references cad_medico(id_medico);

ALTER TABLE CAD_AGENDA ADD CONSTRAINT AGENDA_CONSULTA_FK foreign key (NR_SEQ_AGENDA)
references cad_CONSULTA(nr_seq_consulta);
