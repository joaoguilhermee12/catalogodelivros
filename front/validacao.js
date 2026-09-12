document.addEventListener('DOMContentLoaded', function () {
    
    const form = document.getElementById('form-livro');
    if (form) {
        form.addEventListener('submit', function (event) {
            const titulo = document.getElementById('titulo');
            const autor = document.getElementById('autor');
            let valido = true;

            [titulo, autor].forEach(function (campo) {
                if (campo.value.trim() === '') {
                    campo.classList.add('campo-erro');
                    valido = false;
                } else {
                    campo.classList.remove('campo-erro');
                }
            });

            if (!valido) {
                event.preventDefault();
                alert('Título e autor são obrigatórios.');
            }
        });
    }

   
    const linksExcluir = document.querySelectorAll('.btn-excluir');
    linksExcluir.forEach(function (link) {
        link.addEventListener('click', function (event) {
            if (!confirm('Tem certeza que deseja excluir este livro?')) {
                event.preventDefault();
            }
        });
    });
});