
<script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <!--Modal-->                <!--Modal-->            <!--Modal-->        
        <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo $Msg;
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger " data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div> 
        <?php
        if ($M == "1") {
            echo"<script type='text/javascript'>
                $(document).ready(function () {
                   $('#exemplomodal').modal('show');
               });
                
            </script>";
        }
        