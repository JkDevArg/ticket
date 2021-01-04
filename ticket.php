<?php
/*******************************************************************************
* Script Ticket                                                                *
*                                                                              *
* Version: 1.1.0                                                               *
* Date:    2021-01-03                                                          *
* Author:  JkDev                                                               *
*******************************************************************************/
include "fpdf/fpdf.php";

$pdf = new FPDF($orientation='P',$unit='mm', array(45,350));
$pdf->AddPage();
$pdf->SetFont('Courier','B',8);    //Letra Arial, negrita (Bold), tam. 20
$textypos = 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Cell(5,$textypos,"Nombre de tu empresa");
$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 20
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'-------------------------------------------------------------------');
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'CANT.  ARTICULO       PRECIO               TOTAL');

$total =0;
$off = $textypos+6;
/* Aqui se coloca los productos, cantidad y precio.*/
$producto = array(
	"q"=>1,
	"name"=>"Computadora I7 9na Gen",
	"price"=>1100
);
$producto2 = array(
    "q"=>1,
    "name"=>"Motherboard Asus",
    "price"=>760
);
$producto3 = array(
    "q"=>2,
    "name"=>"RAM 8GB",
    "price"=>1050
);
$productos = array($producto, $producto2, $producto3 );
foreach($productos as $pro){
$pdf->setX(2);
$pdf->Cell(5,$off,$pro["q"]);
$pdf->setX(6);
$pdf->Cell(35,$off,  strtoupper(substr($pro["name"], 0,12)) );
$pdf->setX(20);
$pdf->Cell(11,$off,  "$".number_format($pro["price"],2,".",",") ,0,0,"R");
$pdf->setX(32);
$pdf->Cell(11,$off,  "$ ".number_format($pro["q"]*$pro["price"],2,".",",") ,0,0,"R");

$total += $pro["q"]*$pro["price"];
$off+=6;
}
$textypos=$off+6;

$pdf->setX(2);
$pdf->Cell(5,$textypos,"TOTAL: " );
$pdf->setX(38);
$pdf->Cell(5,$textypos,"$ ".number_format($total,2,".",","),0,0,"R");

$pdf->setX(2);
$pdf->Cell(5,$textypos+6,'GRACIAS POR TU COMPRA ');
$textypos+=3;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'-------------------------------------------------------------------');

$pdf->output();
