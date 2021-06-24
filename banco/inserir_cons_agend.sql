create or replace procedure inserir_cons_agend( nr_prontuario_p		cad_consulta.nr_prontuario%type,
                                                dt_consulta_p		cad_consulta.dt_consulta%type,
                                                ds_consulta_p		cad_consulta.ds_consulta%type,
                                                seq_medico_cons_p   cad_consulta.seq_medico_cons%type) is
                                                
nm_paciente_w 		cad_paciente.nm_paciente%type;
nm_medico_w			cad_medico.nm_medico%type;
nr_seq_agenda_w		cad_agenda.nr_seq_agenda%type;
id_paciente_w       cad_paciente.id_paciente%type;

begin									   

	if(nr_prontuario_p is not null) and (seq_medico_cons_p is not null)then 								   
		select nvl(a.id_paciente,1), a.nm_paciente, b.nm_medico 
        into id_paciente_w,
             nm_paciente_w,   
             nm_medico_w
        from cad_paciente a, 
             cad_medico b
		where a.id_paciente = nr_prontuario_p
		and b.id_medico = seq_medico_cons_p;

		insert into cad_consulta(nr_seq_consulta,
                                 nr_prontuario,
                                 nm_pac_consulta,
                                 nm_med_consulta,
                                 dt_consulta,
								 ds_consulta,
                                 seq_medico_cons)
                          values(nr_seq_consulta_seq.nextval,
                                 nr_prontuario_p,
                                 nm_paciente_w,
								 nm_medico_w,
								 dt_consulta_p,
								 ds_consulta_p,
                                 seq_medico_cons_p);
        select max(nvl(a.nr_seq_agenda,1))
        into nr_seq_agenda_w
        from cad_agenda a,
             cad_consulta b
		where nvl(a.nr_seq_agenda,1) = b.nr_seq_consulta;		
        
			insert into cad_agenda( nr_seq_agenda,
                                    nr_prontuario,
                                    dt_consulta,
                                    nm_pac_agenda,
                                    nm_med_agenda,
                                    ds_consulta)
                             values(nr_seq_agenda_seq.nextval,
                                    nr_prontuario_p,
                                    dt_consulta_p,
                                    nm_paciente_w,
                                    nm_medico_w,
                                    ds_consulta_p);				  		
	end if;	
end inserir_cons_agend;
