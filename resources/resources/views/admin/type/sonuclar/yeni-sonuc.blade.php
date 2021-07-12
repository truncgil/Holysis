
<div class="content">
    <div class="block">
            <div class="block-header block-header-default" >
                <h3 class="block-title"><i class="fa fa-plus"></i> {{e2("Sınav Oku")}}</h3>
            </div>
            <div class="block-content">
           
                <form action="?oku" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Okunacak Veri</div>
                            <input type="file" class="form-control" name="dosya" id="">
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Uygulama Adı</div>
                            <input type="text" class="form-control" name="title" required id="">
                        </div>
                    </div>
                    <div class="col-md-6 d-none">
                        <div class="input-group">
                            <div class="btn btn-default">Sınıf Seviyesi</div>
                            <select name="level" id=""  class="form-control">
                                <option value="">Sınıf Seviyesi Seçiniz</option>
                            <?php for($k=2;$k<=13;$k++) { ?>
                                <option value="{{$k}}">{{$k}}. Sınıf</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Sınav Şablonu</div>
                            <select name="sinav" id="" required class="form-control">
                                <option value="">Seçiniz</option>
                            <?php $sinav = db("sinavlar")->get(); foreach($sinav AS $s) {  ?>
                                <option value="{{$s->id}}">{{$s->title}}</option>
                                <?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Optik Şablonu</div>
                            <select name="optik" id="" required class="form-control">
                                <option value="">Seçiniz</option>
                            <?php $sinav = db("optik")->get(); foreach($sinav AS $s) {  ?>
                                <option value="{{$s->id}}">{{$s->title}}</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 text-center"> <br>
                        <button class="btn btn-primary"><i class="fa fa-cog"></i> Oku</button>
                    </div>
                </div>
                    
                </form>
                @include("admin.type.sonuclar.sonuc-oku")
            </div>
    </div>
</div>