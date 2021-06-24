insert into cad_paciente (id_paciente,
                          cpf_paciente,
                          nm_paciente,
                          nr_telefone)
                   values(id_paciente_seq.nextval,
                          cpf_paciente_w,
                          nm_paciente_w,
                          nr_telefone_w);
							  
insert into cad_medico (id_medico,
						nm_medico,
                        crm_medico,
                        ds_area,
                        nr_telefone)
                 values(id_medico_seq.nextval,
                        nm_medico_w,
                        crm_medico_w,
                        ds_area_w,
                        nr_telefone_w);
	
select a.NR_PRONTUARIO "Prontuário", a.nm_pac_agenda "Nome do paciente", a.dt_consulta "Data da consulta", a.ds_consulta "Consulta", a.nm_med_agenda "Nome do médico"
from cad_agenda a,
     cad_paciente b
where b.nr_prontuario = a.nr_prontuario;
