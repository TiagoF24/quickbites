<x-quickbites-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-dark text-center py-3">
                        <h3 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Acesso Negado</h3>
                    </div>
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <div class="rounded-circle bg-light d-inline-flex justify-content-center align-items-center mb-4"
                                style="width: 120px; height: 120px;">
                                <i class="bi bi-shield-lock-fill text-warning fs-1"></i>
                            </div>
                        </div>
                        
                        <h1 class="display-1 fw-bold text-warning mb-3">403</h1>
                        <h4 class="mb-4">{{ $exception->getMessage() ?: 'Acesso não autorizado' }}</h4>
                        
                        <p class="lead mb-4">
                            Não tem permissão para aceder a esta página.
                        </p>
                        
                        <div class="d-grid gap-3">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Voltar
                            </a>
                            <a href="{{ route('welcome') }}" class="btn btn-primary">
                                <i class="bi bi-house-door me-2"></i>Ir para a Página Inicial
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-quickbites-layout>
