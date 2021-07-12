<?php use App\Contents; 
$title = "Cihaz Bilgisi";
$description = "";
$keywords = "";

?>

@extends('layouts.app')

@section("title",$title)
@section("description",$description)
@section("keywords",$keywords)


@section('content')
<div data-name="cihaz-bilgisi" class="page">
<?php navbar($title) ?>

          <!-- Bottom Toolbar -->
          <div class="toolbar toolbar-bottom">
            <div class="toolbar-inner">
              <!-- Toolbar links -->
              <a href="profile" class="external link"><i class="f7-icons">person_crop_circle_fill</i></a>
              <a href="{{url("cihaz-bilgisi")}}" class="external link"><i class="f7-icons">info_circle_fill</i></a>
            </div>
          </div>

          <!-- Scrollable page content -->
          <div class="page-content">
            <div class="block text-align-center">
              <?php center_logo(); ?>
              <?php $cihaz = db("cihazlar")->where("uid",oturum("uid"))->first();
               
                ?>
          
            </div>
          
      <div class="list">
        <ul>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">wifi</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Cihaz Kimliği</div>
                  {{$cihaz->mac}}
                  <div class="item-footer">Cihazın aynı zamanda fiziksel makine adresidir</div>
                </div>
             
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">globe</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">IP Adresi</div>
                  {{$cihaz->ip}}
                  <div class="item-footer">Veri gönderilen mobil aygıtın bağlı olduğu internet adresidir.</div>

                </div>
                
              </div>
            </a>
          </li>
          
<?php $son = db("pulse_data")->where("mac",$cihaz->mac)->orderBy("id","DESC")->first() ?>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">location</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Son Lokasyon Bilgisi</div>
                 {{$son->lat}}, {{$son->lng}}
                  <div class="item-footer">Cihazın sinyal gönderdiği GPS bilgisidir</div>
                </div>
               
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">battery_100</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Kalan Güç</div>
                 %{{$son->battery}} 
                  <div class="item-footer">Cihazın pilinin ne kadar kaldığını gösterir</div>
                </div>
               
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">calendar</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Son Veri Gönderme Tarihi</div>
           
                 {{df($son->date,"d.m.Y H:i")}}
                  <div class="item-footer">Cihazın sisteme son veri gönderme tarihidir</div>
                </div>
               
              </div>
            </a>
          </li>
        </ul>
      </div>


               
      </div>
 
          </div>


@endsection

