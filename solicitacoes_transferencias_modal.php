<!--Modal atualizar unitátio-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Atualizar Pedido</h4>
            </div>                    
            <div class="modal-body">                       
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputSolicitante" class="col-sm-4 control-label">Requerente</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="ALTERE O NOME DO REQUERENTE SE DESEJAR" class="form-control" name="inputSolicitante" id="inputSolicitante" onkeyup="maiuscula(this)">
                        </div>                               
                    </div>  
                </div> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputEntregue"  class="col-sm-4 control-label" >Status da Transferência</label>
                        <div class="col-sm-8">                                    
                            <select name="inputEntregue" class="form-control" id="status">
                                <option value="">ESCOLHA O NOVO STATUS</option>
                                <option value="S">ENTREGUE</option>
                                <option value="P">PRONTA</option>
                                <option value="N">PENDENTE</option>                                        
                            </select> 
                        </div>                            
                    </div>
                </div>                   
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="inputDataEntregue" class="col-sm-4 control-label" id="labelDataEntregue">Entrega ou Pronta</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="inputDataEntregue" id="IdDataEntregue">
                        </div>
                    </div>  
                </div><br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputDSN" class="col-sm-4 control-label">Declaração</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="inputDSN" id="inputDSN">
                                <option value="---">---</option>
                                <option value="NÃO">NÃO</option>
                                <option value="SIM">SIM</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputRD" class="col-sm-4 control-label">Responsável pela Declaração</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputRD" name="inputRD" value="" onkeyup="maiuscula(this)">
                        </div>
                    </div>                   
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="inputDatD" class="col-sm-4 control-label" id="">Data Declaração</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="inputDatD" id="inputDatD">
                        </div>
                    </div>  
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputTSN" class="col-sm-4 control-label">Transferência</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="inputTSN" id="inputTSN">  
                                <option value="---">---</option>
                                <option value="NÃO">NÃO</option>
                                <option value="SIM">SIM</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputRT" class="col-sm-4 control-label">Responsável pela Transferência</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputRT" name="inputRT" value="" onkeyup="maiuscula(this)">
                        </div>
                    </div>                   
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="inputDatT" class="col-sm-4 control-label" id="">Data Transferência</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="inputDatT" id="inputDatT">
                        </div>
                    </div>  
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputST"  class="col-sm-4 control-label" >Status Atual do Aluno</label>
                        <div class="col-sm-8">                                  
                            <select class="form-control" name="inputST" id="inputST">
                                <option value="ADIMITIDO DEPOIS">ADIMITIDO DEPOIS</option>
                                <option value="CURSANDO">CURSANDO</option>
                                <option value="DESISTENTE">DESISTENTE</option>
                                <option value="TRANSFERIDO">TRANSFERIDO</option>
                            </select>                 
                        </div>                            
                    </div>
                </div>   
                <button type="submit" name ="botao" value="atualizar"  class="btn btn-success btn-block" onclick="return confirmarAtualizacao()" >Atualizar </button> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!--//;
Modal atualizar vários-->
<div class="modal fade" id="myModal_2" role="dialog">
    <div class="modal-dialog modal-lg">
         Modal content
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Atualizar Pedido</h4>
            </div>                    
            <div class="modal-body">                       
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputSolicitante" class="col-sm-4 control-label">Requerente</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="ALTERE O NOME DO REQUERENTE SE DESEJAR" class="form-control" name="inputSolicitante_02" id="inputSolicitante" onkeyup="maiuscula(this)">
                        </div>                               
                    </div>  
                </div> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputEntregue"  class="col-sm-4 control-label" >Status da Transferência</label>
                        <div class="col-sm-8">                                    
                            <select name="inputEntregue_02" class="form-control" id="status">
                                <option value="">ESCOLHA O NOVO STATUS</option>
                                <option value="S">ENTREGUE</option>
                                <option value="P">PRONTA</option>
                                <option value="N">PENDENTE</option>                                        
                            </select> 
                        </div>                            
                    </div>
                </div>                   
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="inputDataEntregue" class="col-sm-4 control-label" id="labelDataEntregue">Entrega ou Pronta</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="inputDataEntregue_02" id="IdDataEntregue">
                        </div>
                    </div>  
                </div><br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputDSN" class="col-sm-4 control-label">Declaração</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="inputDSN_02" id="inputDSN">
                                <option value="---">---</option>
                                <option value="NÃO">NÃO</option>
                                <option value="SIM">SIM</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputRD" class="col-sm-4 control-label">Responsável pela Declaração</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputRD" name="inputRD_02" value="" onkeyup="maiuscula(this)">
                        </div>
                    </div>                   
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="inputDatD" class="col-sm-4 control-label" id="">Data Declaração</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="inputDatD_02" id="inputDatD">
                        </div>
                    </div>  
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputTSN" class="col-sm-4 control-label">Transferência</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="inputTSN_02" id="inputTSN">  
                                <option value="---">---</option>
                                <option value="NÃO">NÃO</option>
                                <option value="SIM">SIM</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputRT" class="col-sm-4 control-label">Responsável pela Transferência</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputRT" name="inputRT_02" value="" onkeyup="maiuscula(this)">
                        </div>
                    </div>                   
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="inputDatT" class="col-sm-4 control-label" id="">Data Transferência</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="inputDatT_02" id="inputDatT">
                        </div>
                    </div>  
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputST_02"  class="col-sm-4 control-label" >Status Atual do Aluno</label>
                        <div class="col-sm-8">                                  
                            <select class="form-control" name="inputST_02" id="inputST">
                                <option value="ADIMITIDO DEPOIS">ADIMITIDO DEPOIS</option>
                                <option value="CURSANDO">CURSANDO</option>
                                <option value="DESISTENTE">DESISTENTE</option>
                                <option value="TRANSFERIDO">TRANSFERIDO</option>
                            </select>                 
                        </div>                            
                    </div>
                </div>   
                <button type="submit" name ="botao" value="transferencias"  class="btn btn-success btn-block" onclick="return confirmarAtualizacao()" >Atualizar </button> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>