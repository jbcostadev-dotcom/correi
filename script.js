// Inicia o preenchimento da barra de progresso (se existir)
window.onload = function() {
    const progressBar = document.getElementById('progress');
    if (progressBar) {
        progressBar.style.width = '0%'; // Define a largura inicial como 0%

        setTimeout(function() {
            progressBar.style.transition = 'width 8s linear';
            progressBar.style.width = '100%'; // Preenche a barra até 100% em 8 segundos
        }, 200); // Pequeno atraso para garantir que a animação seja visível
    }
};

// Função para simular o carregamento e troca de tela
setTimeout(function() {
    // Esconde a primeira seção e exibe a segunda sem delay (se existirem)
    const verificationSection = document.getElementById('verification-section');
    const errorSection = document.getElementById('error-section');
    if (verificationSection) verificationSection.classList.add('hidden');
    if (errorSection) errorSection.classList.remove('hidden');

    // Exibe as caixas de informações uma abaixo da outra com delay e animação
    setTimeout(function() {
        const box1 = document.getElementById('box-1');
        if (box1) box1.classList.remove('hidden');
    }, 0); // Sem delay para a primeira box

    setTimeout(function() {
        const box2 = document.getElementById('box-2');
        if (box2) box2.classList.remove('hidden');

        // Iniciar a animação da barra de progresso 2 de forma progressiva
        const progressBar2 = document.getElementById('progress2');
        if (progressBar2) {
            progressBar2.style.width = '0%'; // Define a largura inicial como 0%

            // Usar um pequeno atraso para que o navegador registre a mudança de `width` de 0% para 100%
            setTimeout(function() {
                progressBar2.style.transition = 'width 8s linear'; // Define a duração da animação
                progressBar2.style.width = '100%'; // Preenche a barra até 100%
            }, 100); // Pequeno atraso para garantir que a transição seja visível
        }
    }, 4500); // Após 4.5 segundos

    setTimeout(function() {
        const box2 = document.getElementById('box-2');
        const box3 = document.getElementById('box-3');
        if (box2) box2.classList.add('hidden2');
        if (box3) box3.classList.remove('hidden');
    }, 12500); // Após mais 5 segundos (total 10 segundos)

    setTimeout(function() {
        const boxRastreio = document.getElementById('box-rastreio');
        if (boxRastreio) boxRastreio.classList.remove('hidden');
        // Aplica o efeito de scroll extra suave apenas se a terceira box existir
        if (document.getElementById('box-3')) smoothScrollToBox('box-3');
    }, 15000); // Após 15 segundos

}, 3000); // Troca da tela de verificação para a tela de erro após 3 segundos

// Função personalizada para rolagem extra suave
function smoothScrollToBox(boxId) {
    const targetEl = document.getElementById(boxId);
    if (!targetEl) return; // Se o elemento não existir, não faz nada
    const targetPosition = targetEl.getBoundingClientRect().top + window.scrollY - 50;
    const startPosition = window.scrollY;
    const distance = targetPosition - startPosition;
    const duration = 2500; // Aumentei o tempo da rolagem para 2.5 segundos
    let startTime = null;

    function animationScroll(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = ease(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animationScroll);
    }

    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animationScroll);
}
