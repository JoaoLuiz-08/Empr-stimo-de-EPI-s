<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastro de <strong>Colaboradores</strong></h1>
</div>

<form id="form-colaborador" onsubmit="return false">
    <div class="row g-3">
        <div class="col-sm-3">
            <label for="txt_id" class="form-label">#</label>
            <input type="text" class="form-control" id="txt_id" value="NOVO" required readonly>
        </div>

        <div class="col-sm-5">
            <label for="txt_nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="txt_nome" maxlength="255">
        </div>

        <div class="col-sm-4">
            <label for="txt_cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="txt_cpf" maxlength="14" required>
        </div>

        <div class="col-sm-7">
            <label for="list_sexo" class="form-label">Sexo</label>
            <select class="form-control aguardando" id="list_sexo" required>
            <option value="" disabled selected>Selecione o sexo</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            </select>
        </div>

        <div class="col-sm-4">
            <label for="txt_idade" class="form-label">Idade</label>
            <input type="text" class="form-control" id="txt_idade" maxlength="11" required>
        </div>
        
        <div class="col-sm-6">
            <button class="w-100 btn btn-secondary btn-lg" type="reset">Cancelar</button>
        </div>
        <div class="col-sm-6">
            <button class="w-100 btn btn-primary btn-lg" onclick="salvarColaborador()">Salvar</button>
        </div>
    </div>
</form>

<hr class="my-4">

<div class="table-responsive">
    <table id="tabela-colaboradores" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Sexo</th>
                <th scope="col">UF</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aqui vai ser impresso a listagem de colaboradores através da função listarColaboradores() -->
        </tbody>                                                                                                                            
    </table>
</div>

<p class="footer-text mt-5 mb-3 text-body-secondary text-center">&copy; By João Corradi & João Luiz Rovani</p>