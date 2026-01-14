<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastro de <strong>Equipamentos</strong></h1>
</div>

<form id="form-equipamento" onsubmit="return false">
    <div class="row g-3">
        <div class="col-sm-2">
            <label for="txt_id" class="form-label">#</label>
            <input type="text" class="form-control" id="txt_id" value="NOVO" required readonly>
        </div>

        <div class="col-sm-8">
            <label for="txt_nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="txt_nome" maxlength="255" required>
        </div>

        <div class="col-sm-2">
            <label for="txt_quantidade" class="form-label">Quantidade</label>
            <input type="text" class="form-control aguardando" id="txt_quantidade" required>
        </div>

        <div class="col-sm-9">
            <label for="txt_descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="txt_descricao" name="txt_descricao" maxlength="255" required>
        </div>
    
        <div class="col-sm-6">
            <button class="w-100 btn btn-secondary btn-lg" type="reset">Cancelar</button>
        </div>
        <div class="col-sm-6">
            <button class="w-100 btn btn-primary btn-lg" onclick="salvarEquipamento()">Salvar</button>
        </div>
    </div>
</form>

<hr class="my-4">

<div class="table-responsive">
    <table id="tabela-equipamentos" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aqui vai ser impresso a listagem de equipamentos através da função listarEquipamentos() -->
        </tbody>                                                                                                                            
    </table>
</div>

<p class="footer-text mt-5 mb-3 text-body-secondary text-center">&copy; By João Corradi & João Luiz Rovani</p>