const showError = () => alert('Houve um erro ao copiar endereço para a área de transferências');

// @link https://stackoverflow.com/a/30810322
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        if (!document.execCommand('copy')) {
            showError();
        }
    } catch {
        showError();
    }

    document.body.removeChild(textArea);
}

module.exports = function copyTextToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function () {
        }, showError);
        return;
    }
    fallbackCopyTextToClipboard(text);
}
