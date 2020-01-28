<style>
    @media (max-width: 825px) { #btNao{margin-top: 12px}
    } 

</style>
<!--Modal-->                <!--Modal-->            <!--Modal-->        
<div class="modal fade" id="exemplomodal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="gridSystemModalLabel">Agendamentos</h4>
            </div>
            <div class="modal-body" style="min-height: 350px;">               
                <div class="col-sm-12"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea class="form-control" id="servidor_json"   rows="8"></textarea>
                        </div>
                    </div>
                    <br>      
                    <h4 style="text-align: center">Ainda Deseja Ver Esse Aviso!</h4>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Sim</button>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <button id="btNao" type="button" class="btn btn-danger btn-block" data-dismiss="modal" onclick="setCookie()">Não</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
</div> 
<script type="text/javascript">
    function setCookie(cname, cvalue, exdays) {
        // alert("nao");

        var cname = "msg";
        var cvalue = "nao";
        var d = new Date();

        //d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        d.setTime(d.getTime() + (exdays * 60));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

        var x = document.cookie;

        // alert(x);
    }
</script>






