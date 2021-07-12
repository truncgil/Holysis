<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
            <?php $sorgu = db("ogrenciler")
            ->whereIn("uid",u()->alias_ids)
            ->orderBy("id","DESC")
            ->get();
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Adı Soyadı</th>
                        <th>T.C. Kimlik No</th>
                        <th>Sınıf</th>
                        <th>Şube</th>
                        <th>İşlem</th>
                    </tr>
                    <?php foreach($sorgu AS $s) {
                         ?>
                    <tr>
                        <td>
                            <input type="text" table="ogrenciler" id="{{$s->id}}" name="title" value="{{$s->title}}" class="form-control edit">
                        </td>
                        <td>
                        <input type="number" maxlength="11" table="ogrenciler" id="{{$s->id}}" name="tc_kimlik_no" value="{{$s->tc_kimlik_no}}" class="form-control edit">

                        </td>
                        <td>
                            <input type="text" table="ogrenciler" id="{{$s->id}}" name="sinif" value="{{$s->sinif}}" class="form-control edit">
                       </td>
                        <td>
                            <input type="text" table="ogrenciler" id="{{$s->id}}" name="sube" value="{{$s->sube}}" class="form-control edit">
                        </td>
                        <td>
                            <a href="{{url("admin-ajax/ogrenci-sinavlari?id=".$s->id)}}" title="Öğrenci Sınavları" class="ajax_modal btn btn-primary">Sınav Sonuçları</a>
                            <a href="{{url("admin-ajax/ogrenci-bilgileri?id=".$s->id)}}" class="ajax_modal btn btn-danger">Bilgileri Düzenle</a>
                        </td>
                    </tr>    
                         <?php 
                    } ?>
                    
                
                </table>
            </div>
            </div>

            

        </div>

    </div>
</div>