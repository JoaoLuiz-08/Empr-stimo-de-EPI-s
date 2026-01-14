<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Controle de <strong>Empréstimos</strong></h1>
</div>

<form id="form-emprestimo" onsubmit="return false">
    <div class="row g-3">
        <div class="col-sm-4">
            <label for="txt_id" class="form-label">Nº Empréstimo</label>
            <input type="text" class="form-control" id="txt_id" value="NOVO" required readonly>
        </div>

        <div class="col-sm-8">
            <label for="list_colaborador" class="form-label">Colaborador</label>
            <select class="form-select" id="list_colaborador" required>
                <!-- As opções vão ser impressas pelo JS -->
            </select>
        </div>

        <div class="col-sm-8">
            <label for="list_equipamento" class="form-label">Equipamento</label>
            <select class="form-select" id="list_equipamento" required>
                <!-- As opções vão ser impressas pelo JS -->
            </select>
        </div>

        <div class="col-sm-4">
            <label for="txt_quantidade" class="form-label">Quantidade</label>
            <input type="text" class="form-control" id="txt_quantidade" required>
        </div>
    
        <div class="col-sm-6">
            <button class="w-100 btn btn-secondary btn-lg" type="reset">Devolver</button>
        </div>
        <div class="col-sm-6">
            <button class="w-100 btn btn-primary btn-lg" onclick="salvarEmprestimo()">Salvar</button>
        </div>
    </div>
</form>

<hr class="my-4">

<div class="table-responsive">
    <table id="tabela-emprestimos" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Nº Empréstimo</th>
                <th scope="col">Colaborador</th>
                <th scope="col">Data</th>
                <th scope="col">Equipamento</th>
                <th scope="col">Qtd.</th>
                <th scope="col">Devolvido</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aqui vai ser impresso a listagem de empréstimos através da função listarEmpréstimos() -->
        </tbody>                                                                                                                            
    </table>
</div>

<p class="footer-text mt-5 mb-3 text-body-secondary text-center">&copy; By João Corradi & João Luiz Rovani</p>