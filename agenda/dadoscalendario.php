<?php
    //bloco para pegar data do get ou star a data atual
    $kargs = []; // ainda nao sei fazer

    $fuso = new DateTimeZone('America/Belem');
    $hoje = new DateTime($timezone='America/Belem');
    
    // aqui seria mo metodo get
    if (in_array('mes', $kargs) && in_array('ano', $kargs)) {
        if (checkdate(01, $kargs['mes'], $kargs['ano'])) {
            $mes = $kargs['mes'];
            $ano = $kargs['ano'];
        }//else { return data invalida}
    } else {
        $mes = $hoje->format('m');
        $ano = $hoje->format('Y');
    }

    $meses = [
        '','Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    $dataInicio = new DateTime('01-'.$mes.'-'.$ano, $timezone=$fuso);
    
    if ($mes != 12) {
        $dataFim = new DateTime('01'.'-'.($mes + 1).'-'.$ano, $timezone=$fuso);
    } else { 
        $dataFim = new DateTime(($ano + 1).'-01-01', $timezone=$fuso);
    }
    
    $dataFim->sub(new DateInterval('P1D'));

    
    // aqui conecta com banco de dados
    // agendamentos = list(Agendamento.objetos.filter(profissional=profissional, data__gte=dataInicio,
    //                              data__lt=dataFim).values_list('data', 'turno'))
    // feriados = list(Feriado.objetos.filter(data__gte=dataInicio, data__lt=dataFim).values_list('data', flat=True))
    $feriados = [];
    // diasIndisponiveis = list(
    //         DiaIndisponivel.objetos.filter(data__gte=dataInicio, data__lt=dataFim).values_list('data', flat=True))
    $diasIndisponiveis = [];
    
    $final = (int)$dataFim->format('d'); 

    $calendario = array();
    
    $contador = (int)$dataInicio->format('w');
    if ($contador != 6) {
        $semana = array_fill(0, $contador, array('dia' => '','data' => '', 'status' => 'desabilitado', 'motivo' => 'mes'));
    } else {
        $semana = [];
    }
        
    $data = $dataInicio;
    for ($i=1; $i <= $final; $i++) {
        // agendaManha = agendamentos.count((data, 'M'))
        // agendaTarde = agendamentos.count((data, 'T'))

        $agendaManha = 0;
        $agendaTarde = 0;
        $data_formatada = $data->format('d/m/Y');

        
        if ($contador == 6) {
            array_push($semana, array('dia' => $i, 'data' => $data_formatada, 'status' => 'desabilitado', 'motivo' => 'sábado'));
            array_push($calendario, $semana);
            $semana = [];
        } elseif ($contador == 0) {
            array_push($semana, array('dia' => $i, 'data' => $data_formatada, 'status' => 'desabilitado', 'motivo' => 'domingo'));
        } elseif (in_array($data, $feriados)) {
            array_push($semana, array('dia' => $i, 'data' => $data_formatada, 'status' => 'desabilitado', 'motivo' => 'feriado'));
        } elseif (in_array($data, $diasIndisponiveis)) {
            array_push($semana, array('dia' => $i, 'data' => $data_formatada, 'status' => 'desabilitado', 'motivo' => 'indisponível'));
        } elseif ($data < $hoje) {
            array_push($semana, array('dia' => $i, 'data' => $data_formatada, 'status' => 'desabilitado'));
        } else {
            array_push($semana, array('dia' => $i, 'data' => $data_formatada, 'status' => 'disponivel',
            'motivo' => array('manha' => $agendaManha, 'tarde' => $agendaTarde)));
        }

        if ($i == ($final) && $contador % 7 != 6) {
            array_push($calendario, $semana);
        }

        $data->add(new DateInterval('P1D'));
        $contador++;
        $contador %= 7;
    }
?>