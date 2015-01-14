<br/><br/>
<div class="body">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <h1 class="padding_article_left">OPERACI&Oacute;N</h1>
            </div>
        </div>
        <div class="row" style="text-align: left">
            <div class="col-lg-12">
                <div class="col-xs-6" style="text-align:left; margin: 15px 0;">
                    <input type="text" placeholder="Introduzca partes del Nombre" class="form-control" id="txt_buscar"/>
                </div>
                <div class="col-xs-6">
                    <button class="form-control" id="buscar" style="text-align:left; margin: 15px 0;">Buscar</button>
                </div>
            </div>
            <div class="col-xs-12 hr">
                <div class="row">
                    <div class="col-xs-6 col-sm-2">
                        <strong>Codigo</strong>
                    </div>
                    <div class="hidden-xs col-sm-8">
                        <strong>Nombre</strong>
                    </div>
                    <div class="col-xs-6 col-sm-2"> <strong>Descargar</strong></div>
                </div>

            </div>
            <?php $comodin = true; if($archivos_operacion){
                foreach($archivos_operacion as $archivo){
                    ?>
                    <div class="archivo col-xs-12" id="<?php echo $archivo->title;?>"  style="background-color: #<?php if($comodin){echo 'dad8d8';$comodin=false;}else{echo 'c7c3c3';$comodin=true;} ?>;">
                        <div class="row">
                            <div class="col-xs-6 col-sm-2">
                                <?php echo $archivo->codigo; ?>
                            </div>
                            <div class="hidden-xs col-sm-8">
                                <?php echo $archivo->title; ?>
                            </div>
                            <div class="col-xs-6 col-sm-2">
                                <a href="<?php echo base_url().'resources/media/archivo/doc/' . $user_login . '/operacion/' . $archivo->picture ?>" download="<?php echo $archivo->picture ?>">descargar</a>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
        </div>
        <?php
        ?>
        <div>
            <script>
                $(document).ready(function(){
                    $('#buscar').click(function(){
                        var sd = $('div.archivo');
                        var c = sd.length;
                        var txt = $('#txt_buscar').val();

                        //alert(txt);
                        while(c>0){
                            var db = sd[c-1].id;
                            var texto = db.match(txt);
                            if(txt != ""){
                                if(texto == txt){
                                    alert(sd[c-1].id);
                                    $('#'+sd[c-1].id).css({display:"block"});

                                    //document.getElementById('#kjhndfg').style.display = 'none';
                                    //sd[c-1].css('display','block');
                                }
                                else{
                                    alert(sd[c-1].id);
                                    $('#'+sd[c-1].id).css({display:"none"});
                                    //document.getElementById('#kjhndfg').style.display = 'none';
                                    //sd[c-1].css('display','none');
                                }
                            }
                            else{
                                $('#'+sd[c-1].id).css({display:"block"});
                            }
                            //alert(texto);
                            c--;
                        }

                    });
                    //print(sd.length);
                    /* while( c>0 ){
                     alert(sd[c-1].id);
                     c--;
                     }*/
                    //alert(sd[0].id);
                });
            </script>
        </div>
    </div>
</div>
