window.usuariosParaReporte = @json($users->items());

// Cambiar pestañas y contenido
document.getElementById('tab-becarios').addEventListener('click', function() {
    this.classList.add('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    this.classList.remove('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('tab-personal').classList.remove('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    document.getElementById('tab-personal').classList.add('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('form-becario').classList.remove('hidden');
    document.getElementById('form-personal').classList.add('hidden');
    document.getElementById('form-title').textContent = 'Agregar Becario';
    document.querySelectorAll('.row-becario').forEach(row => row.classList.remove('hidden'));
    document.querySelectorAll('.row-personal').forEach(row => row.classList.add('hidden'));
});

document.getElementById('tab-personal').addEventListener('click', function() {
    this.classList.add('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    this.classList.remove('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('tab-becarios').classList.remove('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    document.getElementById('tab-becarios').classList.add('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('form-becario').classList.add('hidden');
    document.getElementById('form-personal').classList.remove('hidden');
    document.getElementById('form-title').textContent = 'Agregar Personal';
    document.querySelectorAll('.row-becario').forEach(row => row.classList.add('hidden'));
    document.querySelectorAll('.row-personal').forEach(row => row.classList.remove('hidden'));
});
// Filtro de tabla
document.getElementById('table-search').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const rows = document.querySelectorAll('#myTable tbody tr');
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let found = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(search)) {
                found = true;
            }
        });
        row.style.display = found ? '' : 'none';
    });
});

// Inicializar en becarios
document.getElementById('tab-becarios').click();

