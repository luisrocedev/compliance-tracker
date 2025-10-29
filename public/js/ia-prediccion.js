// resources/js/ia-prediccion.js

document.addEventListener('DOMContentLoaded', () => {
    // Normativas
    document.querySelectorAll('[data-ia-normativa]').forEach(el => {
        const id = el.getAttribute('data-ia-normativa');
        el.innerHTML = '<span class="animate-spin inline-block w-4 h-4 border-2 border-red-600 border-t-transparent rounded-full align-middle"></span> <span class="text-xs text-gray-500">Cargando...</span>';
        fetch(`/api/ia-prediccion/normativa/${id}`)
            .then(r => r.json())
            .then(data => {
                el.innerHTML = `<span class='inline-block px-3 py-1 rounded-full text-xs font-bold'>${data.prediccion}</span>`;
            })
            .catch(() => {
                el.innerHTML = '<span class="text-xs text-gray-500">Sin datos</span>';
            });
    });
    // Documentos
    document.querySelectorAll('[data-ia-documento]').forEach(el => {
        const id = el.getAttribute('data-ia-documento');
        el.innerHTML = '<span class="animate-spin inline-block w-4 h-4 border-2 border-red-600 border-t-transparent rounded-full align-middle"></span> <span class="text-xs text-gray-500">Cargando...</span>';
        fetch(`/api/ia-prediccion/documento/${id}`)
            .then(r => r.json())
            .then(data => {
                el.innerHTML = `<span class='inline-block px-3 py-1 rounded-full text-xs font-bold'>${data.prediccion}</span>`;
            })
            .catch(() => {
                el.innerHTML = '<span class="text-xs text-gray-500">Sin datos</span>';
            });
    });
});
