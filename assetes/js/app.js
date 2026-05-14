document.addEventListener('DOMContentLoaded', function () {
    const chkMostrar = document.getElementById('chk');
    const pass = document.getElementById('txtPass');

    if (chkMostrar && pass) {
        chkMostrar.addEventListener('change', function () {
            pass.type = this.checked ? 'text' : 'password';
        });
    }

 
    document.querySelectorAll('.form-eliminar').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!confirm('¿Confirma que desea eliminar este registro?')) {
                event.preventDefault();
            }
        });
    });

    const servicio = document.getElementById('id_servicio');
    const monto = document.getElementById('monto');

    if (servicio && monto) {
        servicio.addEventListener('change', function () {
            const opcion = this.options[this.selectedIndex];
            const precio = opcion ? opcion.getAttribute('data-precio') : '';

            if (precio && (!monto.value || parseFloat(monto.value) === 0)) {
                monto.value = parseFloat(precio).toFixed(2);
            }
        });
    }


    const inputFoto = document.getElementById('fotoInput');
    const preview = document.getElementById('previewImg');
    const textoPreview = document.getElementById('previewText');
    const placeholder = document.getElementById('previewPlaceholder');

    if (inputFoto && preview) {
        inputFoto.addEventListener('change', function () {

            const file = this.files && this.files.length ? this.files[0] : null;

            if (!file || !file.type.startsWith('image/')) return;

            const url = URL.createObjectURL(file);

            preview.src = url;
            preview.style.width = '120px';
            preview.style.height = '120px';
            preview.style.objectFit = 'cover';
            preview.style.display = 'block';

            if (placeholder) placeholder.style.display = 'none';
            if (textoPreview) textoPreview.textContent = 'Vista previa cargada';

            preview.onload = function () {
                URL.revokeObjectURL(url);
            };
        });
    }

 
    document.querySelectorAll('.js-buscador-tabla').forEach(function (input) {

        const panel = input.closest('.panel');
        const tabla = panel ? panel.querySelector('table') : null;
        const cuerpo = tabla ? tabla.querySelector('tbody') : null;
        const contador = panel ? panel.querySelector('.js-buscador-contador') : null;

        if (!cuerpo || !tabla) return;

        const filas = Array.from(cuerpo.querySelectorAll('tr'))
            .filter(f => !f.classList.contains('sin-datos'));

        const columnas = tabla.tHead ? tabla.tHead.rows[0].cells.length : 1;

        const filaNoResultados = document.createElement('tr');
        filaNoResultados.innerHTML =
            `<td colspan="${columnas}" class="sin-datos">No se encontraron resultados</td>`;
        filaNoResultados.style.display = 'none';
        cuerpo.appendChild(filaNoResultados);

        const normalizar = (t) =>
            (t || '')
                .toString()
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .trim();

        const buscar = () => {
            const valor = normalizar(input.value);
            let visibles = 0;

            filas.forEach(fila => {
                const ok = normalizar(fila.innerText).includes(valor);
                fila.style.display = ok ? '' : 'none';
                if (ok) visibles++;
            });

            filaNoResultados.style.display = filas.length && visibles === 0 ? '' : 'none';

            if (contador) {
                contador.textContent = valor
                    ? `Resultados: ${visibles} de ${filas.length}`
                    : `Mostrando ${filas.length} registros`;
            }
        };

        input.addEventListener('input', buscar);
        buscar();
    });

});