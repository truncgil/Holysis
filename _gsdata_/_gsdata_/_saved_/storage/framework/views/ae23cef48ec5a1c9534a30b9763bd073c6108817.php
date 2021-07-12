<div class="table-responsive">
<table class="table table-bordered table-hover table-striped">
			<?php $veri = db("sap-planning")->orderBY("id","DESC")->first();
$sap = array();
	$j = j($veri->json);
foreach($j['row'] AS $v) {
	

	$sap[$v['ID']] = $v;
}
$veri = $sap[get("id")];

			?>
			
<?php 
/*
(
    [ID] => 20524681893
    [Color] => hsla(1,50%,58%,0.3)
    [?Serial No.] => 2173
    [Sequenz] => 0
    [Verkaufsbeleg] => 520002312
    [Position] => 0
    [Name] => Novaref S.P.A.
    [MatBereitstell] => 20.07.2016
    [Materialnummer] => 8100052964
    [Text] => 1G4 OFL168 \ 1G4 OFL168
    [Auftrag] => 1,1E+11
    [MRP Contr.] => PR
    [Arbeitsplatz] => P-SI-V9
    [Gewicht/1 ST [KG]] => 2,567
    [Bedarfsmenge SD] => 200
    [Auftrag menge [TO]] => 0,544
    [Gedrückt] => 0
    [Gedrückt [TO]] => 0
    [Rest Presse] => 212
    [Rest Presse [TO]] => 0,544
    [Oven/Furnace] => MTO
    [Temprature] => 1720.00
    [Prelim. Stage] => 
    [MatVent.] => 1.00
    [Modellnummer] => M.-4365
    [] => OFL168-9.66911.001-S
    [Quality] => 900516
    [Quality-Version] => H001
    [YSOR vers.
] => '@5F@
)
*/
$alan = explode("\n","Prozessauftragsnr.
Kundenauftragsnr.
Position Laufnumer
Materialnummer
Matrialkurztext
Prozessauftragsstuckzahl
Kundenauftragsstuckzahl
Quality
Sorte
Temprature
Ofen
Modellnummer
Arbeitsplatz
Bedarfsmenge SD
Versatznummer"); ?>
<?php foreach($alan AS $a) { $a = trim($a);?>
<tr><td><?php echo e($a); ?></td><td><?php echo e(@$veri[$a]); ?></td></tr>
<?php } ?>
</table>

</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/planning-tooltip.blade.php ENDPATH**/ ?>