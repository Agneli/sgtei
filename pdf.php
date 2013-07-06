<?php

$ra = $_GET['ra'];
require_once 'classes/database.php';
require_once 'classes/peoples.php';
require_once 'classes/contracts.php';
require_once 'classes/students.php';
require_once 'classes/routes.php';
require_once 'classes/vehicles.php';
require_once 'classes/values.php';


$students = new Students();
$students->setRa($ra);
$stu = $students->select($students);

foreach ($stu as $student) {
    $r = $student->getRa();
    $name = $student->getName();
    $email = $student->getEmail();
    $phone = $student->getPhone();
    $cel = $student->getCel();
}

//Selecionando o Contrato
$contracts = new Contracts();
$contracts->setStu($r);
$con = $contracts->select($contracts);

foreach ($con as $contract) {
    $val = $contract->getVal();
    $ve = $contract->getVeh();
    $ro = $contract->getRou();
}

//Selecionando veículo
$vehicles = new Vehicles();
$vehicles->setId($ve);
$veh = $vehicles->select($vehicles);

foreach ($veh as $vehicle) {
    $plate = $vehicle->getPlate();
}

////Selecionando rota
$routes = new Routes();
$routes->setId($ro);
$rou = $routes->select($routes);

foreach ($rou as $route) {
    $ori = $route->getOri();
    $dest = $route->getDest();
    $dis = $route->getDis();
    $time = $route->getTime();
}

////Selecionando valor
$values = new Values();
$values->setId($ro);
$val = $values->select($values);

foreach ($val as $value) {
    $desc = $value->getDesc();
    $v = $value->getVal();
}

//Iniciando a criação do PDF
require_once("fpdf/fpdf.php");
$pdf = new FPDF('P');
$pdf->Open();
$pdf->SetFont('arial', '', 10);
$pdf->SetY("-2");

//::::::::::::::::::Cabecalho:::::::::::::::::::://
//$pdf->Cell(0, 5, $student->getName(), 0, 0, 'L');
//$pdf->Cell(0, 5, 'Sistema Gerenciador de Transporte Escolar Intermunicipal - SGTEI', 0, 1, 'R');
//$pdf->Cell(0, 0, '', 1, 1, 'L');
//
//$pdf->Ln(5);

//::::::::::::::::::CONTRATO DE PRESTAÇÃO DE SERVIÇOS:::::::::::::::::::://
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('arial', 'B', 12);
$pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'CONTRATO DE PRESTAÇÃO DE SERVIÇOS'), 0, 0, 'C');

$pdf->Ln(5);

//::::::::::::::::::Texto:::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'CONTRATADA: NOME DA EMPRESA, pessoa jurídica de direito privado, devidamente inscrita no CNPJ nº 00.000.000/0000-00, estabelecida á rua Nome da rua nº 000 - Centro de Presidente Venceslau - SP'), 0, 1, 'L');
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'CONTRATANTE: ' . $name . ' portador(a) do RA nº ') . $r . '.
Email: '.$email.', celular: ' . $cel . ', telefone: ' . $phone . '', 0, 1, 'L');

$pdf->Ln(2);

$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'CONTRATANTE E CONTRATADA, representada neste ato por seu representante legal no final assinado, tem entre sim, certo e ajustado o que mútua e reciprocamente se obrigam a comprir o seguinte:'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   1   :::::::::::::::::::://
$pdf->Cell(0, 5, '01) Objeto do Transporte:', 0, 1, 'L');

$pdf->SetFont('arial', '', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'Serviço de transporte, compreendendo o intinerario entre ' . $ori . ' -> ' . $dest . ' e ' . $dest . ' -> ' . $ori . '.
Rota com distância estimada em aproximadamente ' . $dis . ' Km e duração de aproximadamente ' . $time . '.'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   2   :::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->Cell(0, 5, '02) Meio de Transporte:', 0, 1, 'L');

$pdf->SetFont('arial', '', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'Ônibus convêncional, devidamente habilitado para o serviço com as devidas apólices de seguro vigentes para o exercício.
Placa do ônibus reservado á esta rota: ' . $plate . '.
O ônibus estipulado poderá ser substituído por outro de iguais características em caso de extrema necessidade.'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   3   :::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->Cell(0, 5, '03) Valores:', 0, 1, 'L');

$pdf->SetFont('arial', '', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'Fica ajustado o valor de R$ ' . $v . ' referente ao transporte realizado durante um mês a ser pago mensalmente, com o primeiro vencimento em 10/02/' . date("Y") . ' e os demais consecutivos.
No mês de Julho (férias escolares), não havendo viagens não será cobrada a mensalidade.
Nos demais meses o transporte será efetuado normalmente, sendo devida mensalidade integral independente da utilização dos serviços.
Parágrafo 1º: O valor ora estipulado poderá ser reajustado em comum acordo entre as partes.
Parágrafo 2º: Caso ocorra alteração na rota estipulada na cláusula 1ª, ainda que eventual, haverá alteração do valor ajustado na proporção da quilometragem adicional.'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   4   :::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1', '04) Condições de Pagamento:'), 0, 1, 'L');

$pdf->SetFont('arial', '', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'O pagamento deverá ser efetuado até o dia 10 de cada mês.
Fica estipulada a multa de mora de 5% sobre o valor da mensalidade e juros de 1% ao mês.
O não pagamento do valor faculta a CONTRATADA a suspensão do transporte do CONTRATANTE, bem como a inclusão do débito junto aos orgão de proteção ao crédito mediante prévia notificação. A suspensão do transporte não exime o CONTRATANTE do pagamento dos valores devidos acrescidos de multa moratória e juros de 1% ao mês.'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   5   :::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1', '05) Obrigações da CONTRATADA:'), 0, 1, 'L');

$pdf->SetFont('arial', '', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'Realizar o transporte regularmente, cumprir os horários a serem pré-determinados, manter o veículo em condições compatíveis de segurança e conforto.
Em caso de pane que interrompa o prosseguimento do transporte, a CONTRATADA efetuará a substituição do ônibus dentro de prazo razoável com limite máximo de 04 (quatro) horas.'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   6   :::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1', '06) Obrigações do CONTRATANTE:'), 0, 1, 'L');

$pdf->SetFont('arial', '', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'O CONTRATANTE obriga-se a efetuar o pagamento dos valores ora estipulados em dia, sujeitar-se ás normas estabelecidas pela CONTRATADA, abstendo-se de quaisquer atos que causem incomodo ou prejuizo aos demais passageiros, danifiquem o veículo ou dificultem ou impeçam a execução normal dos serviços.
O não cumprimento desta cláusula, faculta a CONTRATADA mediante prévia notificação, a recisão contratual com a cobrança de multa estipulada na cláusula 7, uma vez que a recisão será motivada por infração contratual do CONTRATANTE.
É obrigatória a apresentação da carteirinha fornecida pela CONTRATADA para utilização dos serviços.'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   7   :::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1', '07) Rescisão Contratual:'), 0, 1, 'L');

$pdf->SetFont('arial', '', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'Em caso de rescisão contratual, caberá a parte que rescindir o presente instrumento uma multa rescisória no valor de 02 (duas) mensalidades: R$ ' . ($v * 2) . '
E por se acharem assim, justas e contratadas, assinam o presente instrumento em 02 (duas) vias de igual teor, perante 02 (duas) testemunhas a tudo presentes.'), 0, 1, 'L');
$pdf->Ln(1);

//::::::::::::::::::   Duração   :::::::::::::::::::://
$pdf->SetFont('arial', 'B', 9);
$pdf->MultiCell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'Início do contrato: 01/02/' . date("Y") . ' - Término do contrato: 15/12/' . date("Y") . ''), 0, 1, 'C');
$pdf->Ln(4);

//::::::::::::::::::   Assinaturas   :::::::::::::::::::://
$pdf->MultiCell(0, 5, 'Assinatura do CONTRATANTE:                                                         Assinatura da CONTRATADA:', 0, 1, 'L');
$pdf->Cell(0, 0, '', 1, 1, 'L');

utf8_decode($pdf);

$pdf->Output('contracts/' . $ra . '.pdf');
header('Location: contracts/' . $ra . '.pdf');
?>