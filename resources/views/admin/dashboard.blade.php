<x-quickbites-layout>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-0">
                    <i class="bi bi-speedometer2 me-2 text-primary"></i>Painel de Administração
                </h1>
                <p class="text-muted mt-2">Gerencie utilizadores, receitas e categorias da plataforma QuickBites</p>
            </div>
            <div class="col-md-4 text-md-end d-flex justify-content-md-end align-items-center">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-house-door me-1"></i> Voltar ao Site
                </a>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Stats Row -->
        <div class="row mb-4">
            <div class="col-md-4 mb-4">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-primary d-inline-flex justify-content-center align-items-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-people-fill text-white fs-1"></i>
                        </div>
                        <h3 class="fs-2 fw-bold">{{ $users->total() }}</h3>
                        <p class="text-muted">Utilizadores</p>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="mt-3 text-muted small">
                            <span class="text-success">
                                <i class="bi bi-arrow-up"></i> 
                                {{ \App\Models\User::where('created_at', '>=', now()->subDays(30))->count() }}
                            </span> 
                            novos nos últimos 30 dias
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-warning shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-warning d-inline-flex justify-content-center align-items-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-journal-richtext text-white fs-1"></i>
                        </div>
                        <h3 class="fs-2 fw-bold">{{ $receitas->total() }}</h3>
                        <p class="text-muted">Receitas</p>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="mt-3 text-muted small">
                            <span class="text-success">
                                <i class="bi bi-arrow-up"></i> 
                                {{ \App\Models\Receita::where('created_at', '>=', now()->subDays(30))->count() }}
                            </span> 
                            novas nos últimos 30 dias
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-success d-inline-flex justify-content-center align-items-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-tags-fill text-white fs-1"></i>
                        </div>
                        <h3 class="fs-2 fw-bold">{{ $categorias->total() }}</h3>
                        <p class="text-muted">Categorias</p>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="bi bi-plus-circle me-1"></i>Nova Categoria
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search Form -->
        <form action="{{ route('admin.dashboard') }}" method="GET" class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome, email, título..." value="{{ $search ?? '' }}">
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-md-end">
                        @if(isset($search) && $search)
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i> Limpar Filtros
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="list-group shadow-sm sticky-top" style="top: 20px;" id="admin-tabs" role="tablist">
                    <a href="#users" class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center" data-bs-toggle="list">
                        <div>
                            <i class="bi bi-people-fill me-2 text-primary"></i>Utilizadores
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $users->total() }}</span>
                    </a>
                    <a href="#recipes" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-bs-toggle="list">
                        <div>
                            <i class="bi bi-journal-richtext me-2 text-warning"></i>Receitas
                        </div>
                        <span class="badge bg-warning text-dark rounded-pill">{{ $receitas->total() }}</span>
                    </a>
                    <a href="#categories" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-bs-toggle="list">
                        <div>
                            <i class="bi bi-tags-fill me-2 text-success"></i>Categorias
                        </div>
                        <span class="badge bg-success rounded-pill">{{ $categorias->total() }}</span>
                    </a>
                </div>
                
                <!-- Admin Info Card -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-3"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-person-badge fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                                <small class="text-muted">Administrador</small>
                            </div>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-secondary" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i> Terminar Sessão
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="tab-content">
                    <!-- Users Tab -->
                    <div class="tab-pane fade show active" id="users">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Gestão de Utilizadores</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Data de Registo</th>
                                                <th>Estado</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-2"
                                                                style="width: 40px; height: 40px;">
                                                                <i class="bi bi-person-fill text-primary"></i>
                                                            </div>
                                                            {{ $user->name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($user->is_banned)
                                                            <span class="badge bg-danger">Banido</span>
                                                        @else
                                                            <span class="badge bg-success">Ativo</span>
                                                        @endif
                                                        
                                                        @if($user->is_admin)
                                                            <span class="badge bg-info">Admin</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!$user->is_admin)
                                                            <form action="{{ route('admin.users.toggle-ban', $user) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm {{ $user->is_banned ? 'btn-success' : 'btn-danger' }}" 
                                                                        onclick="return confirm('{{ $user->is_banned ? 'Deseja desbanir este utilizador?' : 'Deseja banir este utilizador?' }}')">
                                                                    {{ $user->is_banned ? 'Desbanir' : 'Banir' }}
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm btn-secondary" disabled>Admin</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($users->isEmpty())
                                    <div class="text-center py-4">
                                        <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                                        <p class="mt-3">Nenhum utilizador encontrado</p>
                                    </div>
                                @endif
                                
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Receitas Tab -->
<div class="tab-pane fade" id="recipes">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-journal-richtext me-2"></i>Gestão de Receitas</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receitas as $receita)
                            <tr>
                                <td>{{ $receita->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . ($receita->receita_foto ?? 'receitas/default.jpg')) }}" 
                                         alt="{{ $receita->receita_titulo }}" 
                                         class="img-thumbnail" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td>{{ $receita->receita_titulo }}</td>
                                <td>{{ $receita->user->name ?? 'Utilizador Eliminado' }}</td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $receita->categoria ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>{{ $receita->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('receitas.show', $receita) }}" class="btn btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.receitas.delete', $receita) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja eliminar esta receita?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($receitas->isEmpty())
                <div class="text-center py-4">
                    <i class="bi bi-journal-x text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-3">Nenhuma receita encontrada</p>
                </div>
            @endif
            
            <div class="d-flex justify-content-center mt-3">
                {{ $receitas->links() }}
            </div>
        </div>
    </div>
</div>

                    
                    <!-- Categorias Tab -->
                    <div class="tab-pane fade" id="categories">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="bi bi-tags-fill me-2"></i>Gestão de Categorias</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 mb-4">
                                        <div class="card border-success">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Adicionar Nova Categoria</h6>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('categorias.store') }}" method="POST" id="categoryForm">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="nome" class="form-label">Nome da Categoria</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                                            <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                                                                id="nome" name="nome" required minlength="3"
                                                                placeholder="Ex: Sobremesas, Vegetariano...">
                                                        </div>
                                                        @error('nome')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="bi bi-plus-circle me-1"></i>Adicionar Categoria
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-7">
                                        <div class="card border-success">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Categorias Existentes</h6>
                                                <span class="badge bg-success">{{ $categorias->total() }} categorias</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover align-middle">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Nome</th>
                                                                <th>Receitas</th>
                                                                <th>Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($categorias as $categoria)
                                                                <tr>
                                                                    <td>{{ $categoria->id }}</td>
                                                                    <td>
                                                                        <span class="badge bg-light text-dark p-2">
                                                                            <i class="bi bi-tag-fill me-1 text-success"></i>
                                                                            {{ $categoria->nome }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-secondary">
                                                                            {{ \App\Models\Receita::where('categoria', $categoria->nome)->count() }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('admin.categorias.delete', $categoria) }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                                                    onclick="return confirm('Tem certeza que deseja eliminar esta categoria? Todas as receitas associadas ficarão sem categoria.')">
                                                                                <i class="bi bi-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                @if($categorias->isEmpty())
                                                    <div class="text-center py-4">
                                                        <i class="bi bi-tags text-muted" style="font-size: 3rem;"></i>
                                                        <p class="mt-3">Nenhuma categoria encontrada</p>
                                                    </div>
                                                @endif
                                                
                                                <div class="d-flex justify-content-center mt-3">
                                                    {{ $categorias->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addCategoryModalLabel"><i class="bi bi-plus-circle me-2"></i>Nova Categoria</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categorias.store') }}" method="POST" id="modalCategoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="modal_nome" class="form-label">Nome da Categoria</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                <input type="text" class="form-control" id="modal_nome" name="nome" required minlength="3"
                                    placeholder="Ex: Sobremesas, Vegetariano...">
                            </div>
                            <div class="form-text">O nome deve ter pelo menos 3 caracteres e ser único.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="document.getElementById('modalCategoryForm').submit()">
                        <i class="bi bi-plus-circle me-1"></i>Adicionar
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const tabLinks = document.querySelectorAll('.list-group-item[data-bs-toggle="list"]');
        const tabContents = document.querySelectorAll('.tab-pane');
        
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links and hide all content
                tabLinks.forEach(l => l.classList.remove('active'));
                tabContents.forEach(c => {
                    c.classList.remove('show', 'active');
                });
                
                // Add active class to clicked link and show corresponding content
                this.classList.add('active');
                const target = this.getAttribute('href');
                document.querySelector(target).classList.add('show', 'active');
            });
        });
        
        // Verificar se há erros de validação para o formulário de categorias
        @if($errors->has('nome'))
            // Se estamos na tab de categorias, não precisamos fazer nada
            if (!document.querySelector('#categories').classList.contains('active')) {
                // Se não estamos na tab de categorias, vamos ativar ela
                document.querySelector('a[href="#categories"]').click();
            }
        @endif
        
        // Manter a tab ativa após recarregar a página
        const activeTab = sessionStorage.getItem('activeAdminTab');
        if (activeTab) {
            const tabToActivate = document.querySelector(`a[href="${activeTab}"]`);
            if (tabToActivate) {
                tabToActivate.click();
            }
        }
        
        // Salvar a tab ativa quando mudar
        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                const tabId = this.getAttribute('href');
                sessionStorage.setItem('activeAdminTab', tabId);
            });
        });
        
        // Animação para os cards
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.1)';
                this.style.transition = 'all 0.3s ease';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
                this.style.transition = 'all 0.3s ease';
            });
        });
    });
    </script>
    
    <style>
    /* Estilo para as tabs */
    .list-group-item {
        border-left: 3px solid transparent;
        transition: all 0.2s ease;
    }
    
    .list-group-item.active {
        border-left: 3px solid #0d6efd;
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        font-weight: 500;
    }
    
    /* Estilo para tabelas */
    .table th {
        font-weight: 600;
        color: #495057;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    </style>
</x-quickbites-layout>
