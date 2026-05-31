document.addEventListener('DOMContentLoaded', function() {
    // --- PREVIEW DE UPLOAD DE IMAGEM ---
    const input = document.getElementById('campaign_image_input');
    const preview = document.getElementById('image_preview');
    const placeholder = document.getElementById('preview_placeholder');

    // A checagem condicional garante que o script não quebre nas páginas que não têm esse form
    if (input && preview && placeholder) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    // Define o source da tag img com o arquivo convertido em Base64
                    preview.src = event.target.result;
                    
                    // Ajusta as classes do Tailwind para exibir a imagem e sumir com o texto
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                
                reader.readAsDataURL(file);
            }
        });
    }
});
